<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouLandInfoModel;

class MelkinouReferLogsModel extends Model
{

    protected $table = 'melkinou_refer_logs';

    protected $fillable = [
        'tr_code',
        'sender',
        'receptor',
        'date',
        'time'
    ];

    public function referLogs(){
        $this->belongsTo(MelkinouLandInfoModel::class, "tr_code", "tr_code");
    }
}
