<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['test']]);
    }

    public function test()
    {
        $data = ['data' => 'Working'];
        return $data;

        // return $data;
    }
}
