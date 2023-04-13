<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\RevisorController;


Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
//rutas de las oficinas
Route::get('/tables', [OficinaController::class, 'index'])->middleware('auth')->name('tables');
Route::get('/oficinas', [OficinaController::class, 'create'])->middleware('auth')->name('oficinas');
Route::post('/oficinas', [OficinaController::class, 'store']);
Route::post('/editar-oficina',[OficinaController::class, 'show'])->middleware('auth')->name('editar_oficina');
Route::post('/actualizar-oficina', [OficinaController::class, 'update'])->middleware('auth')->name('actualizar_oficina');
//rutas de los funcionarios
Route::get('/user-management', [ProfileController::class, 'index'])->middleware('auth')->name('user-management');
Route::get('funcionarios', [RegisterController::class, 'create'])->middleware('auth')->name('register');
Route::post('funcionarios', [RegisterController::class, 'store'])->middleware('auth');
Route::post('/editar-funcionario',[RegisterController::class, 'show'])->middleware('auth')->name('editar_funcionario');
Route::post('/editar-rol',[RegisterController::class, 'roles'])->middleware('auth')->name('editar_rol');
Route::post('/actualizar-funcionario', [RegisterController::class, 'update'])->middleware('auth')->name('actualizar_funcionario');
Route::post('/actualizar-rol', [RegisterController::class, 'updaterol'])->middleware('auth')->name('actualizar_rol');
//rutas informe
Route::get('/billing', [InformeController::class, 'index'])->middleware('auth')->name('billing');
Route::get('/informe', [InformeController::class, 'create'])->middleware('auth')->name('informe');
Route::post('/informe', [InformeController::class, 'store'])->middleware('auth')->name('guardar_informe');
Route::post('/editar-informe',[InformeController::class, 'show'])->middleware('auth')->name('editar_informe');
Route::post('/actualizar-informe', [InformeController::class, 'update'])->middleware('auth')->name('actualizar_informe');
Route::post('/descargar-formulario', [InformeController::class, 'pdf'])->middleware('auth')->name('descargarpdf');
//rutas revisor
Route::post('/enviar-para-revision',[InformeController::class, 'enviarrevision'])->middleware('auth')->name('enviar_para_revision');
Route::post('revisor/recuperar_datos',[RevisorController::class, 'getdatas'])->middleware('auth')->name('recuperar_revisor');
Route::post('/revisor', [RevisorController::class, 'store'])->middleware('auth')->name('guardar_actualizar_revisor');
Route::get('/revisar-informe', [RevisorController::class, 'index'])->middleware('auth')->name('revisar_informe');
Route::post('/enviar-revision',[RevisorController::class, 'enviarrevisor'])->middleware('auth')->name('enviar_revision');
Route::post('/actualizar-revisor', [RevisorController::class, 'update'])->middleware('auth')->name('actualizar_revisor');
Route::get('/observaciones', [RevisorController::class, 'observacion'])->middleware('auth')->name('informes_observados');
Route::post('/enviar-observacion-subsanada',[RevisorController::class, 'enviarobservacion'])->middleware('auth')->name('enviar_observacion_subsanada');
Route::post('/actualizar-observacion', [RevisorController::class, 'actualizarobservacion'])->middleware('auth')->name('guardar_actualizar_observacion');




 

 


//fin rutas de las oficinas


Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});