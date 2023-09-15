<?php

namespace App\Http\Controllers;

use App\Models\PengurusPersonalia;
use App\Models\KategoriSubKategori;
use App\Models\Kategori;
use App\Models\SubKategori;
use Validator;
use DB;
use Illuminate\Http\Request;

class PengurusPersonaliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(),[
            'nama_pengurus' => 'required',
            'kategori_sub_kategori_id' => 'required|unique:pengurus_personalias',
            'jabatan' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ],[
            'nama_pengurus.required' => 'Nama harus di isi !',
            'kategori_sub_kategori_id.required' => 'kategori harus di isi !',
            'jabatan.required' => 'Jabatan harus di isi !',
            'image.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'image.max' => 'Gambar maksimal size 2mb !',
            'image.required' => 'Gambar harus di isi !',
        ]);


        $file_gambar = $request->file('image');

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            DB::beginTransaction();

                try {
                    $gambar = time() . '_' . $file_gambar->getClientOriginalName();

                   PengurusPersonalia::create([
                        'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                        'nama' => $request->nama_pengurus,
                        'jabatan' => $request->jabatan,
                        'foto' => $gambar,
                    ]);

                    $file_gambar->move(public_path('assets/image/pengurus_personalia'), $gambar);

                    $data = PengurusPersonalia::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','pengurus_personalias.kategori_sub_kategori_id')
                                                ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                                ->select('pengurus_personalias.*','sub_kategori.sub_kategori','kategori.kategori')
                                                ->get();

                    $datas = 'personalia';
                    $kategoris = DB::table('kategori_sub_kategori')
                                    ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                    ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                    ->select('kategori_sub_kategori.id','sub_kategori.sub_kategori')
                                    ->where('kategori','LIKE','%'.$datas.'%')
                                    ->whereNotIn('kategori_sub_kategori.id',DB::table('pengurus_personalias')
                                    ->select('kategori_sub_kategori_id'))
                                    ->get();

                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
                    'data' => $data,
                    'select' => $kategoris
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
     * @param  \App\Models\PengurusPersonalia  $pengurusPersonalia
     * @return \Illuminate\Http\Response
     */
    public function show(PengurusPersonalia $pengurusPersonalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengurusPersonalia  $pengurusPersonalia
     * @return \Illuminate\Http\Response
     */
    public function edit(PengurusPersonalia $pengurusPersonalia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengurusPersonalia  $pengurusPersonalia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengurusPersonalia $pengurusPersonalia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengurusPersonalia  $pengurusPersonalia
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = PengurusPersonalia::findOrFail($request->ids);
        $data->delete();

        $datas = 'personalia';
        $kategoris = DB::table('kategori_sub_kategori')
                        ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                        ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                        ->select('kategori_sub_kategori.id','sub_kategori.sub_kategori')
                        ->where('kategori','LIKE','%'.$datas.'%')
                        ->whereNotIn('kategori_sub_kategori.id',DB::table('pengurus_personalias')
                        ->select('kategori_sub_kategori_id'))
                        ->get();

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil di hapus',
             'select' => $kategoris
        ]);

    }
}
