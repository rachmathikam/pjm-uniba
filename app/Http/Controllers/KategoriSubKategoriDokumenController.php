<?php

namespace App\Http\Controllers;

use App\Models\KategoriSubKategoriDokumen;
use App\Models\KategoriDokumen;
use App\Models\SubKategoriDokumen;
use Validator;
use DB;
use Illuminate\Http\Request;

class KategoriSubKategoriDokumenController extends Controller
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
            'title' => 'Kategori Dokumen'
        ];

        $kategori = KategoriDokumen::all();


         return view('pages.kategori_dokumen.index',compact('data','kategori'));

    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori' => 'required|unique:kategori_dokumens',

        ],[
            'kategori.required' => 'Kategori harus di isi!',
            'kategori.unique' => 'Kategori sudah ada sebelumnnya !',
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            DB::beginTransaction();
                try {
                    if(!empty($request->kategori)){
                        $kategori = KategoriDokumen::create([
                            'kategori' => $request->kategori,
                        ]);
                    }
                    $data =  kategoriDokumen::all();
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
                    'data' => $data
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 401,
                    'errors' => 'data gagal di tambahkan',
                ]);

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriSubKategoriDokumen  $kategoriSubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriSubKategoriDokumen $kategoriSubKategoriDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriSubKategoriDokumen  $kategoriSubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriSubKategoriDokumen $kategoriSubKategoriDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriSubKategoriDokumen  $kategoriSubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori' => 'required',

        ],[
            'kategori.required' => 'Kategori harus di isi!',
            'kategori.unique' => 'Kategori sudah ada sebelumnnya !',
        ]);

        $id = explode('data', $request->id);
        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            DB::beginTransaction();
                try {
                    if(!empty($request->kategori)){
                        $kategori = kategoriDokumen::findOrFail($id[1]);
                        $kategori->update([
                            'kategori' => $request->kategori,
                        ]);
                    }
                    $data =  [
                        'kategori' => $request->kategori
                    ];

                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
                    'data' => $data
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 401,
                    'errors' => 'data gagal di tambahkan',
                ]);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriSubKategoriDokumen  $kategoriSubKategoriDokumen
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->ids as $id) {
             KategoriDokumen::destroy($id);
        }

        $personalia =  KategoriDokumen::all();
        $select = '';
        if($personalia->isEmpty()){
           $select .= 'disabled';
        }else{
             $select .= 'ada';
        }
        // dd($select);

        return response()->json([
          'status' => 200,
          'message' => 'data berhasil di hapus',
          'data' => $request->ids,
          'select' => $select
         ]);
    }
}
