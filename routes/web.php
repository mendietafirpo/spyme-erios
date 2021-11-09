<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\MysmesController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;

/** admin */
Route::middleware(['admin'])->group(function () {

    Route::resource('firmas', FirmaController::class, ['only' => [
        'index', 'destroy'
    ]]);

    Route::resource('personas', PersonaController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('proyectos', ProyectoController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('tramites', TramiteController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('expedientes', TramiteController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('usuarios', UserController::class, ['only' => [
        'index','destroy','show','create','edit','update'
    ]]);

    Route::get('/usuarios/index/{id}',[UserController::class, 'addusers'])->name('usuarios.addusers');

    //Route::get('/usuarios/index/{id}',[UserController::class, 'delusers'])->name('usuarios.delusers');

});

/** logeados */
Route::middleware(['auth'])->group(function () {

    Route::resource('balances', BalanceController::class,['except' => [
        'irmb'
    ]]);

    Route::resource('presupuestos', PresupuestoController::class,['except' => [
        'irpresup'
    ]]);

    Route::resource('gestiones', GestionController::class,['except' => [
        'irgestion'
    ]]);

    Route::resource('firmas', FirmaController::class, ['except' => [
        'index', 'destroy'
    ]]);
    Route::resource('personas', PersonaController::class, ['except' => [
        'index', 'destroy'
    ]]);

    Route::resource('proyectos', ProyectoController::class, ['except' => [
        'index', 'destroy'
    ]]);

    Route::resource('tramites', TramiteController::class, ['except' => [
        'index', 'destroy','edit'
    ]]);

    Route::resource('expedientes', ExpedienteController::class, ['except' => [
        'index','destroy','edit'
    ]]);

    Route::get('/firmas/index/{idFirma}',[FirmaController::class, 'addapp'])->name('firmas.addapp');

    Route::get('/pymes/mysmes',[FirmaController::class, 'mysmes'])->name('pymes.mysmes');

    Route::get('/pymes/metricas',[FirmaController::class, 'metricas'])->name('pymes.metricas');

    Route::get('/pymes/planilla',[FirmaController::class, 'planilla'])->name('pymes.planilla');

    Route::match(['get', 'post'],'/pymes/cargafirma',[FirmaController::class, 'cargafirma'])->name('pymes.cargafirma');

    Route::match(['get', 'post'],'/pymes/cargaproyecto',[ProyectoController::class, 'cargaproyecto'])->name('pymes.cargaproyecto');

    Route::match(['get', 'post'],'/pymes/cargatramite',[TramiteController::class, 'cargatramite'])->name('pymes.cargatramite');

    Route::match(['get', 'post'],'/pymes/cargaexpte',[ExpedienteController::class, 'cargaexpte'])->name('pymes.cargaexpte');

    Route::match(['get', 'post'],'/pymes/ciiusearch',[ProyectoController::class, 'ciiusearch'])->name('pymes.ciiusearch');

    Route::get('/personas/socio/{id}', [PersonaController::class, 'irpersona'])->name('personas.irpersona');

    Route::get('/proyectos/proyecto/{id}', [ProyectoController::class, 'irproyecto'])->name('proyectos.irproyecto');

    Route::get('/balances/index/{idFirma}', [BalanceController::class, 'irmb'])->name('balances.irmb');

    Route::get('/presupuestos/index/{idProy}', [PresupuestoController::class, 'irpresup'])->name('presupuestos.irpresup');

    Route::get('/gestiones/index/{idProy}', [GestionController::class, 'irgestion'])->name('gestiones.irgestion');

    Route::get('/tramites.show/{idProy}', [TramiteController::class, 'irtramite'])->name('tramites.irtramite');

    Route::get('/tramites.edit/{idProy}', [TramiteController::class, 'edit'])->name('tramites.edit');

    Route::get('/expedientes.show/{idProy}', [ExpedienteController::class, 'irexpte'])->name('expedientes.irexpte');

    Route::get('/expedientes.edit/{idProy}', [ExpedienteController::class, 'edit'])->name('expedientes.edit');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    //notas
    Route::get('/notas/albanco', [PDFController::class, 'albanco'])->name('notas.albanco');
    Route::get('/notas/albanco/generate', [PDFController::class, 'generatePDF'])->name('albanco.generate');



});

Route::get('/pdf', function()
{
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Este es un archivo prueba</h1>');
    return $pdf->download('prueba.pdf');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { return view('dashboard');})
->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/pymes/', function () {
    Storage::disk('google')->put('archivo.text','decir algo');
    return "ey che";
});
