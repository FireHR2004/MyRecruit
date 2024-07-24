<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;


class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::all();
        return view('alternatif.index', compact('alternatif'));
    }
    //tambah data
    public function store(Request $request)
    {
        $request->validate([
            'nama_alternatif' => 'required',
        ]);

        Alternatif::create($request->all());
        return redirect()->route('alternatif.index');
    }

    //update data
    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nama_alternatif' => 'required',
        ]);

        $alternatif->update($request->all());
        return redirect()->route('alternatif.index');
    }


    //hapus data
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->route('alternatif.index');
    }
}
