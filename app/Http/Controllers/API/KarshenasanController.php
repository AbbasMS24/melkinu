<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karshenasan;
use Illuminate\Http\Request;

class KarshenasanController extends Controller
{
    // لیست همه کارشناسان
    public function index()
    {
        return Karshenasan::all();
    }

    // به‌روزرسانی اطلاعات یک کارشناس
    public function update(Request $request, $id)
    {
        $user = Karshenasan::findOrFail($id);

        $user->update($request->only([
            'name', 'lname', 'username', 'b_date', 'level', 'region'
        ]));

        return response()->json(['message' => 'Updated successfully', 'user' => $user]);
    }

    // حذف یک کارشناس
    public function destroy($id)
    {
        $user = Karshenasan::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    // لیست یکتا از سطوح (level)
    public function getLevels()
    {
        $levels = Karshenasan::select('level')->distinct()->pluck('level');

        return response()->json($levels);
    }
}
