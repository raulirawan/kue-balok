<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'email' => 'required|unique:users,email',
            'password' => 'required|string',
            'phoneNumber' => 'required|numeric',
            'address' => 'required'
        ]);

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['roles'] = 'PELANGGAN';

        $result = User::create($data);

        if($result != null) {
            return redirect()->route('user.index')->with('success','Data Berhasil di Tambahkan!');
        } else {
            return redirect()->route('user.index')->with('error','Data Gagal di Tambahkan!');

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
        $user = User::findOrFail($id);
        return view('admin.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
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
            'email' => 'unique:users,email,'. $id,
            'phoneNumber' => 'required|numeric',
            'address' => 'required'
        ]);

        $data = $request->all();

        $item = User::findOrFail($id);

        $result = $item->update($data);

        if($result != null) {
            return redirect()->route('user.index')->with('success','Data Berhasil di Update!');
        } else {
            return redirect()->route('user.index')->with('error','Data Gagal di Update!');

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
        $item = User::findOrFail($id);

        $result = $item->delete();

        if($result != null) {
            return redirect()->route('user.index')->with('success','Data Berhasil di Hapus!');
        } else {
            return redirect()->route('user.index')->with('error','Data Gagal di Hapus!');

        }
    }
}
