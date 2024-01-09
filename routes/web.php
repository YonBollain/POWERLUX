<?php

use App\Http\Controllers\AnexoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComercializadoraController;
use App\Http\Controllers\ComisioneController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ContratoTelefonoController;
use App\Http\Controllers\Data\ArchivoController;
use App\Http\Controllers\Data\DatosController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiquidacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class,'logout'])->name('logout')->middleware('auth');;

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Rutas Agentes
Route::get('/comerciales',[UsersController::class, 'index'])->name('comerciales')->middleware('admin');
Route::get('/comerciales/crear',[UsersController::class, 'create'])->name('crearcomerciales')->middleware('admin');
Route::get('/comerciales/mostrar/{usuarioid}',[UsersController::class,'show'])->name('mostrarcomercial')->middleware('admin');
Route::post('/comerciales/crear',[UsersController::class, 'store'])->name('guardarcomercial')->middleware('admin');
Route::get('/comerciales/edit/{usuarioid}',[UsersController::class, 'edit'])->name('editcomercial')->middleware('admin');
Route::put('/comerciales/edit/{usuarioid}',[UsersController::class, 'update'])->name('updatecomercial')->middleware('admin');
Route::delete('/comerciales/eliminar/{usuarioid}',[UsersController::class, 'destroy'])->name('eliminarcomercial')->middleware('admin');

//Profile
Route::get('/profile',[UsersController::class, 'profile'])->name('perfil')->middleware('auth');
Route::post('/profile/password/cambiar',[UsersController::class, 'updatePassword'])->name('updatePassword')->middleware('auth');
Route::put('/profile/update/{usuario}',[UsersController::class, 'updateUserProfile'])->name('updateUser')->middleware('auth');

//Rutas Comercializadoras
Route::get('/comercializadoras',[ComercializadoraController::class, 'index'])->name('comercializadoras')->middleware('auth');
Route::get('/comercializadoras/crear',[ComercializadoraController::class, 'create'])->name('comercializadoras.create')->middleware('admin');
Route::post('/comercializadoras/crear',[ComercializadoraController::class, 'store'])->name('comercializadoras.store')->middleware('admin');
Route::get('/comercializadoras/edit/{comercializadora}',[ComercializadoraController::class, 'edit'])->name('comercializadoras.edit')->middleware('admin');
Route::put('/comercializadoras/edit/{comercializadora}',[ComercializadoraController::class, 'update'])->name('comercializadoras.update')->middleware('admin');
Route::delete('/comercializadoras/eliminar/{comercializadora}',[ComercializadoraController::class, 'destroy'])->name('comercializadoras.destroy')->middleware('admin');

