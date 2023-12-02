<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\ProfesionalesController;
use App\Http\Controllers\AtencionesController;
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
    return view('secretaria.index');
})->name('secretaria.index')->middleware('auth');



Route::get('/login',[SessionController::class,'create'])->name('login.index');
Route::post('/login',[SessionController::class,'store'])->name('login.store');
Route::get('/logout',[SessionController::class,'destroy'])->name('login.destroy');

Route::get('/registro',[RegistroController::class,'create'])->name('registro.index');
Route::post('/registro',[RegistroController::class,'store'])->name('registro.store');

Route::get('/admin',[AdminController::class,'index'])
->middleware('auth.admin')
->name('admin.index');

Route::get('/pacientes',[PacientesController::class,'index'])->name('pacientes.index');
Route::get('/search-paciente',[PacientesController::class,'search'])->name('pacientes.search');
Route::post('/pacientes',[PacientesController::class,'store'])->name('pacientes.store');
Route::delete('/pacientes/{paciente}',[PacientesController::class,'destroy'])->name('pacientes.destroy');
Route::get('/pacientes/{paciente}',[PacientesController::class,'show'])->name('pacientes.show');
Route::get('/pacientes/edit/{paciente}',[PacientesController::class,'edit'])->name('pacientes.edit');
Route::put('/pacientes/{paciente}',[PacientesController::class,'update'])->name('pacientes.update');

Route::get('/admin/usuario',[AdminController::class,'showUsuario'])->name('admin.showUsuario');


// Route::get('/admin/especialidad',[AdminController::class,'showEspecialidad'])->name('admin.showEspecialidad'); // Lo cambie a especialidad
Route::get('/especialidad',[EspecialidadesController::class,'index'])->name('especialidad.index');
Route::post('/especialidad',[EspecialidadesController::class,'store'])->name('especialidad.store');
Route::delete('/especialidad/{especialidad}',[EspecialidadesController::class,'destroy'])->name('especialidad.destroy');
Route::get('/especialidad/edit/{especialidad}',[EspecialidadesController::class,'edit'])->name('especialidad.edit');
Route::put('/especialidad/{especialidad}',[EspecialidadesController::class,'update'])->name('especialidad.update');
Route::get('/search-especialidad',[EspecialidadesController::class,'search'])->name('especialidad.search');

//Route::get('/secretaria',[SecretariaController::class,'index'])->name('secretaria.index');
Route::get('/secretaria/horarios',[SecretariaController::class,'showHorarios'])->name('secretaria.showHorarios');
Route::get('/secretaria/horarios/ver',[SecretariaController::class,'verHorario'])->name('secretaria.verHorario');
Route::get('/secretaria/horarios/editar',[SecretariaController::class,'editarHorario'])->name('secretaria.editarHorario');



//Profesionales
Route::get('/admin/profesional',[ProfesionalesController::class,'index'])->name('admin.indexProfesional');
Route::post('/admin/profesional',[ProfesionalesController::class,'store'])->name('profesional.store');
Route::get('/admin/search-profesional',[ProfesionalesController::class,'search'])->name('profesional.search');
Route::get('/admin/edit/{profesional}',[ProfesionalesController::class,'edit'])->name('profesional.edit');
Route::put('/admin/{profesional}',[ProfesionalesController::class,'update'])->name('profesional.update');

//Usuario
Route::get('/admin/usuario/editar/{usuario}',[SecretariaController::class,'edit'])->name('usuario.edit');
Route::put('/admin/usuario/editar/{usuario}',[SecretariaController::class,'update'])->name('usuario.update');
Route::get('/admin/search-usuario',[SecretariaController::class,'search'])->name('usuario.search');

//Atenciones
Route::get('/secretaria/agendar',[AtencionesController::class,'index'])->name('secretaria.agendar');
Route::post('/secretaria/agendar',[AtencionesController::class,'store'])->name('secretaria.store');
Route::get('/obtener-profesionales/{especialidadId}',[AtencionesController::class,'profesionalEspecialidad'])->name('secretaria.buscarProfesional');
Route::get('/obtener-especialidad/{profesionalId}', [AtencionesController::class, 'especialidadProfesional'])->name('secretaria.buscarEspecialidad');
Route::get('/secretaria/listadoCitas',[AtencionesController::class,'indexListado'])->name('secretaria.listadoCitas');
Route::get('/secretaria/filtrar',[AtencionesController::class,'indexFiltrar'])->name('secretaria.filtrar');

Route::get('secretaria/editar/{atencion}',[AtencionesController::class,'edit'])->name('secretaria.editHora');
Route::put('secretaria/editar/{atencion}',[AtencionesController::class,'update'])->name('secretaria.updateHora');

Route::get('/obtener-horas-disponibles/{profesionalId}/{fechaSeleccionada}', [AtencionesController::class, 'obtenerHorasDisponibles']);


//Actualización estado
Route::post('/secretaria/agendar/atendida/{atencionId}',[AtencionesController::class,'horaAtendida'])->name('secretaria.atendida');
Route::post('/secretaria/agendar/cancelada/{atencionId}',[AtencionesController::class,'horaCancelada'])->name('secretaria.cancelada');

