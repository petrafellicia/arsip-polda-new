<?php

namespace App\Http\Controllers;

use App\Models\SuratType;
use App\Http\Requests\StoreSuratTypeRequest;
use App\Http\Requests\UpdateSuratTypeRequest;

class SuratTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = SuratType::all();
        return view();
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
     * @param  \App\Http\Requests\StoreSuratTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSuratTypeRequest $request)
    {
        //
        $data = SuratType::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratType  $suratType
     * @return \Illuminate\Http\Response
     */
    public function show(SuratType $suratType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratType  $suratType
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratType $suratType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuratTypeRequest  $request
     * @param  \App\Models\SuratType  $suratType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSuratTypeRequest $request, SuratType $suratType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratType  $suratType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratType $suratType)
    {
        //
    }
}
