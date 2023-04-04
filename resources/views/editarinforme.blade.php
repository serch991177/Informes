<x-layout bodyClass="g-sidenav-show  bg-gray-200">
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
        <x-navbars.sidebar activePage="Informe"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Informe"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Formulario de edicion generacion de informe</h6>
                                    <!--<p class="text-white text-capitalize  ps-3">Oficinas</p>-->                            
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <!--card de creacion de oficinas-->
                                <form action="{{ route('actualizar_informe') }}" method="post">
                                     @csrf
                                    <div class="card">
                                        <div class="card-header card-header-info">
                                                    <h1 class="card-title text-center">DATOS CABECERA</h1>
                                                    <h4 class="card-title text-center"><span class="text-danger">(*)</span>Campos Obligatorios</h4>
                                        </div>
                                        <div class="card-body">
                                                <div class="row">
                                                    <input type="hidden" value="{{$solicitud->id}}" name="id" id="id">
                                                    <input type="hidden" value="{{$solicitud->id_usuario}}" name="id_usuario" id="id_usuario">
                                                    <input type="hidden" value="{{$solicitud->usuario}}" name="usuario" id="usuario">
                                                    <input type="hidden" value="Pendiente" name="estado" id="estado">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="dirigido_a">Dirigido a: <span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="nombre_dirigido" id="nombre_dirigido" class="form-control"  value="{{$solicitud->nombre_dirigido}}">
                                                                </div>                                                       
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="cargo">Cargo :<span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="cargo" id="cargo" class="form-control"  value="{{$solicitud->cargo}}">
                                                                </div>                                                       
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="unidad">Unidad :<span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="unidad" id="unidad" class="form-control"  value="{{$solicitud->unidad}}">
                                                                </div>                                                       
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="referencia">Referencia :<span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="referencia" id="referencia" class="form-control"  value="{{$solicitud->referencia}}">
                                                                </div>                                                       
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="tipo_informe">Tipo Informe :<span class="text-danger">(*)</span></label>
                                                                    <select class="form-control" name="tipo_informe" id="tipo_informe">
                                                                        <option value="{{$solicitud->tipo_informe}}">{{$solicitud->tipo_informe}}</option>
                                                                         @foreach($tipoinforme as $tipoinformes)   
                                                                        <option value="{{$tipoinformes->nombre}}">{{$tipoinformes->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="fecha">Fecha :<span class="text-danger">(*)</span></label>
                                                                    <input type="date" name="fecha" id="fecha" class="form-control"  value="{{$solicitud->fecha}}" min="new Date();">
                                                                </div>                                                       
                                                        </div>
                                                    </div>
                                                   

                                                </div>
                                        </div>
                                    </div> 
                                    <div class="card" >
                                            <div class="card-header card-header-info">
                                                    <h1 class="card-title text-center">DATOS DEL INFORME</h1>
                                                    <h4 class="card-title text-center"><span class="text-danger">(*)</span>Campos Obligatorios</h4>
                                            </div>
                                            <div class="card-body">
                                                <!-- Formulario de funcionario-->
                                                <div class="row">                        
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="dato_informe">Contenido: <span class="text-danger">(*)</span></label>
                                                                    <textarea class="ckeditor" name="dato_informe" id="dato_informe" rows="10" cols="80">{{$solicitud->dato_informe}}</textarea>
                                                                    <!--<input type="text" name="dato_informe" id="dato_informe" class="form-control"  value="{{old('dato_informe')}}">-->
                                                                </div>                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                <!-- Fin Formulario de funcionario-->
                                                <!--boton para guardar funcionario-->
                                                <div class="row" >                                                                         
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <input type="submit" value="Actualizar Informe" class="btn btn-success">
                                                    </div>
                                                </div>
                                                <!--Fin boton guardar funcionario-->
                                                </div>
                                                </div>                    
                                                </div>
                                    </div>

                                </form> 
                                <!-- fin cardformulario de oficinas-->        
                            </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
            
            
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!--script data table-->
<script>
    /*$(document).ready(function () {
        $('#example').DataTable();
    });*/
    $('#example').DataTable( {
        responsive: true
    } );
</script>
<!--fin data table-->
        </main>
        <x-plugins></x-plugins>
</x-layout>
