<?php

namespace App\Http\Controllers;

use App\Models\KategoriSubKategori;
use App\Models\Profile;
use App\Models\Kategori;
use App\Models\SubKategori;

use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = \DB::table('kategori_sub_kategori')->join('kategori','kategori.id','kategori_sub_kategori.kategori_id')->where('kategori','profile')->first();

        if (is_null($check)) {
            abort(404);
        }

        $data = [
            'company' => 'PJM - Uniba Madura',
            'title' => 'Profile'
        ];
        $profile = Profile::all();
        return view('pages.profile.index',compact('data','profile'));
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
            'profile' => 'required',

        ],[
            'profile.required' => 'Profile harus diisi'
        ]);

        $profile = 'Profile';
        $subprofile = 'Profile';

        $kategori = Kategori::where('kategori',$profile)->first();
        // dd($kategori->kategori);
        if($profile != $kategori->kategori){
            // dd($profile);
            return response()->json([
                'status' => 401,
                'errors' => 'Silahkan check kategori dengan nama profile jika tidak ada atau salah penamaan silahkan di update !',
            ]);
        }
        $subkategori = SubKategori::where('sub_kategori',$subprofile)->first();
        $kategori_sub_kategori = KategoriSubKategori::where('kategori_id',$kategori->id)->where('sub_kategori_id',$subkategori->id)->first();
        // dd($kategori_sub_kategori);

            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => 'silahkan input semua Profile yang anda tambahkan',
                    'data' =>  $validate->errors(),
                ]);

            }else{

                Profile::create([
                    'profile' => $request->profile,
                    'kategori_sub_kategori_id' => $kategori_sub_kategori->id
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile' =>'required',

        ],[
            'profile.required' => 'Profile harus di isi'
        ]);

        $id = explode('data',$request->id);


            if($validator->fails()){
                return response()->json([
                   'status' => 400,
                    'errors' =>'silahkan input semua Profile yang anda tambahkan',
                    'data' =>  $validate->errors(),
                ]);

            }else{
                $data = Profile::findOrFail($id[1]);
                $datas = ['profile' => $request->profile];
                $data->update([
                    'profile' => $request->profile,
                ]);

               return response()->json([
                 'status' => 200,
                 'message' => 'data berhasil di tambahkan',
                 'data' => $datas
               ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->ids as $id) {
            Profile::destroy($id);
        }
        return response()->json([
          'status' => 200,
          'message' => 'data berhasil di hapus',
          'data' => $request->ids
        ]);
    }
}
