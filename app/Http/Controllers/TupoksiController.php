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



        $lol = [];
        foreach ($tupoksi as  $value) {
                $color = '';
                if($value->status == 'publish') {
                    $color = '#28a745'; // hijau
                }else{
                        $color = '#f00'; // kuning
                }
                $array = [
                    'id' => $value->id,
                    'color' => $color,
                    'kategori' => $value->kategori,
                    'sub_kategori' => $value->sub_kategori,
                    'deskripsi' => $value->deskripsi,
                    'company' => 'PJM - Uniba Madura',
                    'title' => 'Tupoksi PJM',
                    'status' => $value->status,

                ];

                    array_push($lol,$array);
                    // dd($lol);
        }

        return view('pages.tupoksi.index', compact('tupoksi', 'data','kategori','lol'));
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
            'tupoksi' => 'required',
            'kategori_sub_kategori_id' => 'required',

        ],[
            'tupoksi.required' => 'Deskripsi harus diisi',
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

            $datas = 'Tupoksi';
            $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                            ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                            ->where('kategori','LIKE','%'.$datas.'%')
                                            ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')->get();

            $data = Tupoksi::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','tupoksis.kategori_sub_kategori_id')
                            ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                            ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                            ->select('tupoksis.*','sub_kategori.sub_kategori','kategori.kategori')
                            ->get();

                            $lol = [];
                            foreach ($data as  $value) {
                                    $color = '';
                                    if($value->status == 'publish') {
                                        $color = '#28a745'; // hijau
                                    }else{
                                            $color = '#f00'; // kuning
                                    }
                                    $array =[

                                    ];
                                      $string = '<tr id="data'.$value->id.'">
                                      <td><input type="checkbox" name="ids"
                                              class="checkbox_ids ml-3 checkbox-item" value="'.$value->id.'">
                                      </td>
                                      <td>
                                          <span class="editSpan kategori_sub_kategori_id">'.$value->kategori.' -
                                          '.$value->sub_kategori.'</span>
                                          <select name="kategori_sub_kategori_id"
                                              class="form-control editInput kategori_sub_kategori_id mb-2">';
                                                foreach ($kategori as  $item) {
                                                    $string .=' <option value="'.$item->id.'">'.$item->kategori.' -
                                                    '.$item->sub_kategori.'</option>';
                                                }

                                        $string .= '</select>
                                      </td>
                                      <td>
                                          <span class="editSpan deskripsi">'.$value->deskripsi.'</span>
                                          <input type="text" class="editInput deskripsi form-control"
                                              id="divisi_pjm_edit" name="divisi_pjm_edit"
                                              value="'.$value->deskripsi.'">
                                          <div class="invalid-feedback" id="divisi_pjm_edit-error">

                                          </div>
                                      </td>
                                      <td>
                                      <select name="status" id="status'.$value->id.'" class="status text-center" onchange="status('.$value->id.')" style="background-color: '.$color.'; color:white;">';

                                      if($value->status == 'publish') {
                                        $string .= ' <option selected value="publish">Publish</option>
                                                    <option value="non_publish">No Publish</option>';
                                    } else {
                                        $string .= ' <option  value="publish">Publish</option>
                                                    <option selected value="non_publish">No Publish</option>';
                                    }

                                    $string .= '</select>
                                    </td>
                                    <td style="width: 15%">
                                        <button class="btn text-warning btn-sm edit_inline"><i
                                                class="fa fa-edit"></i></button>
                                        <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                                class="fa fa-check"></i></button>
                                        <button class="btn text-danger editCancel btn-sm"
                                            style="display: none"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>';


                                        array_push($lol,$string);
                            }

        return response()->json([
              'status' => 200,
              'message' => 'data berhasil di tambahkan',
              'data' => $lol,
           ]);
        }
    }


    public function status(Request $request){
        $data =  Tupoksi::findOrFail($request->id);

        $data->update([
             'status' => $request->status
        ]);

        $color = '';

        if($request->status == 'publish'){
            $color = '#28a745';
        }else{
             $color = '#f00';
        }
        return response()->json([
         'status' => 200,
         'data' => $request->id,
         'color' => $color
        ]);
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
