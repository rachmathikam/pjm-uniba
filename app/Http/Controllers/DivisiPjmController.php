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
        $lol = [];
        foreach ($divisi_pjm as  $value) {
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
                    'title' => 'Divisi PJM Uniba Madura',
                    'status' => $value->status,

                ];

                    array_push($lol,$array);
        }

            return view('pages.divisi_pjm.index',compact('data','divisi_pjm','kategori','pengurus_divisi','lol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $divisi_pjm = DivisiPjm::leftJoin('kategori_sub_kategori','kategori_sub_kategori.id','divisi_pjms.kategori_sub_kategori_id')
                              ->leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                              ->leftJoin('sub_kategori','sub_kategori.id','kategori_sub_kategori.sub_kategori_id')
                              ->where('kategori_sub_kategori_id',$request->data)
                              ->select('divisi_pjms.*','sub_kategori.sub_kategori','kategori.kategori')
                              ->get();

            $datas = 'Divisi';
            $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                            ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                            ->where('kategori','LIKE','%'.$datas.'%')
                                            ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')
                                            ->get();

        $lol = [];
        foreach ($divisi_pjm as  $value) {
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
        $select = '';
    if($divisi_pjm->IsEmpty()){
        $divisi_pjm .= '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr>';
        $select .= 'disabled';
        return response()->json([
            'status' => 400,
            'message' => 'data berhasil di tambahkan',
            'data' => $lol,
            'select' => $select
        ]);

    }else{
        $select .= 'ada';
        return response()->json([
            'status' => 200,
            'message' => 'data berhasil di tambahkan',
            'data' => $lol,
            'select' => $select,
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
            $datas = 'Divisi';
            $kategori = KategoriSubKategori::leftJoin('kategori','kategori.id','kategori_sub_kategori.kategori_id')
                                            ->leftJoin('sub_kategori','sub_kategori.id', 'kategori_sub_kategori.sub_kategori_id')
                                            ->where('kategori','LIKE','%'.$datas.'%')
                                            ->select('kategori_sub_kategori.id','kategori.kategori','sub_kategori.sub_kategori')
                                            ->get();

            $lol = [];
            foreach ($divisi_pjm as  $value) {
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
              'data' => $lol
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

    public function status(Request $request){
       $data =  DivisiPjm::findOrFail($request->id);
    //    dd($data);
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

    }
}
