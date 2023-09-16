<?php

namespace App\Http\Controllers;

use App\Models\DevisiEksplorasiData;
use App\Models\KategoriSubKategori;
use Illuminate\Http\Request;
use DB;
use Validator;

class DevisiEksplorasiDataController extends Controller
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
                'title' => 'Divisi Eksplorasi'
            ];

            $datas = 'Divisi Eksplorasi Data';
            $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                            ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                            ->where('kategori','LIKE','%'.$datas.'%')
                                            ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')
                                            ->get();
                                            // dd($kategori);



             $devisi_eksplorasi_data = DevisiEksplorasiData::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','devisi_eksplorasi_data.kategori_sub_kategori_id')
                              ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                              ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                              ->select('devisi_eksplorasi_data.*','sub_kategori.sub_kategori','kategori.kategori')
                              ->get();

            return view('pages.devisi_eksplorasi_data.index',compact('data','devisi_eksplorasi_data','kategori'));
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
            'devisi_eksplorasi_data' => 'required',
            'kategori_sub_kategori_id' => 'required',

        ],[
            'devisi_eksplorasi_data.required' => 'Personalia harus diisi',
            'kategori_sub_kategori_id.required' => 'Master Kategori harus diisi'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validator->errors(),
            ]);
        }else{
            DevisiEksplorasiData::create([
                'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                'deskripsi' => $request->devisi_eksplorasi_data,
            ]);

            $devisi_eksplorasi_data = DevisiEksplorasiData::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','devisi_eksplorasi_data.kategori_sub_kategori_id')
                                    ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                    ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                    ->select('devisi_eksplorasi_data.*','sub_kategori.sub_kategori','kategori.kategori')
                                    ->get();

           return response()->json([
              'status' => 200,
              'message' => 'data berhasil di tambahkan',
              'data' => $devisi_eksplorasi_data
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DevisiEksplorasiData  $devisiEksplorasiData
     * @return \Illuminate\Http\Response
     */
    public function show(DevisiEksplorasiData $devisiEksplorasiData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DevisiEksplorasiData  $devisiEksplorasiData
     * @return \Illuminate\Http\Response
     */
    public function edit(DevisiEksplorasiData $devisiEksplorasiData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DevisiEksplorasiData  $devisiEksplorasiData
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, DevisiEksplorasiData $devisiEksplorasiData)
    {
        $validator = Validator::make($request->all(), [
            'devisi_eksplorasi_data_edit' =>'required',

        ],[
            'devisi_eksplorasi_data_edit.required' => 'Devisi Eksplorasi Data harus di isi'
        ]);

        $id = explode('data',$request->id);


            if($validator->fails()){
                return response()->json([
                   'status' => 400,
                    'errors' =>'silahkan input semua Profile yang anda tambahkan',
                    'data' =>  $validator->errors(),
                ]);

            }else{
                $data = DevisiEksplorasiData::findOrFail($id[1]);
                $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                                ->where('kategori_sub_kategori.id','LIKE','%'.$request->kategori_sub_kategori_id.'%')
                                                ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')->first();
                $datas = [
                            'kategori_sub_kategori_id' => $kategori->kategori.' '.'-'.' '.$kategori->sub_kategori,
                            'deskripsi' => $request->devisi_eksplorasi_data_edit
                ];

                $data->update([
                    'deskripsi' => $request->devisi_eksplorasi_data_edit,
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
     * @param  \App\Models\DevisiEksplorasiData  $devisiEksplorasiData
     * @return \Illuminate\Http\Response
     */
    public function destroy(DevisiEksplorasiData $devisiEksplorasiData)
    {
        //
    }
}
