<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketWorkflow extends Model
{
    protected $fillable = [
        'tr_code',
        'sender',
        'receptor',
        'date',
        'time',
        'title',
        'content',
        'attachment',
        'station'
    ];

    public function workflows()
    {
        return $this->belongsTo(TicketStatus::class, 'tr_code', 'tr_code');
    }
}
