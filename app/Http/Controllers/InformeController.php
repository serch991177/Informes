<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TipoInforme;
use App\Models\Informe;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informe = Informe::all();
        return view('pages.billing')->with('informe',$informe);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoinforme = TipoInforme::all();
        $iduser= Auth::id();
        $nombre_completo= DB::table('users')
        ->select('users.name','users.apellido_paterno','users.apellido_materno','users.id')
        ->where('users.id', '=', $iduser)
        ->first();
        //dd($nombre_completo);
        return view('informe')->with(['tipoinforme'=>$tipoinforme, 'nombre_completo'=>$nombre_completo]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoryId=Informe::orderByDesc('id')->first();
        $autoIncId=$categoryId->id+1;
        //$user = request()->user();
        /*$attributes = request()->validate([
            'id_usuario'=>'required',
            'usuario'=>'required',
            'nombre_dirigido' => 'required',
            'cargo' => 'required',
            'unidad' => 'required',
            'referencia'=>'required',
            'tipo_informe' => 'required',
            'fecha'=>'required',
            'dato_informe'=>'required',
            'estado'=>'',
        ]);*/
        $request->validate([
            'id_usuario'=>'required',
            'usuario'=>'required',
            'nombre_dirigido' => 'required',
            'cargo' => 'required',
            'unidad' => 'required',
            'referencia'=>'required',
            'tipo_informe' => 'required',
            'fecha'=>'required',
            'dato_informe'=>'required',
            'estado'=>'',
        ]);
        $category= new Informe;
        $category->id_usuario = $request->input('id_usuario');
        $category->usuario = $request->input('usuario');
        $category->nombre_dirigido = $request->input('nombre_dirigido');
        $category->cargo = $request->input('cargo');
        $category->unidad = $request->input('unidad');
        $category->tipo_informe = $request->input('tipo_informe');
        $category->referencia = $request->input('referencia');
        $category->fecha = $request->input('fecha');
        $category->dato_informe = $request->input('dato_informe');
        $category->estado = $request->input('estado');
        $category->numero=$autoIncId;
       // dd($attributes);
        //$Informe = Informe::create($attributes);
        $category->save();
        //dd($Informe);
        //auth()->login($user);
        Alert::success('Informe Creado Correctamente'); 

        return redirect('/billing');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req)
    {
        $solicitudId=$req->id;       
        $solicitud = Informe::find($solicitudId);
        $tipoinforme = TipoInforme::all();
        //Alert::success('Oficina Creada Correctamente'); 
        //dd($solicitud);
        return view('editarinforme')->with(['solicitud'=>$solicitud, 'tipoinforme'=>$tipoinforme]);
        //return view('editarinforme', compact('solicitud'));
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
    public function update(Request $request)
    {
        $id = $request->id;
        $informe = Informe::find($id);
        $attributes = request()->validate([
            'id_usuario'=>'required',
            'usuario'=>'required',
            'nombre_dirigido' => 'required',
            'cargo' => 'required',
            'unidad' => 'required',
            'referencia'=>'required',
            'tipo_informe' => 'required',
            'fecha'=>'required',
            'dato_informe'=>'required',
            'estado'=>'',
        ]);
        $informe->update($attributes);
        Alert::success('Informe Actualizado Correctamente'); 
        return redirect('/billing');
    }

    public function pdf(Request $request){
        $solicitudId = $request->id;    
        $solicitud = Informe::find($solicitudId);

        $informe=DB::table('informe')->where('informe.id','=',$solicitudId)
            ->select('informe.numero','informe.id_usuario','informe.usuario','informe.nombre_dirigido','informe.cargo','informe.unidad','informe.referencia','informe.tipo_informe','informe.fecha','informe.dato_informe','informe.id_oficina','informe.oficina')
            -> first();
        dd($informe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