//Rutas Productos
Route::get('/productos',[ProductoController::class, 'index'])->name('productos.index')->middleware('auth');
Route::get('/productos/crear',[ProductoController::class, 'create'])->name('productos.create')->middleware('admin');
Route::post('/productos/crear',[ProductoController::class, 'store'])->name('productos.store')->middleware('admin');
Route::get('/productos/editar/{producto}',[ProductoController::class, 'edit'])->name('productos.edit')->middleware('admin');
Route::put('/productos/editar/{producto}',[ProductoController::class, 'update'])->name('productos.update')->middleware('admin');
Route::get('/productos/mostrar/{producto}',[ProductoController::class, 'show'])->name('productos.show')->middleware('admin');
Route::delete('/productos/eliminar/{producto}',[ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('admin');

//Rutas Clientes
Route::get('/clientes',[ClienteController::class, 'index'])->name('clientes.index')->middleware('auth');
Route::get('/clientes/crear',[ClienteController::class, 'create'])->name('clientes.create')->middleware('auth');
Route::post('/clientes/crear',[ClienteController::class, 'store'])->name('clientes.store')->middleware('auth');
Route::get('/clientes/editar/{cliente}',[ClienteController::class, 'edit'])->name('clientes.edit')->middleware('auth');
Route::put('/clientes/editar/{cliente}',[ClienteController::class, 'update'])->name('clientes.update')->middleware('auth');
Route::get('/clientes/mostrar/{cliente}',[ClienteController::class, 'show'])->name('clientes.show')->middleware('auth');
Route::delete('/clientes/eliminar/{cliente}',[ClienteController::class, 'destroy'])->name('clientes.destroy')->middleware('admin');

//Rutas Contratos
Route::get('/contratos',[ContratoController::class, 'index'])->name('contratos.index')->middleware('auth');
Route::get('/contratos/crear',[ContratoController::class, 'create'])->name('contratos.create')->middleware('auth');
Route::post('/contratos/crear',[ContratoController::class, 'store'])->name('contratos.store')->middleware('auth');
Route::get('/contratos/editar/{contrato}',[ContratoController::class, 'edit'])->name('contratos.edit')->middleware('auth');
Route::put('/contratos/editar/{contrato}',[ContratoController::class, 'update'])->name('contratos.update')->middleware('auth');
Route::get('/contratos/mostrar/{contrato}',[ContratoController::class, 'show'])->name('contratos.show')->middleware('auth');
Route::delete('/contratos/eliminar/{contrato}',[ContratoController::class, 'destroy'])->name('contratos.destroy')->middleware('admin');

//Rutas Contratos Telefono
Route::get('/contratos/telefonia',[ContratoTelefonoController::class, 'index'])->name('contratotelefono.index')->middleware('auth');
Route::get('/contratos/telefonia/crear',[ContratoTelefonoController::class, 'create'])->name('contratotelefono.create')->middleware('auth');
Route::post('/contratos/telefonia/crear',[ContratoTelefonoController::class, 'store'])->name('contratotelefono.store')->middleware('auth');
Route::get('/contratos/telefonia/editar/{contrato}',[ContratoTelefonoController::class, 'edit'])->name('contratotelefono.edit')->middleware('auth');
Route::put('/contratos/telefonia/editar/{contrato}',[ContratoTelefonoController::class, 'update'])->name('contratotelefono.update')->middleware('auth');
Route::get('/contratos/telefonia/mostrar/{contrato}',[ContratoTelefonoController::class, 'show'])->name('contratotelefono.show')->middleware('auth');
Route::delete('/contratos/telefonia/eliminar/{contrato}',[ContratoTelefonoController::class, 'destroy'])->name('contratotelefono.destroy')->middleware('admin');
Route::get('/contratos/telefonia/eliminar/{producto}',[ContratoTelefonoController::class, 'destroyProduct'])->name('contratotelefono.producto.destroy')->middleware('admin');

//Rutas Gestiones
Route::get('/gestiones',[GestionController::class, 'index'])->name('gestion.index')->middleware('auth');
Route::get('/gestiones/{contrato}/crear/{tipo}',[GestionController::class, 'create'])->name('gestion.create')->middleware('auth');
Route::post('/gestiones/{contrato}/crear',[GestionController::class, 'store'])->name('gestion.store')->middleware('auth');
Route::get('/gestiones/mostrar/{gestion}',[GestionController::class, 'show'])->name('gestion.show')->middleware('auth');
Route::post('/gestiones/editar/{gestion}',[GestionController::class, 'update'])->name('gestion.update')->middleware('admin');
Route::get('/gestiones/borrar/{gestion}',[GestionController::class, 'destroy'])->name('gestion.delete')->middleware('admin');

//Rutas Comisiones
Route::get('/comisiones',[ComisioneController::class, 'index'])->name('comisiones.index')->middleware('admin');
Route::get('/comisiones/crear',[ComisioneController::class, 'create'])->name('comisiones.create')->middleware('admin');
Route::get('/comisiones/editar/{comision}',[ComisioneController::class, 'edit'])->name('comisiones.edit')->middleware('admin');
Route::put('/comisiones/editar/{comision}',[ComisioneController::class, 'update'])->name('comisiones.update')->middleware('admin');
Route::post('/comisiones/crear',[ComisioneController::class, 'store'])->name('comisiones.store')->middleware('admin');
Route::delete('/comisiones/eliminar/{comision}',[ComisioneController::class, 'destroy'])->name('comisiones.destroy')->middleware('admin');

//Rutas Liquidaciones
Route::get('/liquidaciones',[LiquidacionController::class, 'index'])->name('liquidacion.index');
Route::post('/liquidaciones/generar',[LiquidacionController::class, 'store'])->name('liquidacion.store')->middleware('admin');
Route::get('/liquidaciones/editar/{liquidacion}',[LiquidacionController::class, 'edit'])->name('liquidacion.edit')->middleware('auth');
Route::delete('/liquidaciones/delete/{liquidacion}',[LiquidacionController::class, 'destroy'])->name('liquidacion.delete')->middleware('admin');
Route::put('/liquidaciones/editar/{liquidacion}',[LiquidacionController::class, 'updateNumeroFactura'])->name('liquidacion.updateFactura')->middleware('auth');
Route::put('/liquidaciones/editar/estado/{liquidacion}',[LiquidacionController::class, 'update'])->name('liquidacion.update')->middleware('admin');
Route::get('/liquidaciones/descargar/{liquidacion}',[LiquidacionController::class, 'descargarLiquidacion'])->name('liquidacion.descargarLiquidacion')->middleware('auth');

Route::get('/anexos',[AnexoController::class, 'index'])->name('anexo.index')->middleware('auth');
Route::post('/anexos',[AnexoController::class, 'store'])->name('anexo.store')->middleware('admin');
Route::get('/anexos/editar/categoria/{categoria}',[AnexoController::class, 'editCategoria'])->name('anexo.editcategoria')->middleware('admin');
Route::put('/anexos/editar/categoria',[AnexoController::class, 'updateCategoria'])->name('anexo.updatecategoria')->middleware('admin');
Route::get('/anexos/editar/subcategoria/{categoria}/{subcategoria}',[AnexoController::class, 'editsubCategoria'])->name('anexo.editsubcategoria')->middleware('admin');
Route::put('/anexos/editar/subcategoria',[AnexoController::class, 'updatesubCategoria'])->name('anexo.updatesubcategoria')->middleware('admin');
Route::get('/anexos/editar/subcategoria/{anexo}',[AnexoController::class, 'edit'])->name('anexo.edit')->middleware('admin');
Route::put('/anexos/editar/subcategoria/{anexo}',[AnexoController::class, 'update'])->name('anexo.update')->middleware('admin');
Route::delete('/anexos/borrar/{anexo}',[AnexoController::class, 'destroy'])->name('anexo.destroy')->middleware('admin');
Route::post('/anexos/borrar/subcategoria/{subcategoria}',[AnexoController::class, 'destroySubCategoria'])->name('anexo.destroySubcategoria')->middleware('admin');
Route::post('/anexos/borrar/categoria/{categoria}',[AnexoController::class, 'destroyCategoria'])->name('anexo.destroycategoria')->middleware('admin');
Route::post('/anexos/descargar/{anexo}',[AnexoController::class, 'descargar'])->name('anexo.descargar')->middleware('auth');

//Rutas 'API'
Route::get('/datos/clientes',[DatosController::class, 'clienteSearch'])->middleware('auth');
Route::get('/datos/contratos/clientes',[DatosController::class, 'contratoCliente'])->middleware('auth');
Route::get('/datos/comercializadora/productos',[DatosController::class, 'productosComercializadora'])->middleware('auth');
Route::get('/datos/comercializadora/productos/lineas',[DatosController::class, 'lineasComercializadora'])->middleware('auth');
Route::get('/datos/cliente/{dni}',[DatosController::class, 'datosCliente'])->middleware('auth');
Route::get('/descargar-archivo/{cliente}/{contrato}/{archivo}', [ArchivoController::class, 'descargarArchivoCliente'])->middleware('auth');
Route::get('/descargar-archivo-telefonico/{cliente}/{contrato}/{archivo}', [ArchivoController::class, 'descargarArchivoClienteTelefonico'])->middleware('auth');
Route::get('/descargar-archivo-json/{contrato}/{tipo}', [ArchivoController::class, 'descargarArchivosJson'])->middleware('auth');
Route::get('/descargar-archivos-gestion/{gestion}', [ArchivoController::class, 'descargarArchivosJsonGestion'])->middleware('auth');
Route::get('/borrar-archivo/{contrato}/{nombre}/{tipo}', [ArchivoController::class, 'borrarArchivos'])->middleware('auth');

