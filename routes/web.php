<?php

$router->get('/', function (){
    return view('home');
});

$router->post('/saveCsv', [    
    'middleware' => [
        App\Http\Middleware\InsertClientes::class
    ]
]);

$router->get('/entrega', [    
    'middleware' => [
        App\Http\Middleware\LogicaEntrega::class
    ]
]);