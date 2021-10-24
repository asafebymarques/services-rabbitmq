<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessOrder;

class OrderController extends Controller
{
    public function order(Request $request) 
    {
        $data = [
            'name' => 'Asafe Marques',
            'email' => 'asafebymarques@icloud.com',
            'cc' => '40043443242342',
            'exp' => '12/21',
            'cvv' => '321'
        ];

        ProcessOrder::dispatch($data)->onConnection('rabbitmq');
    }
}