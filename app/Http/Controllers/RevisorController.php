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
use App\Models\Observaciones;
use App\Models\Terminados;
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
        $iduser= Auth::id();
        $rol_usuario= DB::table('users')
        ->select('users.revisor','users.finalizador')
        ->where('users.id', '=', $iduser)
        ->first();
        $informe = Informe::all();
       
        
        /*$usuario_generador=DB::table('users')->select()
       ->join('informe', 'informe.id_usuario_generador', '=', 'users.id')
       //->join('revisor','revisor.id_informe','=','informe.id')
       ->get();*/

       /*select * from users u 
       join informe i on i.id_usuario_generador = u.id 
       join revisor r on r.id_informe = i.id 
       where r.id_usuario_revisor =4*/
        $usuario_generador = DB::table('users')
        ->join('informe','informe.id_usuario_generador','=','users.id')
        ->join('revisor','revisor.id_informe','=','informe.id')
        ->select()
        ->where('revisor.id_usuario_revisor','=',$iduser)
        ->get();

        //dd($usuario_generador);
        return view('revisarinforme')->with(['informe'=>$informe , 'rol_usuario'=>$rol_usuario, 'usuario_generador'=>$usuario_generador]);
    }

    public function observacion(){
        $iduser= Auth::id();
        $rol_usuario= DB::table('users')
        ->select('users.revisor','users.finalizador')
        ->where('users.id', '=', $iduser)
        ->first();
        $informe = Informe::all();

        $usuario_generador = DB::table('users')
        ->join('informe','informe.id_usuario_generador','=','users.id')
        ->join('observaciones','observaciones.id_informe_observado','=','informe.id')
        ->select()
        ->where('observaciones.id_usuario_observado','=',$iduser)
        ->get();
        //dd($usuario_generador);
        return view('observaciones')->with(['informe'=>$informe , 'rol_usuario'=>$rol_usuario, 'usuario_generador'=>$usuario_generador]);
    }

    public function enviarrevisor(Request $req){
        $solicitudId=$req->id;       
        $solicitud = Informe::find($solicitudId);
        $oficinas = Oficinas::all();
        $usuarios = User::all();
        $iduser= Auth::id();
        $nombre_completo= DB::table('users')
        ->select('users.nombre_completo','users.id','users.cargo','users.unidad','users.firma')
        ->where('users.id', '=', $iduser)
        ->first();
        //dd($nombre_completo);
        $revisor = DB::table('informe')
        ->join('revisor','revisor.id_informe','=','informe.id')
        ->select('informe.id','informe.nombre_dirigido','informe.cargo_dirigido','informe.unidad_dirigido','informe.referencia','informe.tipo_informe','informe.fecha','informe.dato_informe','informe.observacion','revisor.id_informe','revisor.id')
        ->where('revisor.id_informe','=', $solicitudId)
        ->get();
        
        //dd($revisor);

        return view('enviar_revisor')->with(['solicitud'=>$solicitud, 'oficinas'=>$oficinas, 'usuarios'=>$usuarios, 'nombre_completo'=>$nombre_completo, 'revisor'=>$revisor]);
    }

    public function enviarobservacion(Request $req){
        $solicitudId=$req->id;       
        //dd($solicitudId);
        $solicitud = Informe::find($solicitudId);
        $tipoinforme = TipoInforme::all();
        //Alert::success('Oficina Creada Correctamente'); 
        //dd($solicitud);
        /*$usuario_generador = DB::table('users')
        ->join('informe','informe.id_usuario_generador','=','users.id')
        ->join('observaciones','observaciones.id_informe_observado','=','informe.id')
        ->select()
        ->where('observaciones.id_usuario_observado','=',$iduser)
        ->get();*/
        $consulta_observado = DB::table('informe')
        ->join('observaciones','observaciones.id_informe_observado','=','informe.id')
        ->select('informe.id','informe.nombre_dirigido','informe.cargo_dirigido','informe.unidad_dirigido','informe.referencia','informe.tipo_informe','informe.fecha','informe.dato_informe','informe.observacion','observaciones.id_informe_observado','observaciones.id')
        ->where('observaciones.id_informe_observado','=', $solicitudId)
        ->get();
        //dd($consulta_observado);


        return view('enviarobservacion')->with(['solicitud'=>$solicitud, 'tipoinforme'=>$tipoinforme, 'consulta_observado'=>$consulta_observado]);
        
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
        //Evitar duplicidad de nombre,cargo,unidad de los usuarios con tres roles
        $evitar_duplicidad = auth()->user();
        //dd("El nombre de requet es " .$request->input('funcionario') ." y el nombre de las sesion es " .$evitar_duplicidad->nombre_completo);
        if($request->input('funcionario') == $evitar_duplicidad->nombre_completo){
                /**Funcion Guardar en la tabla de revisor */
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
                /**Fin revisor */

                 /**Funcion actualizar informe */
                 $id = $request->id_informe;
                $informe_update= Informe::find($id);
                $informe_update->estado=$request->input('estado_revisor');
                $informe_update->update();
                /**Fin actualizar informe */
                Alert::success('Informe Derivado Correctamente'); 
                return redirect('/billing');
        }else{
            /**Funcion Guardar en la tabla de revisor */
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
            /**Fin revisor */

            /**Funcion actualizar informe */
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
            /**Fin actualizar informe */
            Alert::success('Informe Derivado Correctamente'); 
            return redirect('/billing');
        }
    }

    public function actualizarobservacion(Request $request){
       // example:
        $id = $request->id_informe;
        $informe_update= Informe::find($id);
       // dd($informe_update);
        $informe_update->nombre_dirigido = $request->input('nombre_dirigido');
        $informe_update->cargo_dirigido = $request->input('cargo_dirigido');
        $informe_update->unidad_dirigido = $request->input('unidad_dirigido');
        $informe_update->tipo_informe = $request->input('tipo_informe');
        $informe_update->referencia = $request->input('referencia');
        $informe_update->fecha = $request->input('fecha');
        $informe_update->dato_informe = $request->input('dato_informe');
        $informe_update->estado = $request->input('estado');
        $informe_update->update();
        
        $id_informe_observado = $request->id_observacion;
        $observacion_update=Observaciones::find($id_informe_observado);
        $observacion_update->estado_observacion = "Subsanado";
        $observacion_update->update();
        //dd($observacion_update);


        
        Alert::success('Informe Derivado Correctamente'); 
        return redirect('/observaciones');        
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
    public function update(Request $request)
    {
        $request->validate([
            'usuario'=>'required',
            'estado_revisor' => 'required',
        ]);
        /**Funcion actualizar informe */
        if($request->input('estado_revisor') =="Observado"){
            /**Actualizar tabla informe*/
            $id = $request->id_informe;
            $request->validate([
                'usuario'=>'required',
                'estado_revisor' => 'required',
                'observacion'=>'required',
                'funcionario1'=>'required',
                'oficina'=>'required',
            ]);
            $informe_update= Informe::find($id);
            $array_vacio = array();
            $arrays_usuarios = $request->input('usuario');
            $array_sin_duplicados_usuarios = array_unique($arrays_usuarios);
            $arrays_cargos= $request->input('cargo');
            $array_sin_duplicados_cargos= array_unique($arrays_cargos);
            $arrays_unidad=$request->input('unidad');
            $array_sin_duplicados_unidad= array_unique($arrays_unidad);        
            $arrays_firmas=$request->input('firma');
            $array_sin_duplicados_firma= array_unique($arrays_firmas);        
            for ($i=0;$i<count($array_sin_duplicados_usuarios); $i++)
            {
                $json_tranformas=[  
                
                    'nombre'=>$array_sin_duplicados_usuarios[$i],
                    'cargo'=>$array_sin_duplicados_cargos[$i],
                    'unidad'=>$array_sin_duplicados_unidad[$i],
                    'firma'=>$array_sin_duplicados_firma[$i],
                    
                ];
                array_push($array_vacio,$json_tranformas);
            }    
            $json_transformado = json_encode($array_vacio);
            $informe_update->usuario=$json_transformado;
            $informe_update->estado=$request->input('estado_revisor');
            $informe_update->observacion=$request->input('observacion');
            $informe_update->update();
            /**Fin actualizar tabla informe*/
            /**Guardar en la tabla observacion*/
            $id_informe= $request->id_informe;
            $observacion = new Observaciones;
            $observacion->id_informe_observado = $id_informe;
            $observacion->id_usuario_observado = $request->input('id_usuario_revisor');
            $observacion->observacion_informe=$request->input('observacion');
            $observacion->estado_observacion = "Observado";
            $observacion->save();
            
            /**Fin Guardar tabla observacion */
            Alert::success('Informe Derivado Correctamente');
            return redirect('/revisar-informe');
 
        }
        if($request->input('estado_revisor') =="Aprobado"){
            /**Actualizar tabla del revisor anterior */
            $id_update_revisor = $request->id_revisor;
            $revisor_update= Revisor::find($id_update_revisor);
            $revisor_update->estado_revisor= "Revisado";
            $revisor_update->update();
            /**Fin Actualizar tabla del revisor anterior */
            /**Insertar el revisor que sera derivado */
            $revisor_insert= new Revisor;
            $revisor_insert->id_informe = $request->input('id_informe');
            $revisor_insert->id_usuario_revisor = $request->input('id_usuario_revisor');
            $revisor_insert->nombre_revisor = $request->input('nombre_funcionario_revisor');
            $revisor_insert->numero_generador = $request->input('numero_generador');
            $revisor_insert->fecha_generador = $request->input('fecha_generador');
            $revisor_insert->referencia_generada = $request->input('referencia_generada');
            $revisor_insert->dirigido_nombre = $request->input('dirigido_nombre');
            $revisor_insert->dirigido_cargo = $request->input('dirigido_cargo');
            $revisor_insert->dirigido_unidad = $request->input('dirigido_unidad');
            $revisor_insert->estado_revisor = "Derivado";
            $revisor_insert->nombre_del_generador = $request->input('nombre_del_generador');
            $revisor_insert->cargo_del_generador = $request->input('cargo_del_generador');
            $revisor_insert->unidad_del_generador = $request->input('unidad_del_generador');
            $revisor_insert->oficina_revisor = $request->input('oficina');
            $revisor_insert->save();
            /**Fin insertar el revior que sera derivado */
            /**Funcion actualizar informe */
            $id = $request->id_informe;
            $request->validate([
                'usuario'=>'required',
                'estado_revisor' => 'required',
                'funcionario'=>'required',
                'oficina'=>'required',
            ]);
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
            $informe_update->estado= "Derivado";
            $informe_update->update();
            /**Fin Actualizar informe*/
            Alert::success('Informe Derivado Correctamente'); 
            return redirect('/revisar-informe');

        }
        
        
    }

    public function finalizartramite(Request $request){
        /**Guardar en la tabla de terminado */
        $id_informe_table = $request->id_recuperar;
        $iduser= Auth::id(); 
        $terminado_insert= new Terminados;
        $terminado_insert->id_informe_terminado =$id_informe_table;
        $terminado_insert->id_usuario_terminado = $iduser;
        $terminado_insert->save();
        /**Fin guardar tabla de terminados */
        /**Actualizar informe */
        $id_informe_terminado = $request->id_recuperar;
        $informe_terminado= Informe::find($id_informe_terminado);
        $informe_terminado->estado= "Finalizado";
        $informe_terminado->cite= $request->input('cite');
        $informe_terminado->update();
        /**Fin Actualizar informe */ 
        Alert::success('Tramite Finalizado'); 
        return redirect('/ver-informes-terminados');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
