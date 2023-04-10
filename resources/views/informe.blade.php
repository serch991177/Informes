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
                                    <h6 class="text-white text-capitalize ps-3">Formulario de generacion de informe</h6>
                                    <!--<p class="text-white text-capitalize  ps-3">Oficinas</p>-->                            
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <!--card de creacion de oficinas-->
                                @php($creador = $nombre_completo->name.' '.$nombre_completo->apellido_paterno.' '.$nombre_completo->apellido_materno)
                                <form action="{{ route('guardar_informe') }}" method="post">
                                     @csrf
                                    <div class="card">
                                        <div class="card-header card-header-info">
                                                    <h1 class="card-title text-center">DATOS CABECERA</h1>
                                                    <h4 class="card-title text-center"><span class="text-danger">(*)</span>Campos Obligatorios</h4>
                                        </div>
                                        <div class="card-body">
                                                <div class="row">
                                                    <input type="hidden" value="{{$nombre_completo->id}}" name="id_usuario_generador" id="id_usuario_generador">
                                                    <input type="hidden" value="{{$creador}}" name="usuario[]" id="usuario">
                                                    <input type="hidden" value="{{$nombre_completo->cargo}}" name="cargo[]" id="cargo">
                                                    <input type="hidden" value="{{$nombre_completo->unidad}}" name="unidad[]" id="unidad">
                                                    <input type="hidden" value="{{$nombre_completo->firma}}" name="firma[]" id="firma">

                                                    <input type="hidden" value="Pendiente" name="estado" id="estado">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="dirigido_a">Dirigido a: <span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="nombre_dirigido" id="nombre_dirigido" class="form-control"  value="{{old('nombre_dirigido')}}">
                                                                </div>                                                       
                                                        </div>
                                                        @error('nombre_dirigido')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="cargo">Cargo :<span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="cargo_dirigido" id="cargo_dirigido" class="form-control"  value="{{old('cargo_dirigido')}}">
                                                                </div>                                                       
                                                        </div>
                                                        @error('cargo_dirigido')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="unidad">Unidad :<span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="unidad_dirigido" id="unidad_dirigido" class="form-control"  value="{{old('unidad_dirigido')}}">
                                                                </div>                                                       
                                                        </div>
                                                        @error('unidad_dirigido')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="referencia">Referencia :<span class="text-danger">(*)</span></label>
                                                                    <input type="text" name="referencia" id="referencia" class="form-control"  value="{{old('referencia')}}">
                                                                </div>                                                       
                                                        </div>
                                                        @error('referencia')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="tipo_informe">Tipo Informe :<span class="text-danger">(*)</span></label>
                                                                    <select class="form-control" name="tipo_informe" id="tipo_informe">
                                                                        <option value="{{old('tipo_informe')}}">* Seleccione una opción *</option>
                                                                        @foreach($tipoinforme as $tipoinformes)
                                                                        <option value="{{$tipoinformes->nombre}}">{{$tipoinformes->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>                                                       
                                                        </div>
                                                        @error('tipo_informe')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="form-group">
                                                                <div class="input-group input-group-static is-valid mb-4">
                                                                    <label for="fecha">Fecha :<span class="text-danger">(*)</span></label>
                                                                    <input type="date" name="fecha" id="fecha" class="form-control"  value="{{old('fecha')}}" min="new Date();">
                                                                </div>                                                       
                                                        </div>
                                                        @error('fecha')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
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
                                                                    <textarea class="ckeditor" name="dato_informe" id="dato_informe" rows="10" cols="80">{{old('dato_informe')}}</textarea>
                                                                    <!--<input type="text" name="dato_informe" id="dato_informe" class="form-control"  value="{{old('dato_informe')}}">-->
                                                                </div>                                                       
                                                        </div> 
                                                    </div>
                                                    @error('dato_informe')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                <!-- Fin Formulario de funcionario-->
                                                <!--boton para guardar funcionario-->
                                                <div class="row" >                                                                         
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <input type="submit" value="Guardar Informe" class="btn btn-success">
                                                    </div>

                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <a type="button" class="btn btn-danger" href="{{ route('billing') }}">Volver Atras</a>
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
