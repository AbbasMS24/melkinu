<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MelkinouProvinceCitiesModel;
use App\Models\MelkinouRegionsModel;
use Illuminate\Support\Facades\DB;

class ProvinceCitiesController extends Controller
{
    public function register(Request $request){
        try{
            $data = $request->all();
            DB::beginTransaction();
                MelkinouProvinceCitiesModel::create($data);
                MelkinouRegionsModel::create($data);
            DB::commit();

            return response()->json([
                "msg" => "inserted",
                "statuscode" => 201
            ], 201);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                "error" => $e->getMessage() . " at line " . $e->getLine(),
                "statuscode" => 500
            ], 500);
        }
    }

    public function fetchProvince(){
        try{
            $data = MelkinouRegionsModel::with([
                "province_cities"
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

    public function updateProvince(Request $request){
        try{
            $up1 = MelkinouProvinceCitiesModel::where("id", $request->id)->update($request->all());
            $up2 = MelkinouRegionsModel::where("code", $request->id)->update($request->all());

            if($up1 && $up2){
                return response()->json([
                    "msg" => "updated",
                    "statuscode" => 200
                ], 200);
            }
        }catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage() . " at line " . $e->getLine(),
                "statuscode" => 500
            ], 500);
        }
    }

    public function deleteProvince(Request $request){
        try{
            $d1 = MelkinouProvinceCitiesModel::where("id", $request->id)->delete();
            $d2 = MelkinouRegionsModel::where("code", $request->id)->delete();

            if($d1 && $d2){
                return response()->json([
                    "msg" => "deleted",
                    "statuscode" => 200
                ], 200);
            }
            return response()->json([
                "msg" => "could not be uploaded",
                "statuscode" => 400
            ], 400);
        }catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage() . " at line " . $e->getLine(),
                "statuscode" => 500
            ], 500);
        }
    }
}
