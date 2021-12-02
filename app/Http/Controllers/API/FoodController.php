<?php

namespace App\Http\Controllers\API;

use App\Food;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        // $limit = $request->input('limit', 6);
        $name = $request->input('name');

        if ($id) {
            $food = Food::find($id);

            if ($food) {
                return ResponseFormatter::success(
                    $food,
                    'Data Food Berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
            }
        }

        $food = Food::all();

        if ($name) {
            $food = Food::where('name', 'like', '%' . $name . '%')->get();
        }

        return ResponseFormatter::success(
            $food,
            'Data List Food Berhasil diambil'
        );
    }
}
