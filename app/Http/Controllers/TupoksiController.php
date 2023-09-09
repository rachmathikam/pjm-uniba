<?php

namespace App\Http\Controllers;

use App\Models\Tupoksi;
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
            'title' => 'Profile'
        ];

        $tupoksi = Tupoksi::all();
        return view('pages.tupoksi.index', compact('tupoksi', 'data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tupoksi  $tupoksi
     * @return \Illuminate\Http\Response
     */
    public function show(Tupoksi $tupoksi)
    {
        //
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
    public function update(Request $request, Tupoksi $tupoksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tupoksi  $tupoksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tupoksi $tupoksi)
    {
        //
    }
}
