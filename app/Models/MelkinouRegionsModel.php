<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouProvinceCitiesModel;

class MelkinouRegionsModel extends Model
{
    protected $table = 'melkinou_regions';

    protected $fillable = [
        'region',
        'code'
    ];

    public function province_cities(){
        return $this->belongsTo(MelkinouProvinceCitiesModel::class, "code", "id");
    }
}
