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

class terminadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iduser= Auth::id();
        
        $usuario_terminado = DB::table('informe')
        ->join('terminados','terminados.id_informe_terminado','=','informe.id')
        ->join('users','users.id','=','terminados.id_usuario_terminado')
        ->select()
        ->where('terminados.id_usuario_terminado','=',$iduser)
        ->get();
        //dd($usuario_terminado);
        return view('informeterminado')->with(['usuario_terminado'=>$usuario_terminado ]);
    }

    public function pdffinal(Request $request){
        $solicitudId = $request->id_informe;    
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
            $vista = view('pdffinal', [
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
        
        $pdf = PDF::loadView('pdffinal');
        return $pdf->stream('', array("Attachment" => false));
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
        //
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
