<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\KategoriSubKategoriDokumen;
use App\Models\SubKategoriDokumen;
use Validator;
use Illuminate\Http\Request;

class DokumenController extends Controller
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
            'title' => 'Dokumen PJM Uniba Madura',
        ];

          $datas = 'Dokumen';
          $kategori = KategoriSubKategoriDokumen::leftJoin('kategori_dokumens','kategori_dokumens.id','kategori_sub_kategori_dokumens.kategori_dokumen_id')
                                        ->leftJoin('sub_kategori_dokumens','sub_kategori_dokumens.id','kategori_sub_kategori_dokumens.sub_kategori_dokumen_id')
                                        ->select('kategori_sub_kategori_dokumens.id','kategori_dokumens.kategori','sub_kategori_dokumens.sub_kategori')
                                        ->get();



         $dokumen = Dokumen::leftJoin('kategori_sub_kategori_dokumens','kategori_sub_kategori_dokumens.id','dokumens.kategori_sub_kategori_dokumen_id')
                          ->leftJoin('kategori_dokumens','kategori_dokumens.id','kategori_sub_kategori_dokumens.kategori_dokumen_id')
                          ->select('dokumens.*','kategori_dokumens.kategori')
                          ->get();
    $lol = [];
    foreach ($dokumen as  $value) {
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
                'slug' => $value->slug,
                'file' => $value->file,
                'company' => 'PJM - Uniba Madura',
                'title' => 'Divisi PJM Uniba Madura',
                // 'status' => $value->status,

            ];

                array_push($lol,$array);
    }

        return view('pages.dokumen.index',compact('data','dokumen','kategori','lol'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'judul' => 'required',
            'file_dokumen' => 'required|mimes:pdf',
            'kategori_sub_kategori_id' => 'required',
        ],[
            'judul.required' => 'Judul harus di isi !',
            'kategori_sub_kategori_id.required' => 'Kategori Harus di isi !',
            'file_dokumen.required' => 'File Harus di isi!',
            'file_dokumen.mimes' => 'File yang di inputkan harus PDF !',
        ]);

        $replaced = str_replace(' ', '-', $request->judul);
        $file_pdf = $request->file('file_dokumen');
        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $pdf = time() . '_' . $file_pdf->getClientOriginalName();
            $data = Dokumen::create([
                'kategori_sub_kategori_dokumen_id' => $request->kategori_sub_kategori_id,
                'slug' => $replaced,
                'judul' => $request->judul,
                'file' => $pdf,
            ]);

            if($data){
                $file_pdf->move(public_path('assets/pdf/dokumen'), $pdf);

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
                ]);
            }else{
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
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $dokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Dokumen $dokumen)
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
