<x-layout bodyClass="g-sidenav-show  bg-gray-200">
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        <x-navbars.sidebar activePage="Funcionario"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Funcionario"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Actualizacion de datos</h6>
                                    <!--<p class="text-white text-capitalize  ps-3">Oficinas</p>-->                            
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <!--card de creacion de oficinas-->
                                <form method="post"     action="{{ route('actualizar_funcionario') }}" >
                                     @csrf
                                     
                                    <div class="card">
                                            <div class="card-header card-header-info">
                                                    <h1 class="card-title text-center">DATOS DEL FUNCIONARIO</h1>
                                                    <h4 class="card-title text-center"><span class="text-danger">(*)</span>Campos Obligatorios</h4>
                                            </div>
                                            <div class="card-body">
                                                <!-- Formulario de funcionario-->
                                                <div class="row">           
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="carnet">Carnet:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="carnet" id="carnet" class="form-control"  value="{{$solicitud->carnet}}">
                                                        </div>
                                                    </div>             
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="name">Nombres:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="name" id="name" class="form-control"  value="{{$solicitud->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="paterno">Apellido Paterno:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"  value="{{$solicitud->apellido_paterno}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="materno">Apellido Materno:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"  value="{{$solicitud->apellido_materno}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="celular">Celular<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="celular" id="celular" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false"  value="{{$solicitud->celular}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="telefono">Telefono:<span class="text-danger"></span></label>
                                                            <input type="text" name="telefono" id="telefono" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false"  value="{{$solicitud->telefono}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="cargo">Cargo<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="cargo" id="cargo" class="form-control"  value="{{$solicitud->cargo}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="unidad">Unidad<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="unidad" id="unidad" class="form-control"  value="{{$solicitud->unidad}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="oficina">Oficina<span class="text-danger">(*)</span></label>
                                                            <select class="form-control" name="id_oficina" id="id_oficina">
                                                                <option value="{{$solicitud->id_oficina}}">{{$solicitud->id_oficina}}</option>
                                                                @foreach($oficinas as $oficina)
                                                                @if($oficina->estado=="activo")
                                                                <option value="{{$oficina->nombre_oficina_superior}}">{{$oficina->nombre_oficina_superior}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>                                                           
                                                            <!--<input type="text" name="id_oficina" id="id_oficina" class="form-control"  value="{{old('id_oficina')}}">-->
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="email">Correo Electronico:<span class="text-danger">(*)</span></label>
                                                            <input type="email" class="form-control" name="email" id="email" value="{{$solicitud->email}}">
                                                        </div>      
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="estado">Estado<span class="text-danger">(*)</span></label>
                                                            <select class="form-control" name="estado" id="estado">
                                                                <option value="{{$solicitud->estado}}">{{strtoupper($solicitud->estado)}}</option>
                                                                <option value="activo">ACTIVO</option>
                                                                <option value="inactivo">INACTIVO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="password">Contraseña:<span class="text-danger">(*)</span></label>
                                                            <input type="password" name="password" id="password" class="form-control" value="{{$solicitud->password}}">
                                                        </div>
                                                        @error('password')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>-->
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        
                                                        
                                                        
                                                        
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <input type="hidden" class="form-control" name="id" id="id" value="{{$solicitud->id}}" >
                                                        </div>                                              
                                                    </div>
                                                </div>
                                                <!-- Fin Formulario de funcionario-->
                                                <!--boton para guardar funcionario-->
                                                <div class="row" >                                                                         
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <input type="submit" value="Actualizar Funcionario" class="btn btn-success">
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <a type="button" class="btn btn-danger" href="{{ route('user-management') }}">Volver Atras</a>
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
<!-- recuperacion de valores del switch-->
<script>
    var switchgenerador = document.getElementById('generadorC');
    if (switchgenerador.checked)
        {
            document.getElementById('generador').value= "true";
        }else{
            document.getElementById('generador').value='false';
        }
    switchgenerador.addEventListener("change", validagenerador, false);
    function validagenerador(){
        var checkedgenerador = switchgenerador.checked;
        if(checkedgenerador){
            document.getElementById('generador').value= "true";
        }else{
            document.getElementById('generador').value='false';
        }
    }
</script>

<script>
    var switchrevisor = document.getElementById('revisorC');
    if (switchrevisor.checked)
        {
            document.getElementById('revisor').value= "true";
        }else{
            document.getElementById('revisor').value='false';
        }
    switchrevisor.addEventListener("change", validarevisor, false);
    function validarevisor(){
        var checkedrevisor = switchrevisor.checked;
        if(checkedrevisor){
            document.getElementById('revisor').value= "true";
        }else{
            document.getElementById('revisor').value='false';
        }
    }
</script>

<script>
    var switchfinalizador = document.getElementById('finalizadorC');
    if (switchfinalizador.checked)
        {
            document.getElementById('finalizador').value= "true";
        }else{
            document.getElementById('finalizador').value='false';
        }
    switchfinalizador.addEventListener("change", validarfinalizador, false);
    function validarfinalizador(){
        var checkedfinalizador = switchfinalizador.checked;
        if(checkedfinalizador){
            document.getElementById('finalizador').value= "true";
        }else{
            document.getElementById('finalizador').value='false';
        }
    }
</script>
<!--fin recuperacion de valores del switch-->

<!--data table-->
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
