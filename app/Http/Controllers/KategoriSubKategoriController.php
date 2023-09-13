<?php

namespace App\Http\Controllers;

use App\Models\KategoriSubKategori;
use App\Models\SubKategori;
use App\Models\Kategori;

use Illuminate\Http\Request;
use Validator;
use DB;

class KategoriSubKategoriController extends Controller
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
            'title' => 'Master Kategori'
        ];

        $kategoriSubKategori = KategoriSubKategori::join('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                  ->join('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                                  ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')
                                                  ->get();
        $kategori = Kategori::all();
        // $kategoris = DB::table('kategori')
        //         ->select('kategori.id','kategori.kategori')
        //         ->whereNotIn('kategori.id',DB::table('kategori_sub_kategori')
        //         ->select('kategori_id'))->get();

        $subKategori = SubKategori::all();
        $subKategoris = DB::table('sub_kategori')
                        ->select('sub_kategori.id','sub_kategori.sub_kategori')
                        ->whereNotIn('sub_kategori.id',DB::table('kategori_sub_kategori')
                        ->select('sub_kategori_id'))->get();


        return view('pages.kategori.index',compact('data','kategoriSubKategori','kategori','subKategori','subKategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function kategori(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori' => 'required|unique:kategori',

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
                        $kategori = Kategori::create([
                            'kategori' => $request->kategori,
                        ]);
                    }
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
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

    public function sub(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori' => 'required_without_all:sub_kategori|unique:kategori',
            'sub_kategori' => 'required_without_all:sub_kategori|unique:sub_kategori',


        ],[
            'kategori.required_without_all' => 'Kategori Atau Sub Kategori harus di isi!',
            'sub_kategori.required_without_all' => 'Kategori Atau Sub Kategori harus di isi!',
            'kategori.unique' => 'Kategori sudah ada sebelumnnya !',
            'sub_kategori.unique' => 'Sub Kategori sudah ada sebelumnnya !',
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
                        $kategori = Kategori::create([
                            'kategori' => $request->kategori,
                        ]);
                    }
                    if(!empty($request->sub_kategori)){
                        $subkategori = SubKategori::create([
                            'sub_kategori' => $request->sub_kategori,
                        ]);
                    }

                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
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


    public function master(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'kategori_id' => 'required',
            'sub_kategori_id' => 'required|unique:kategori_sub_kategori',


        ],[
            'kategori_id.required' => 'Kategori Atau Sub Kategori harus di isi!',
            'sub_kategori_id.required' => 'Kategori Atau Sub Kategori harus di isi!',
            'kategori_id.unique' => 'Kategori sudah ada sebelumnnya !',
            'sub_kategori_id.unique' => 'Sub Kategori sudah ada sebelumnnya !',
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

                        $kategori = KategoriSubKategori::create([
                            'kategori_id' => $request->kategori_id,
                            'sub_kategori_id' => $request->sub_kategori_id,

                        ]);

                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
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
     * @param  \App\Models\KategoriSubKategori  $kategoriSubKategori
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriSubKategori $kategoriSubKategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriSubKategori  $kategoriSubKategori
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriSubKategori $kategoriSubKategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriSubKategori  $kategoriSubKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriSubKategori $kategoriSubKategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriSubKategori  $kategoriSubKategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriSubKategori $kategoriSubKategori)
    {
        //
    }
}
