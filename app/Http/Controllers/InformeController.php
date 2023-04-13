<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TipoInforme;
use App\Models\Informe;
use App\Models\User;
use App\Models\Oficinas;
use RealRashid\SweetAlert\Facades\Alert;
use Dompdf\Dompdf;
use Dompdf\Options;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informe = Informe::all();
        /**Funcion para recuperar solo los datos del usuario creado */
        $iduser= Auth::id();    
        $dato=DB::table('informe')
        ->where('informe.id_usuario_generador',''.$iduser.'')
        ->select()
        ->get();
       
        /**Fin funcion para recuperar solo  los datos del usuario creado*/

        return view('pages.billing')->with('dato',$dato);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoinforme = TipoInforme::all();
        $iduser= Auth::id();
        $nombre_completo= DB::table('users')
        ->select('users.name','users.apellido_paterno','users.apellido_materno','users.id','users.cargo','users.unidad','users.firma')
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
        $request->validate([
            'id_usuario_generador'=>'required',
            'usuario'=>'required',
            'nombre_dirigido' => 'required',
            'cargo_dirigido' => 'required',
            'unidad_dirigido' => 'required',
            'referencia'=>'required',
            'tipo_informe' => 'required',
            'fecha'=>'required',
            'dato_informe'=>'required',
            'estado'=>'',
        ]);
        $category= new Informe;
        $category->id_usuario_generador = $request->input('id_usuario_generador');
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
        $category->nombre_dirigido = $request->input('nombre_dirigido');
        $category->cargo_dirigido = $request->input('cargo_dirigido');
        $category->unidad_dirigido = $request->input('unidad_dirigido');
        $category->tipo_informe = $request->input('tipo_informe');
        $category->referencia = $request->input('referencia');
        $category->fecha = $request->input('fecha');
        $category->dato_informe = $request->input('dato_informe');
        $category->estado = $request->input('estado');
        $category->numero=$autoIncId;
        $category->usuario=$json_transformado;
        $category->save();
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
        //$informe = Informe::find($id);
        $request->validate([
            'usuario'=>'required',
            'nombre_dirigido' => 'required',
            'cargo_dirigido' => 'required',
            'unidad_dirigido' => 'required',
            'referencia'=>'required',
            'tipo_informe' => 'required',
            'fecha'=>'required',
            'dato_informe'=>'required',
            'estado'=>'',
        ]);
        $category= Informe::find($id);
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
        $category->nombre_dirigido = $request->input('nombre_dirigido');
        $category->cargo_dirigido = $request->input('cargo_dirigido');
        $category->unidad_dirigido = $request->input('unidad_dirigido');
        $category->tipo_informe = $request->input('tipo_informe');
        $category->referencia = $request->input('referencia');
        $category->fecha = $request->input('fecha');
        $category->dato_informe = $request->input('dato_informe');
        $category->estado = $request->input('estado');
        $category->usuario=$json_transformado;
        
        $category->update();
        Alert::success('Informe Actualizado Correctamente'); 
        return redirect('/dashboard');
    }

    public function pdf(Request $request){
        $solicitudId = $request->id;    
        $solicitud = Informe::find($solicitudId);

        $informe=DB::table('informe')->where('informe.id','=',$solicitudId)
            ->select('informe.id','informe.numero','informe.id_usuario_generador','informe.usuario','informe.nombre_dirigido','informe.cargo_dirigido','informe.unidad_dirigido','informe.referencia','informe.tipo_informe','informe.fecha','informe.dato_informe','informe.id_oficina','informe.oficina')
            -> first(); 
        
        $fecha=DB::table('informe')->where('informe.id','=',$solicitudId)
            ->select('informe.fecha')
            ->first();    
        setlocale(LC_ALL,'Spanish_Bolivia');
        $fechaformateada = strftime("%A %d de %B de %Y", strtotime( $fecha->fecha ));
        setlocale(LC_ALL,"");
        $fechaformateada = utf8_encode($fechaformateada);


        $todo = Informe::all();
        
            //configuracion pdf
            $vista = view('pdf', [
                'informe'        =>  $informe,
                'todo'           =>  $todo,
                'fechaformateada'=>  $fechaformateada,    
               /* 'predio'         =>  $predio,
                'propietarios'   =>  $propietarios,
                'recepcion'      =>  $tramite,
                'responsable'    =>  $responsable,
                'solicitud'      =>  $solicitud,
                'requisitos'     =>  $requisitos,
                'pagos'          =>  $pagos,*/
                ]);
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHTML5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($vista);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        //$dompdf->stream('autorizacion.pdf');
        //$dompdf->stream ('form.pdf',array('Attachment'=>0));

        $dompdf->stream ('',array("Attachment" => false));
        //$dompdf->set_option("isPhpEnabled",true);
        //$dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
        
        $pdf = PDF::loadView('pdf');
        return $pdf->stream('', array("Attachment" => false));
    }

    

    

    public function enviarrevision(Request $req){
        $solicitudId=$req->id;       
        $solicitud = Informe::find($solicitudId);
        $oficinas = Oficinas::all();
        $usuarios = User::all();
        //Alert::success('Oficina Creada Correctamente'); 
        //dd($solicitud);
        $iduser= Auth::id();
        $nombre_completo= DB::table('users')
        ->select('users.nombre_completo','users.id','users.cargo','users.unidad','users.firma')
        ->where('users.id', '=', $iduser)
        ->first();
        //dd($nombre_completo);
        return view('enviar_revision')->with(['solicitud'=>$solicitud, 'oficinas'=>$oficinas, 'usuarios'=>$usuarios, 'nombre_completo'=>$nombre_completo]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
