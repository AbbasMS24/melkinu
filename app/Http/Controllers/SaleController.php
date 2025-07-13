<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MelkinouLandInfoModel;
use App\Models\MelkinouTechInfoModel;
use App\Models\MelkinouSaleInfoModel;
use App\Models\MelkinouSalingAccessLogs;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function register(Request $request){
        try{
            DB::beginTransaction();

            $data = $request->all();
            $data['tr_code'] = "9999"; //must be replaced with the real one
            $data['date'] = "9999";
            $data['time'] = "9999";
            $data['ip_address'] = $request->ip();
            $data['user_agent'] = $request->userAgent();
            //upload natinoal_card script
            if($request->hasFile("national_card")){
                $file = $request->file("national_card");
                if($file->storeAs("sale/national_card", $data['tr_code'], $file->getClientOriginalExtension())){
                    MelkinouLandInfoModel::create($data);
                    MelkinouTechInfoModel::create($data);
                    MelkinouSaleInfoModel::create($data);
                    MelkinouSalingAccessLogs::create($data);

                    DB::commit();

                    return response()->json([
                        "msg" => "inserted",
                        "statuscode" => 201
                    ], 201);
                }
                return response()->json([
                    "msg" => "could not upload national card id",
                    "statuscode" => 400
                ], 400);
            }

            return response()->json([
                "msg" => "file not found to upload",
                "statuscode" => 404
            ], 404);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                "error" => $e->getMessage() . " at line " . $e->getLine(),
                "statuscode" => 500
            ], 500);
        }
    }

    public function fetchData(){
        try {
            $data = MelkinouLandInfoModel::with([
                "techInfo",
                "saleInfo"
            ])->get();

            if($data->isEmpty()){
                return response()->json([
                    "msg" => "not found",
                    "statuscode" => 404
                ], 404);
            }

            return response()->json([
                "data" => $data,
                "statuscode" => 200
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage() . " at line " . $e->getLine(),
                "statuscode" => 500
            ], 500);
        }
    }
}
