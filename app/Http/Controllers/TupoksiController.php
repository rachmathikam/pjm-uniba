<?php

namespace App\Http\Controllers;

use App\Models\Tupoksi;
use App\Models\KategoriSubKategori;
use Validator;
use Illuminate\Http\Request;

class TupoksiController extends Controller
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
            'title' => 'Tupoksi PJM'
        ];
        $datas = 'Tupoksi';
        $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                        ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                        ->where('kategori','LIKE','%'.$datas.'%')
                                        ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')->get();

        $tupoksi = Tupoksi::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','tupoksis.kategori_sub_kategori_id')
                          ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                          ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                          ->select('tupoksis.*','sub_kategori.sub_kategori','kategori.kategori')
                          ->get();

       



        return view('pages.tupoksi.index', compact('tupoksi', 'data','kategori'));
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
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'kategori_sub_kategori_id' => 'required',

        ],[
            'deskripsi.required' => 'Deskripsi harus diisi',
            'kategori_sub_kategori_id.required' => 'Master Kategori harus diisi'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validator->errors(),
            ]);
        }else{
            Tupoksi::create([
                'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                'deskripsi' => $request->tupoksi,
            ]);

           return response()->json([
              'status' => 200,
              'message' => 'data berhasil di tambahkan',
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tupoksi  $tupoksi
     * @return \Illuminate\Http\Response
     */
    public function show(Tupoksi $tupoksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tupoksi  $tupoksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Tupoksi $tupoksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tupoksi  $tupoksi
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $id = explode('data', $request->id);
        $validator = Validator::make($request->all(), [
            'tupoksi' => 'required',
            'kategori_sub_kategori_id' => 'required',

        ],[
            'tupoksi.required' => 'Tupoksi harus diisi',
            'kategori_sub_kategori_id.required' => 'Master Kategori harus diisi'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validator->errors(),
            ]);

        }else{
            $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                            ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                            ->where('kategori_sub_kategori.id','LIKE','%'.$request->kategori_sub_kategori_id.'%')
                                            ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')->first();
            $datas = [
                'kategori_sub_kategori_id' => $kategori->kategori.' '.'-'.' '.$kategori->sub_kategori,
                'deskripsi' => $request->tupoksi
            ];
                                // dd($datas);

            $data = Tupoksi::findOrFail($id[1]);
            $data->update([
                'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                'deskripsi' => $request->tupoksi,
            ]);


           return response()->json([
              'status' => 200,
              'message' => 'data berhasil di update',
              'data' => $datas
           ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tupoksi  $tupoksi
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $x) {
            $datas = Tupoksi::findOrFail($x);
               $datas->delete();
        }

        $tupoksi = Tupoksi::all();
        $select = '';
        if($tupoksi->isEmpty()){
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
