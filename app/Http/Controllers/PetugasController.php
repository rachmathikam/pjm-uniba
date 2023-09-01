<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Petugas;
use Validator;
use Hash;
use DB;
use Spatie\Permission\Models\Role;

class PetugasController extends Controller
{

    public function index()
    {
        $data = [
            'company' => 'PJM - Uniba Madura',
            'title' => 'Petugas'
        ];

        $petugas = Petugas::join('users','users.id','petugas.user_id')
                            ->select('petugas.*','users.name')->get();



        return view('pages.petugas.index',compact('data','petugas'));
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
            'title' => 'Petugas'
        ];
        return view('pages.petugas.create',compact('data'));
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
            'nip' => 'required|min:16|max:16',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ],[
            'nip.min' => 'Masukkan NIP Minimal 16 karakter',
            'nip.max' => 'Masukkan NIP maksimal 16 karakter',
            'nip.required' => 'NIP harus di isi !',
            'email.unique' => 'Email sudah terdaftar',
            'tempat_lahir.required' => 'Tempat Lahir harus di isi !',
            'tanggal_lahir.required' => 'Tanggal Lahir harus di isi !',
            'email.required' => 'Email harus di isi !',
            'email.email' => 'Yang anda inputkan bukan email !',
            'name.required' => 'Nama harus di isi !',
            'no_telp.required' => 'No Telphone harus di isi !',
            'password.required' => 'Password harus di isi !',
            'alamat.required' => 'Alamat harus di isi !',
            'image.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'image.max' => 'Gambar maksimal size 2mb !',
            'image.required' => 'Gambar harus di isi !',
        ]);
        // dd($request->tanggal_lahir);
        $file_gambar = $request->file('image');
        $password = Hash::make($request->password);
        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            DB::beginTransaction();

                try {
                    $gambar = time() . '_' . $file_gambar->getClientOriginalName();

                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $password,
                    ]);

                    $role = Role::where('name', 'petugas_pjm')->first();
                    $user->assignRole([$role->id]);

                    $data = Petugas::create([
                        'nip' => $request->nip,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'no_telp' => $request->no_telp,
                        'alamat' => $request->alamat,
                        'foto' => $gambar,
                        'user_id' => $user->id,
                    ]);

                    $file_gambar->move(public_path('assets/image/petugas'), $gambar);

                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di tambahkan',
                ]);

            } catch (\Exception $e) {
                DB::rollback();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'company' => 'PJM - Uniba Madura',
            'title' => 'Petugas'
        ];

        $petugas = Petugas::leftJoin('users','users.id','petugas.user_id')->where('petugas.id',$id)->select('petugas.*','users.name','users.password','users.email')->first();
        return view('pages.petugas.edit',compact('data','petugas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updated(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'nip' => 'required|min:16|max:16',
            'email' => 'required',
            'password' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'old_gambar' => 'nullable',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ],[
            'nip.min' => 'Masukkan NIP Minimal 16 karakter',
            'nip.max' => 'Masukkan NIP maksimal 16 karakter',
            'nip.required' => 'NIP harus di isi !',
            'tempat_lahir.required' => 'Tempat Lahir harus di isi !',
            'tanggal_lahir.required' => 'Tanggal Lahir harus di isi !',
            'email.required' => 'Email harus di isi !',
            'email.email' => 'Yang anda inputkan bukan email !',
            'name.required' => 'Nama harus di isi !',
            'no_telp.required' => 'No Telphone harus di isi !',
            'password.required' => 'Password harus di isi !',
            'alamat.required' => 'Alamat harus di isi !',
            'image.image' => 'Gambar harus type jpg,png,jpeg,gif,svg !',
            'image.max' => 'Gambar maksimal size 2mb !',
        ]);

        $file_gambar = $request->file('image');
        $password = Hash::make($request->password);

        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'errors' => 'data gagal di tambahkan',
                'data' =>  $validate->errors(),
            ]);
        }else{
            DB::beginTransaction();

                try {
                    if(!empty($file_gambar)){
                        $gambar = time() . '_' . $file_gambar->getClientOriginalName();
                        $path = public_path('assets/image/petugas/').$request->old_gambar;
                        $file_gambar->move(public_path('assets/image/petugas'), $gambar);
                        unlink($path);
                    }else{
                        $gambar = $request->old_gambar;
                    }


                    $data = Petugas::findOrFail($id);
                    // dd($data);
                    $user = User::findOrFail($data->user_id);
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $password,
                    ]);

                    $data->update([
                        'nip' => $request->nip,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'no_telp' => $request->no_telp,
                        'alamat' => $request->alamat,
                        'foto' => $gambar,
                        'user_id' => $user->id,
                    ]);


                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil di update',
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'status' => 401,
                    'errors' => 'data gagal di update',
                ]);

            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = explode('data',$request->ids);
        $id = $id[1];

        $data = Petugas::findOrfail($id);
        if($data){
            $user = User::where('id',$data->user_id)->first();
            $path = public_path('assets/image/petugas/'.$data->foto);
            if( unlink($path)){
                $user->delete();
                $data->delete();
            }

            return response()->json([
              'status' => 200,
              'message' => 'Data berhasil di hapus',
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Data gagal di hapus',
              ]);
        }
    }
}
