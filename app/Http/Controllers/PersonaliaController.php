<?php

namespace App\Http\Controllers;

use App\Models\Personalia;
use App\Models\PengurusPersonalia;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\KategoriSubKategori;
use DB;
use Illuminate\Http\Request;
use Validator;
class PersonaliaController extends Controller
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
            'title' => 'Personalia'
        ];

        $datas = 'Personalia';
        $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                        ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                        ->where('kategori','LIKE','%'.$datas.'%')
                                        ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')
                                        ->get();
         $kategoris = DB::table('kategori_sub_kategori')
                        // ->leftJoin('kategori_sub_kategori','kategori_sub_kategori.id', 'pengurus_personalias.kategori_sub_kategori_id')
                        ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                        ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                        ->select('kategori_sub_kategori.id','sub_kategori.sub_kategori')
                        ->where('kategori','LIKE','%'.$datas.'%')
                        ->whereNotIn('kategori_sub_kategori.id',DB::table('pengurus_personalias')
                        ->select('kategori_sub_kategori_id'))
                        ->get();

        $personalia = Personalia::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','personalias.kategori_sub_kategori_id')
                          ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                          ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                          ->select('personalias.*','sub_kategori.sub_kategori','kategori.kategori')
                          ->get();

        $pengurus_personalias = PengurusPersonalia::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','pengurus_personalias.kategori_sub_kategori_id')
                                ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                ->select('pengurus_personalias.*','sub_kategori.sub_kategori','kategori.kategori')
                                ->get();
         


        return view('pages.personalia.index',compact('data','personalia','kategori','pengurus_personalias','kategoris'));
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
            'personalia' => 'required',
            'kategori_sub_kategori_id' => 'required',

        ],[
            'personalia.required' => 'Personalia harus diisi',
            'kategori_sub_kategori_id.required' => 'Master Kategori harus diisi'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validator->errors(),
            ]);
        }else{
            Personalia::create([
                'kategori_sub_kategori_id' => $request->kategori_sub_kategori_id,
                'deskripsi' => $request->personalia,
            ]);

            $personalia = Personalia::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','personalias.kategori_sub_kategori_id')
                                    ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                    ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                                    ->select('personalias.*','sub_kategori.sub_kategori','kategori.kategori')
                                    ->get();

           return response()->json([
              'status' => 200,
              'message' => 'data berhasil di tambahkan',
              'data' => $personalia
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
    public function show(Personalia $personalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
    public function edit(Personalia $personalia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
        public function updated(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'personalia' =>'required',

            ],[
                'personalia.required' => 'Personalia harus di isi'
            ]);

            $id = explode('data',$request->id);


                if($validator->fails()){
                    return response()->json([
                       'status' => 400,
                        'errors' =>'silahkan input semua Profile yang anda tambahkan',
                        'data' =>  $validator->errors(),
                    ]);

                }else{
                    $data = Personalia::findOrFail($id[1]);
                    $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                                    ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                                    ->where('kategori_sub_kategori.id','LIKE','%'.$request->kategori_sub_kategori_id.'%')
                                                    ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')->first();
                    $datas = [
                                'kategori_sub_kategori_id' => $kategori->kategori.' '.'-'.' '.$kategori->sub_kategori,
                                'deskripsi' => $request->personalia
                    ];

                    $data->update([
                        'deskripsi' => $request->personalia,
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
     * @param  \App\Models\Personalia  $personalia
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->ids as $id) {
            Personalia::destroy($id);
        }

        $personalia = Personalia::all();
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
