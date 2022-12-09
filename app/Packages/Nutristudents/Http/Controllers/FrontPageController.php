<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;

class FrontPageController extends Controller
{
    public function getMainHomePage(Request $request){        
        return Jetstream::inertia()->render($request, 'FrontPages/HomePage', []);
    }

    public function getMenuPage(Request $request){        
        return Jetstream::inertia()->render($request, 'FrontPages/MenuPage', []);
    }
}
