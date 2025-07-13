<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketStatus;
use App\Models\TicketWorkflow;


class TicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sender' => 'required|string',
            'receptor' => 'nullable|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'station' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf',
        ]);

        // تولید tr_code بین 1000 تا 9999 به صورت یکتا
        $lastCode = TicketStatus::max('tr_code');
        $tr_code = $lastCode ? $lastCode + 1 : 1000;

        // if ($tr_code > 9999) {
        //     return response()->json(['error' => 'حداکثر تعداد تیکت‌ها ثبت شده است.'], 400);
        // }


        // ذخیره فایل در صورت وجود
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')
                ->storeAs("private/tickets", $tr_code . '.' . $request->file('attachment')->extension());

            if ($attachmentPath) {
                // ذخیره وضعیت
                TicketStatus::create([
                    'tr_code' => $tr_code,
                    'status' => 1
                ]);

                // ثبت پیام در workflow
                TicketWorkflow::create(array(
                    'tr_code' => $tr_code,
                    'sender' => $request->sender,
                    'receptor' => $request->receptor,
                    'date' => now()->toDateString(),
                    'time' => now()->toTimeString(),
                    'title' => $request->title,
                    'content' => $request->text_content,
                    'attachment' => $request->attachment,
                    'station' => $request->station,
                ));

                return response()->json([
                    'message' => 'تیکت با موفقیت ثبت شد',
                    'tr_code' => $tr_code,
                    "statuscode" => 201
                ], 201);
            }

            return response()->json([
                "msg" => "not uploaded",
                "statuscode" => 400
            ], 400);
        }

        // ذخیره وضعیت
        TicketStatus::create([
            'tr_code' => $tr_code,
            'status' => 1
        ]);

        // ثبت پیام در workflow
        TicketWorkflow::create([
            'tr_code' => $tr_code,
            'sender' => $request->sender,
            'receptor' => $request->receptor,
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
            'title' => $request->title,
            'content' => $request->text_content,
            'attachment' => $request->attachment,
            'station' => $request->station,
        ]);

        return response()->json([
            'message' => 'تیکت با موفقیت ثبت شد',
            'tr_code' => $tr_code,
            "statuscode" => 201
        ], 201);
    }


    public function fetch(){
        $info = TicketStatus::with(["workflows"])-> get();

        if($info-> isEmpty()){
            return response()->json([
                "statuscode" => 404
            ], 404);
        }

        return response()-> json([
            "data"=> $info,
            "statuscode"=> 200
        ], 200);

    }
}
