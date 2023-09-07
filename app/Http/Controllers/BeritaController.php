<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Validator;
use Auth;
class BeritaController extends Controller
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
        'title' => 'Berita'
    ];

    $berita = Berita::join('users','users.id','beritas.user_id')
                        ->select('beritas.*','users.name')->get();



    return view('pages.berita.index',compact('data','berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'company' => 'PJM - Uniba Madura',
            'title' => 'Berita'
        ];
        return view('pages.berita.create',compact('data'));
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
            'isi_berita' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'user_id' => 'nullable',

        ],[
            'judul.required' => 'Judul harus di isi !',
            'isi_berita.required' => 'Isi Berita harus di isi !',
            'image.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'image.max' => 'Gambar maksimal size 2mb !',
            'image.required' => 'Gambar harus di isi !',
        ]);

        $replaced = str_replace(' ', '-', $request->judul);

        $file_gambar = $request->file('image');

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            $gambar = time() . '_' . $file_gambar->getClientOriginalName();
            $data = Berita::create([
                'slug' => $replaced,
                'judul' => $request->judul,
                'isi_berita' => $request->isi_berita,
                'gambar' => $gambar,
                'user_id' => Auth::id(),
                'status' => 'no_publish'
            ]);

            if($data){
                $file_gambar->move(public_path('frontend_assets/image/berita'), $gambar);

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
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'company' => 'PJM - Uniba Madura',
            'title' => 'Berita'
        ];

        $datas = Berita::where('slug',$id)->first();


        return view('pages.berita.edit',compact('data','datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'judul' =>'required',
            'isi_berita' =>'required',
            'image' =>'image|mimes:jpg,png,jpeg|max:5120',
            'user_id' => 'nullable',
        ],[
            'judul.required' => 'Judul harus di isi!',
            'isi_berita.required' => 'Isi Berita harus di isi!',
            'image.image' => 'Gambar harus type jpg,png,jpeg,gif,svg!',
            'image.max' => 'Gambar maksimal size 2mb!',
        ]);

        $replaced = str_replace(' ', '-', $request->judul);
        $file_gambar = $request->file('image');

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{

            if(!empty($file_gambar)){
                $gambar = time() . '_' . $file_gambar->getClientOriginalName();
                $path = public_path('frontend_assets/image/berita/').$request->old_gambar;
            }else{
                $gambar = $request->old_gambar;
            }

            $data = Berita::where('slug',$request->old_slug)->first();

            $data->update([
                'slug' => $replaced,
                'judul' => $request->judul,
                'isi_berita' => $request->isi_berita,
                'gambar' => $gambar,
                'user_id' => Auth::id(),
                'status' => 'no_publish'
            ]);

            if($data ){
                if(!empty($file_gambar)){
                    unlink($path);
                    $file_gambar->move(public_path('frontend_assets/image/berita'), $gambar);
                }
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
                ]);
            }else{
                return response()->json([
                   'status' => 401,
                    'errors' => 'Data gagal di tambahkan',
                ]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = explode('data', $request->ids);
        $data = Berita::findOrFail($id[1]);
        $path = public_path('frontend_assets/image/berita/').$data->gambar;
        if(unlink($path)){
            $data->delete();
            return response()->json([
              'status' => 200,
              'message' => 'Data berhasil di hapus',
              'data' => $id[1]
            ]);
        }
    }
}
