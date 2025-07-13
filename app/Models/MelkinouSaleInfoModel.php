<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MelkinouLandInfoModel;

class MelkinouSaleInfoModel extends Model
{

    protected $table = 'melkinou_sale_info';

    protected $fillable = [
        'sale_reason',
        'commission_price',
        'visiting_time',
        'sale_duration_suggestion',
        'sale_duration',
        'customer_no',
        'not_saling_reason',
        'id_no',
        'place_exp',
        'national_card',
        'tr_code'
    ];

    public function saleInfo(){
        return $this->belongsTo(MelkinouLandInfoModel::class, "tr_code", "tr_code");
    }
}
