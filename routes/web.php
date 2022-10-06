<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->get('plane', 'PlanesController@index');
$router->get('plane/{id}', 'PlanesController@show');
$router->post('plane', 'PlanesController@store');
$router->put('plane/{id}', 'PlanesController@update');
$router->delete('plane/{id}', 'PlanesController@destroy');

$router->get('category', 'CategoryController@index');
$router->get('category/{id}', 'CategoryController@show');
$router->post('category', 'CategoryController@store');
$router->post('category/{id}', 'CategoryController@update');
$router->delete('category/{id}', 'CategoryController@destroy');

$router->get('establishment', 'EstablishmentController@index');
$router->get('establishment/{id}', 'EstablishmentController@show');
$router->post('establishment', 'EstablishmentController@store');
$router->post('establishment/{id}', 'EstablishmentController@update');
$router->delete('establishment/{id}', 'EstablishmentController@destroy');

$router->get('contacts-establishment/{id}', 'ContactsEstablishmentController@index');
$router->get('contacts-establishment-id/{id}', 'ContactsEstablishmentController@show');
$router->post('contacts-establishment', 'ContactsEstablishmentController@store');
$router->put('contacts-establishment/{id}', 'ContactsEstablishmentController@update');
$router->delete('contacts-establishment/{id}', 'ContactsEstablishmentController@destroy');

$router->get('product/{id}', 'ProductController@index');
$router->get('product-id/{id}', 'ProductController@show');
$router->post('product', 'ProductController@store');
$router->post('product/{id}', 'ProductController@update');
$router->delete('product/{id}', 'ProductController@destroy');

$router->get('client/{id}', 'ClientController@index');
$router->get('client-id/{id}', 'ClientController@show');
$router->post('client', 'ClientController@store');
$router->put('client/{id}', 'ClientController@update');
$router->delete('client/{id}', 'ClientController@destroy');

$router->get('cashier/{id}', 'CashierController@index');
$router->get('cashier-open/{id}', 'CashierController@show');
$router->post('cashier', 'CashierController@store');
$router->put('cashier/{id}', 'CashierController@update');
$router->delete('cashier/{id}', 'CashierController@destroy');

$router->get('order/{id}/{cashier}', 'OrderController@index');
$router->get('order-id/{id}', 'OrderController@show');
$router->post('order', 'OrderController@store');
$router->put('order/{id}', 'OrderController@update');
$router->delete('order/{id}', 'OrderController@destroy');

$router->get('order-items/{id}', 'OrderItemController@index');
$router->get('order-item/{order}/{product}', 'OrderItemController@show');
$router->post('order-items', 'OrderItemController@store');
$router->delete('order-items/{order}/{product}', 'OrderItemController@destroy');

$router->get('withdraw/{cashier}', 'WithdrawController@index');
$router->get('withdraw-id/{id}', 'WithdrawController@show');
$router->post('withdraw', 'WithdrawController@store');
$router->delete('withdraw/{id}', 'WithdrawController@destroy');

$router->get('setting', 'SettingController@index');
$router->get('setting/{establishment}', 'SettingController@show');
$router->post('setting', 'SettingController@store');
$router->put('setting/{id}', 'SettingController@update');
$router->delete('setting/{id}', 'SettingController@destroy');

$router->get('payment/{establishment}', 'PaymentController@index');
$router->get('payment-id/{id}', 'PaymentController@show');
$router->post('payment', 'PaymentController@store');
$router->put('payment/{id}', 'PaymentController@update');
$router->delete('payment/{id}', 'PaymentController@destroy');

$router->get('notification/{establishment}', 'NotificationController@index');
$router->get('notification-id/{id}', 'NotificationController@show');
$router->post('notification', 'NotificationController@store');
$router->put('notification/{id}', 'NotificationController@update');
$router->delete('notification/{id}', 'NotificationController@destroy');

$router->get('item-adicional/{establishment}', 'ItemAdicionalController@index');
$router->get('item-adicional-id/{id}', 'ItemAdicionalController@show');
$router->post('item-adicional', 'ItemAdicionalController@store');
$router->put('item-adicional/{id}', 'ItemAdicionalController@update');
$router->delete('item-adicional/{id}', 'ItemAdicionalController@destroy');

$router->get('table/{establishment}', 'TableOrderController@index');
$router->get('table-id/{id}', 'TableOrderController@show');
$router->post('table', 'TableOrderController@store');
$router->put('table/{id}', 'TableOrderController@update');
$router->delete('table/{id}', 'TableOrderController@destroy');
