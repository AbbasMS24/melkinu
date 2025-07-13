<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouLandInfoModel;
class MelkinouSalingAccessLogs extends Model
{

    protected $table = 'melkinou_saling_access_logs';

    protected $fillable = [
        'tr_code',
        'date',
        'time',
        'ip_address',
        'user_agent',
        'status'
    ];

    public function salingLogs(){
        return $this->belongsTo(MelkinouLandInfoModel::class, "tr_code", "tr_code");
    }

}
