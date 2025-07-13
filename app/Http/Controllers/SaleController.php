<?php

namespace App\Http\Controllers;

use App\Models\MelkinouReferLogsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MelkinouLandInfoModel;
use App\Models\MelkinouTechInfoModel;
use App\Models\MelkinouSaleInfoModel;
use App\Models\MelkinouSalingAccessLogs;
use Illuminate\Support\Facades\DB;

require_once __DIR__ . "../../jdf/jdf.php";

class SaleController extends Controller
{
    public function tr_generator(){
        $last_tr = MelkinouLandInfoModel::orderBy("id", "desc")->first();
        $code = $last_tr ? $last_tr + 1 : 1000;
        return $code;
    }
    public function register(Request $request){
        try{
            DB::beginTransaction();

            $data = $request->all();
            $data['tr_code'] = $this->tr_generator(); //must be replaced with the real one
            $data['date'] = jdate("Y/m/d");
            $data['time'] = jdate("H:i:s");
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

    public function refer(Request $request){
        try{
            $data = $request->all();
            $data['date'] = jdate("Y/m/d");
            $data['time'] = jdate("H:i:s");

            $inserted = MelkinouReferLogsModel::create($data);
            if(!$inserted){
                return response()->json([
                    "msg" => "could not be inserted",
                    "statuscode" => 400
                ], 400);
            }
            return response()->json([
                "msg" => "referred successfully",
                "statuscode" => 201
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                "error" => $e->getMessage() . " at line " . $e->getLine(),
                "statuscode" => 500
            ], 500);
        }
    }

    public function updateStatus(Request $request){
        $updated = MelkinouSalingAccessLogs::where("tr_code", $request->tr_code)->update($request->all());
        if(!$updated){
            return response()->json([
                "msg" => "could not be updated",
                "statuscode" => 400
            ], 400);
        }
        return response()->json([
            "msg" => "updated",
            "statuscode" => 200
        ], 200);
    }
}
