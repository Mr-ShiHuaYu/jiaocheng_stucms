<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class Test extends Controller
{
    public function index()
    {
        $pwd = Hash::make('12345678');
        dump($pwd);
    }
}
