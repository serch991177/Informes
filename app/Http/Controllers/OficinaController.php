<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oficinas;
use Illuminate\View\View;    
class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oficinas = Oficinas::all();
        return view('pages.tables')->with('oficinas',$oficinas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('oficinas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'numero' => 'required',
            'nombre_oficina' => 'required',
            'nombre_oficina_superior' => 'required',
            'estado' =>'required'
        ]);
        $oficinas = Oficinas::create($attributes);
        //dd($oficinas);
        return redirect('/tables')->with('success','Item created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
