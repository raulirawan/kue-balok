<?php

namespace App\Http\Controllers\Admin;

use App\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        return view('admin.food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'required|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'kategori' => 'required',
            'description' => 'required',
        ]);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public/assets/food');
        }

        $result = Food::create($data);

        if ($result != null) {
            return redirect()->route('food.index')->with('success', 'Data Berhasil di Tambahkan!');
        } else {
            return redirect()->route('food.index')->with('error', 'Data Gagal di Tambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.food.detail', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'kategori' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();

        $item = Food::findOrFail($id);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('public/assets/food');

            if (Storage::exists($item->photo)) {
                Storage::delete($item->photo);
            }
        }

        $result = $item->update($data);

        if ($result != null) {
            return redirect()->route('food.index')->with('success', 'Data Berhasil di Update!');
        } else {
            return redirect()->route('food.index')->with('error', 'Data Gagal di Update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Food::findOrFail($id);

        if (Storage::exists($item->photo)) {
            Storage::delete($item->photo);
        }
        $result = $item->delete();

        if ($result != null) {
            return redirect()->route('food.index')->with('success', 'Data Berhasil di Hapus!');
        } else {
            return redirect()->route('food.index')->with('error', 'Data Gagal di Hapus!');
        }
    }
}
