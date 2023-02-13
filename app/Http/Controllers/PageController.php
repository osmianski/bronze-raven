<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Home');
    }
}
