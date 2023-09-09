<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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


            if($validator->fails()){
                return response()->json([
                    'status' => 400,
                    'errors' => 'silahkan input semua Profile yang anda tambahkan',
                    'data' =>  $validate->errors(),
                ]);

            }else{

                Profile::create([
                    'profile' => $request->profile,
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
        //
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
