<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = [
        'tr_code',
         'status'
        ];

    public function workflows()
    {
        return $this->hasMany(TicketWorkflow::class, 'tr_code', 'tr_code');
    }
}