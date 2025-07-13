<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouTechInfoModel;
use App\Models\MelkinouSaleInfoModel;
use App\Models\MelkinouReferLogsModel;
use App\Models\MelkinouSalingAccessLogs;

class MelkinouLandInfoModel extends Model
{
    protected $table = 'melkinou_land_info';

    protected $fillable = [
        'officer',
        'sale_type',
        'land_type',
        'street',
        'alley',
        'house_number',
        'room_number',
        'meter',
        'bed_roo_no',
        'region',
        'price',
        'tr_code'
    ];

    public function techInfo(){
        return $this->hasOne(MelkinouTechInfoModel::class, "tr_code", "tr_code");
    }

    public function saleInfo(){
        return $this->hasOne(MelkinouSaleInfoModel::class, "tr_code", "tr_code");
    }

    public function referLogs(){
        $this->hasMany(MelkinouReferLogsModel::class, "tr_code", "tr_code");
    }

    public function salingLogs(){
        $this->hasOne(MelkinouSalingAccessLogs::class, "tr_code", "tr_code");
    }
}
