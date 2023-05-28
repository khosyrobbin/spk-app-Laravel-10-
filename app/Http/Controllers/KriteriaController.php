<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('layout.kriteria', compact('kriteria'));
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

        Kriteria::create($request->all());
        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan.');
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
    public function edit(Kriteria $kriterium)
    {
        return view('layout.editKriteria', compact('kriterium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium)
    {
        $request->validate([
            'nama_k' => 'required',
            'bobot' => 'required',
            'status' => 'required',
        ]);

        $kriterium->update($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        try {
            $kriterium->delete();
            return redirect()->route('kriteria.index')->with('delete', 'Kriteria berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->errorInfo[2]; // Mendapatkan pesan error dari query exception

            return redirect()->route('kriteria.index')->with('error', $errorMessage);
        }
    }
}
