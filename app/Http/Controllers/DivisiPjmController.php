<?php

namespace App\Http\Controllers;

use App\Models\DivisiPjm;
use App\Models\KategoriSubKategori;
use App\Models\PengurusDivisiPjm;
use Illuminate\Http\Request;
use DB;
use Validator;

class DivisiPjmController extends Controller
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
                'title' => 'Divisi PJM Uniba Madura',
            ];

            $datas = 'Divisi';
            $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                            ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                            ->where('kategori','LIKE','%'.$datas.'%')
                                            ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')
                                            ->get();

            $pengurus_divisi = PengurusDivisiPjm::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','pengurus_divisi_pjms.kategori_sub_kategori_id')
                                                        ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                        ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                                        ->select('pengurus_divisi_pjms.*','sub_kategori.sub_kategori','kategori.kategori')
                                                        ->get();
                                                        // dd($pengurus_divisi);


             $divisi_pjm = DivisiPjm::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','divisi_pjms.kategori_sub_kategori_id')
                              ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                              ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                              ->select('divisi_pjms.*','sub_kategori.sub_kategori','kategori.kategori')
                              ->get();

            return view('pages.divisi_pjm.index',compact('data','divisi_pjm','kategori','pengurus_divisi'));
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
            'divisi_pjm' => 'required',
            'kategori_sub_kategori_id' => 'required',

        ],[
            'divisi_pjm.required' => 'Personalia harus diisi',
            'kategori_sub_kategori_id.required' => 'Master Kategori harus diisi'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validator->errors(),
            ]);
        }else{
            DivisiPjm::create([
                'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                'deskripsi' => $request->divisi_pjm,
            ]);

            $divisi_pjm = DivisiPjm::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','divisi_pjms.kategori_sub_kategori_id')
                                                        ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                        ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                                        ->select('divisi_pjms.*','sub_kategori.sub_kategori','kategori.kategori')
                                                        ->get();


           return response()->json([
              'status' => 200,
              'message' => 'data berhasil di tambahkan',
              'data' => $divisi_pjm
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DivisiPjm  $DivisiPjm
     * @return \Illuminate\Http\Response
     */
    public function show(DivisiPjm $DivisiPjm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DivisiPjm  $DivisiPjm
     * @return \Illuminate\Http\Response
     */
    public function edit(DivisiPjm $DivisiPjm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DivisiPjm  $DivisiPjm
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, DivisiPjm $DivisiPjm)
    {
        $validator = Validator::make($request->all(), [
            'divisi_pjm_edit' =>'required',

        ],[
            'divisi_pjm_edit.required' => 'Devisi Eksplorasi Data harus di isi'
        ]);

        $id = explode('data',$request->id);


            if($validator->fails()){
                return response()->json([
                   'status' => 400,
                    'errors' =>'silahkan input semua Profile yang anda tambahkan',
                    'data' =>  $validator->errors(),
                ]);

            }else{
                $data = DivisiPjm::findOrFail($id[1]);
                $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                                ->where('kategori_sub_kategori.id','LIKE','%'.$request->kategori_sub_kategori_id.'%')
                                                ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')->first();
                $datas = [
                            'kategori_sub_kategori_id' => $kategori->kategori.' '.'-'.' '.$kategori->sub_kategori,
                            'deskripsi' => $request->divisi_pjm_edit
                ];

                $data->update([
                    'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                    'deskripsi' => $request->divisi_pjm_edit,
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
     * @param  \App\Models\DivisiPjm  $DivisiPjm
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->ids as $id) {
            DivisiPjm::destroy($id);
        }

        $personalia = DivisiPjm::all();
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
        return response()->json([
          'status' => 200,
          'message' => 'data berhasil di hapus',
          'data' => $request->ids
        ]);
    }
}
