<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use Carbon\Carbon;

Route::get('login','Auth\AuthController@getLogin');
Route::post('login',['as' => 'login','uses' => 'Auth\AuthController@postLogin']);
Route::get('logout',['as' => 'auth.logout','uses' => 'Auth\AuthController@getLogout']);

Route::group(['prefix' => '/','middleware' => 'auth'],function(){

    Route::get('/',['as' => 'home','uses' => 'PagesController@home']);
    Route::get('perfil',['as' => 'auth.profile','uses' => 'PagesController@profile']);
    Route::get('test',function(){
        $user = \App\User::find(3);
        $user->password = bcrypt('12345678');
        $user->save();
    });

    Route::group(['middleware' => 'role:administrador'],function(){

        /*
         * Delete Routes
         */

        Route::post('usuario/{id}/delete',['as' => 'usuario.destroy','uses' => 'UserController@destroy']);
        Route::post('rol/{id}/delete',['as' => 'rol.destroy','uses' => 'RoleController@destroy']);
        Route::post('permiso/{id}/delete',['as' => 'permiso.destroy','uses' => 'PermissionController@destroy']);
        Route::post('tipo_pregunta/{id}/delete',['as' => 'tipo_pregunta.destroy','uses' => 'TipoPreguntaController@destroy']);

        /*
         * Resources
         */
        Route::resources([
            'usuario'          => 'UserController',
            'rol'              => 'RoleController',
            'permiso'          => 'PermissionController',
            'cliente'          => 'ClienteController',
            'pregunta_secreta' => 'PreguntaSecretaController',
            'tipo_pregunta'    => 'TipoPreguntaController',
            'asociado'         => 'AsociadoController'
        ]);


        /*
         * JSON POST
         */

        Route::post('usuarios','UserController@postJsonList');
        Route::post('roles','RoleController@postJsonList');
        Route::post('permisos','PermissionController@postJsonList');
        Route::post('clientes','ClienteController@postJsonList');
        Route::post('obtener_tipo_pago/{id}','TipoPagoController@getJsonTipoPago');
        Route::post('preguntas','PreguntaSecretaController@getJsonPregunta');
        Route::post('tipos_preguntas','TipoPreguntaController@getJsonList');
        Route::post('asociados/{id}','AsociadoController@getJsonListByCliente');

        /*
         * OTHERS
         */
        Route::get('rol/{id}/attachperms','RoleController@getAttachPerms');
        Route::post('rol/{id}/attachperms',['as' => 'rol.attachperms','uses' => 'RoleController@postAttachPerms']);

        Route::post('addtocart',['as' => 'cart.add','uses' => 'PagesController@postAddToCart']);
        Route::get('detalle_carro',['as' => 'cart.detail','uses' => 'PagesController@cartDetail']);
        Route::get('confirmacion_compra',['as' => 'cart.confirmation','uses' => 'PagesController@order_confirmation']);
        Route::post('generar_orden',['as' => 'cart.generate','uses' => 'PagesController@postOrderGenerate']);
        Route::post('cancelar_compra',['as' => 'cart.cancel','uses' => 'PagesController@orderCancel']);
        Route::get('finalizar_compra',['as' => 'cart.finish','uses' => 'PagesController@getFinishOrder']);
        Route::post('finalizar_compra',['as' => 'cart.finish','uses' => 'PagesController@postFinishOrder']);


        Route::get('seleccionar_cliente',['as' => 'client.choose','uses' => 'PagesController@getChooseCli']);
        Route::get('seleccionar_producto',['as' => 'product.choose','uses' => 'PagesController@getChooseProd']);
        Route::get('consumo/seleccionar_cliente',['as' => 'consumo.seleccion.cliente','uses' => 'PagesController@getSearchCliente']);
        Route::get('cargar_cuenta_cliente/{id}',['as' => 'client.account','uses' => 'PagesController@getClientAccount']);
        Route::post('cargar_gasolina/{id}',['as' => 'cliente.cargar','uses' => 'PagesController@postCargarGasolina']);
        Route::get('ordenes',['as' => 'ordenes','uses' => 'PagesController@getOrdenes']);
        Route::get('consumos',['as' => 'consumos.clientes','uses' => 'PagesController@getConsumosClientes']);

        Route::get('cliente/{id}/asociados',['as' => 'cliente.asociados','uses' => 'AsociadoController@getByCliente']);
        Route::get('asociado/create/cliente/{id}','AsociadoController@createByCliente');
    });

    Route::get('mi_cuenta',['as' => 'cart.account','uses' => 'PagesController@getAccount','middleware' => 'role:cliente']);
});
