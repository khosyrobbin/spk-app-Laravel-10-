<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Indikator;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beasiswa = Beasiswa::all();
        $indikator = Indikator::orderBy('nama_i', 'asc')->get()->pluck('nama_i', 'indikator_id');

        return view('layout.beasiswa', compact('beasiswa','indikator'));
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
            'nama_b' => 'required',
            'indikator_id' => 'required|array|min:2'
        ]);

        // Beasiswa::create($request->all());
        // return redirect()->route('beasiswa.index');

        // $params = $request->validated();
        if ($beasiswa = Beasiswa::create($request->all())) {
            $beasiswa->indikator()->sync($request['indikator_id']);

            return redirect(route('beasiswa.index'));
        }
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
    public function edit(Beasiswa $beasiswa)
    {
        return view('layout.editBeasiswa', compact('beasiswa'));
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
    public function destroy(Beasiswa $beasiswa)
    {
        $beasiswa->delete();
        return redirect()->route('beasiswa.index');
    }
}
