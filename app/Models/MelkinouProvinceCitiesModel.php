<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouRegionsModel;

class MelkinouProvinceCitiesModel extends Model
{
    protected $table = 'melkinou_province_cities';

    protected $fillable = [
        'city',
        'province'
    ];

    public function province_cities(){
        return $this->hasMany(MelkinouRegionsModel::class, "code", "id");
    }
}
