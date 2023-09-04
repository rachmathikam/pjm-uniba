<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Validator;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'company' => 'PJM - Uniba Madura',
            'title' => 'Visi-Misi & Tujuan'
        ];
        // dd($data);

        $visiMisi = VisiMisi::all();


        return view('pages.visimisi.index',compact('data','visiMisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editVisiMisi(Request $request)
    {
        // dd($request->all());
        $id = explode("data", $request->id);
        $data = VisiMisi::findOrfail($id[1]);

        $data->update([
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi

        ]);
        $datas = [
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi
        ];
        // dd($datas);
        if($data){

            return response()->json([
                'status' => 200,
                'message' => 'data berhasil di update',
                'data' => $datas,
             ]);
        }
    }

    public function tambahVisi(Request $request)
    {
        dd($request->visi);
        $validator = Validator::make($request->all(), [
            'visi' => 'required|array|min:1',
            'visi.*' => 'required|string',
        ]);


            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => 'silahkan input semua visi yang anda tambahkan  ',
                ]);

            }else{
                foreach ($request->all() as $key => $i) {
                    foreach ($i as $a) {
                        VisiMisi::create([
                            'kategori' => $key,
                            'deskripsi' => $a,
                        ]);

                    }
               }
               $data = VisiMisi::all();
               return response()->json([
                  'status' => 200,
                  'message' => 'data berhasil di tambahkan',
                  'data' => $data,
               ]);
            }
    }

    public function tambahMisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string',
        ]);


            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => 'silahkan input semua misi yang anda tambahkan  ',
                ]);

            }else{
                foreach ($request->all() as $key => $i) {
                    foreach ($i as $a) {
                        VisiMisi::create([
                            'kategori' => $key,
                            'deskripsi' => $a,
                        ]);

                    }
               }
               $data = VisiMisi::all();
               return response()->json([
                  'status' => 200,
                  'message' => 'data berhasil di tambahkan',
                  'data' => $data,
               ]);
            }
    }

    public function tambahTujuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tujuan' => 'required|array|min:1',
            'tujuan.*' => 'required|string',
        ]);


            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => 'silahkan input semua Tujuan yang anda tambahkan  ',
                ]);

            }else{
                foreach ($request->all() as $key => $i) {
                    foreach ($i as $a) {
                        VisiMisi::create([
                            'kategori' => $key,
                            'deskripsi' => $a,
                        ]);

                    }
               }
               $data = VisiMisi::all();
               return response()->json([
                  'status' => 200,
                  'message' => 'data berhasil di tambahkan',
                  'data' => $data,
               ]);
            }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function show(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function edit(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisiMisi  $visiMisi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $x) {
            $datas = VisiMisi::findOrFail($x);
               $datas->delete();
        }

        $visiMisi = VisiMisi::all();
        $select = '';
        if($visiMisi->isEmpty()){
           $select .= 'disabled';
        }else{
             $select .= 'ada';
        }
        // dd($select);

        return response()->json([
          'status' => 200,
          'message' => 'data berhasil di hapus',
          'data' => $visiMisi,
          'select' => $select
         ]);
    }
}
