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
                                    <h6 class="text-white text-capitalize ps-3">Formulario de creacion de funcionario</h6>
                                    <!--<p class="text-white text-capitalize  ps-3">Oficinas</p>-->                            
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <!--card de creacion de oficinas-->
                                <form action="{{ route('register') }}" method="post">
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
                                                            <label class="" for="name">Nombres:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="name" id="name" class="form-control"  value="{{old('name')}}">
                                                        </div>
                                                        @error('name')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="paterno">Apellido Paterno:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control"  value="{{old('apellido_paterno')}}">
                                                        </div>
                                                        @error('apellido_paterno')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="materno">Apellido Materno:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control"  value="{{old('apellido_materno')}}">
                                                        </div>
                                                        @error('apellido_materno')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="carnet">Carnet:<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="carnet" id="carnet" class="form-control"  value="{{old('carnet')}}">
                                                        </div>
                                                        @error('carnet')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="celular">Celular<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="celular" id="celular" class="form-control"  value="{{old('celular')}}">
                                                        </div>
                                                        @error('celular')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="telefono">Telefono:<span class="text-danger"></span></label>
                                                            <input type="text" name="telefono" id="telefono" class="form-control"  value="{{old('telefono')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="cargo">Cargo<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="cargo" id="cargo" class="form-control"  value="{{old('cargo')}}">
                                                        </div>
                                                        @error('cargo')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="unidad">Unidad<span class="text-danger">(*)</span></label>
                                                            <input type="text" name="unidad" id="unidad" class="form-control"  value="{{old('unidad')}}">
                                                        </div>
                                                        @error('unidad')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="oficina">Oficina<span class="text-danger">(*)</span></label>
                                                            <select class="form-control" name="id_oficina" id="id_oficina">
                                                                <option value="{{old('id_oficina')}}">* Seleccione una opción *</option>
                                                                    @foreach($oficinas as $oficina)
                                                                        @if($oficina->estado=="activo")
                                                                        <option value="{{$oficina->nombre_oficina_superior}}">{{$oficina->nombre_oficina_superior}}</option>
                                                                        @endif
                                                                    @endforeach
                                                            </select>                                                           
                                                            <!--<input type="text" name="id_oficina" id="id_oficina" class="form-control"  value="{{old('id_oficina')}}">-->
                                                        </div>
                                                        @error('id_oficina')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3"> 
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="estado">Estado<span class="text-danger">(*)</span></label>
                                                            <select class="form-control" name="estado" id="estado">
                                                                <option value="{{old('estado')}}">* Seleccione una opción *</option>
                                                                <option value="activo">ACTIVO</option>
                                                                <option value="inactivo">INACTIVO</option>
                                                            </select>
                                                        </div>
                                                        @error('estado')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="email">Correo Electronico:<span class="text-danger">(*)</span></label>
                                                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                                                        </div>      
                                                        @error('email')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror                                            
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="password">Contraseña:<span class="text-danger">(*)</span></label>
                                                            <input type="password" name="password" id="password" class="form-control" >
                                                        </div>
                                                        @error('password')
                                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                                        @enderror 
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <div class="input-group input-group-static is-valid mb-4">
                                                            <label class="" for="roles">Roles<span class="text-danger"></span></label>   
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Generador</label>        
                                                            <input class="form-check-input" type="checkbox" role="switch" name="generador" id="generador">
                                                        </div> 
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Revisor</label>        
                                                            <input class="form-check-input" type="checkbox" role="switch" id="revisor" name="revisor">
                                                        </div> 
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Finalizador</label>        
                                                            <input class="form-check-input" type="checkbox" role="switch" id="finalizador" name="finalizador">
                                                        </div> 
                                                </div>
                                                    
                                                <!-- Fin Formulario de funcionario-->
                                                <!--boton para guardar funcionario-->
                                                <div class="row" >                                                                         
                                                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                                                        <input type="submit" value="Crear Funcionario" class="btn btn-success">
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
