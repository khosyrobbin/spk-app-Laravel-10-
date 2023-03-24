<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = KriteriaModel::all();
        return view('kriteria', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_k' => 'required',
            'bobot' => 'required',
            'status' => 'required',
        ]);

        KriteriaModel::create($request->all());
        return redirect()->route('kriteria.index')
        ->with('pesan','Kriteria berhasil ditambahakan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KriteriaModel $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index');
    }
}
