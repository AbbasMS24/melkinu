<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TicketStatus;
use Carbon\Carbon;


class CloseExpiredTickets extends Command
{
    protected $signature = 'tickets:autoclose';

    public function handle()
    {
        $expiredTickets = TicketStatus::where('status', '!=', 4)->get();
    
        foreach ($expiredTickets as $ticket) {
            $lastUpdate = $ticket->workflows()->latest()->first();
    
            if ($lastUpdate && now()->diffInHours(Carbon::parse($lastUpdate->created_at)) >= 72) {
                $ticket->update(['status' => 4]); // بسته شده
                $this->info("Ticket {$ticket->tr_code} بسته شد.");
            }
        }
    
        return 0;
    }
}
