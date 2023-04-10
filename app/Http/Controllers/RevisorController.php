<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TipoInforme;
use App\Models\Informe;
use App\Models\User;
use App\Models\Oficinas;
use App\Models\Revisor;
use RealRashid\SweetAlert\Facades\Alert;
use Dompdf\Dompdf;
use Dompdf\Options;

class RevisorController extends Controller
{

    public function getdatas(Request $request){
        $sql=DB::table('users')->select()
        ->where('nombre_completo', $request->ciresp)->where('users.estado', 'activo')->first();
         //dd($sql);
                   if(!empty($sql) || $sql!=null){
                 return response([
                     'status' => true,
                     'data' => $sql
                 ], 200);
                }else{
                 return response([
                     'status' => false,
                     'message' => 'Usuario con nombre ' . $request->ciresp . ' no es usuario activo!'
                 ], 201);
                }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            
        ]);
        $category= new Revisor;
        $category->id_informe = $request->input('id_informe');
        $category->id_usuario_revisor = $request->input('id_usuario_revisor');
        $category->nombre_revisor = $request->input('nombre_funcionario_revisor');
        $category->numero_generador = $request->input('numero_generador');
        $category->fecha_generador = $request->input('fecha_generador');
        $category->referencia_generada = $request->input('referencia_generada');
        $category->dirigido_nombre = $request->input('dirigido_nombre');
        $category->dirigido_cargo = $request->input('dirigido_cargo');
        $category->dirigido_unidad = $request->input('dirigido_unidad');
        $category->estado_revisor = $request->input('estado_revisor');
        $category->nombre_del_generador = $request->input('nombre_del_generador');
        $category->cargo_del_generador = $request->input('cargo_del_generador');
        $category->unidad_del_generador = $request->input('unidad_del_generador');
        $category->oficina_revisor = $request->input('oficina');
        $category->save();







        $id = $request->id_informe;
        $informe_update= Informe::find($id);
        $array_vacio = array();
        $arrays_usuarios = $request->input('usuario');
        $arrays_cargos= $request->input('cargo');
        $arrays_unidad=$request->input('unidad');
        $arrays_firmas=$request->input('firma');
        for ($i=0;$i<count($arrays_usuarios); $i++)
        {
            $json_tranformas=[  
            
                'nombre'=>$arrays_usuarios[$i],
                'cargo'=>$arrays_cargos[$i],
                'unidad'=>$arrays_unidad[$i],
                'firma'=>$arrays_firmas[$i],
                
            ];
            array_push($array_vacio,$json_tranformas);
        }
        $json_transformado = json_encode($array_vacio);
        $informe_update->usuario=$json_transformado;
        $informe_update->estado=$request->input('estado_revisor');
        $informe_update->update();
        Alert::success('Informe Derivado Correctamente'); 
        return redirect('/billing');
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
    public function destroy(string $id)
    {
        //
    }
}
