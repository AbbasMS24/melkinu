<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouLandInfoModel;

class MelkinouTechInfoModel extends Model
{
    protected $table = 'melkinou_tech_info';

    protected $fillable = [
        'building_age',
        'license_status',
        'land_property',
        'floor_no',
        'floor_room_no',
        'land_direction',
        'cash_budget',
        'tr_code'
    ];
    public function techInfo(){
        return $this->belongsTo(MelkinouLandInfoModel::class, "tr_code", "tr_code");
}
}

