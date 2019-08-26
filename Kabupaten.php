<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelKabupaten;
use Validator;

class Kabupaten extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "nama saya aulia romadon darmayanti";
        $data = ModelKabupaten::all();
        //return view('kabupaten', compact('data'));
        return view('kabupaten', compact('data'));
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kabupaten_create');
        // kabupaten_create adalah view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'description' => 'required',
        ]); 
        //-> validasi

        $data = new ModelKabupaten();
        $data->kode = $request->kode;
        $data->description = $request->description;
        $data->save();
/*
        $data = new ModelKabupaten();
        $data->nama = "emma watson";
        $data->email = "emma@gmail.com";
        $data->nohp = "+887382938";
        $data->alamat = "LOS ANGELES";
        $data->save();
*/
        return redirect()->route('kabupaten.index')->with('alert_message','Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ModelKabupaten::where('id', $id)->get();
        return view('kabupaten_edit', compact('data'));
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
        $this->validate($request, [
            'kode' => 'required',
            'description' => 'required',
        ]);

        $data = ModelKabupaten::where('id', $id)->first();
        $data->kode = $request->kode;
        $data->description = $request->description;
        $data->save();

        return redirect()->route('kabupaten.index')->with('alert_message', 'Berhasil Mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =ModelKabupaten::where('id', $id)->first();
        $data->delete();

        return redirect()->route('kabupaten.index')->with('alert_message', 'Berhasil menghapus data:)');
    }
}
