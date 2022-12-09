<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;


class FoodOrderController extends Controller
{
    use RedirectsActions;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request) : Response
    {
        return Jetstream::inertia()->render($request, 'FoodOrders/FoodOrders', []);
    }

     public function create(Request $request) : Response
    {
        return Jetstream::inertia()->render($request, 'FoodOrders/CreateFoodOrders', []);
    }


    public function food_order_deatil(Request $request) : Response
    {
        return Jetstream::inertia()->render($request, 'FoodOrders/FoodOrders-detail', []);
    }


    public function addFoodOrderMethod(Request $request) : Response
    {
        return Jetstream::inertia()->render($request, 'FoodOrders/FoodOrders-add', [
            
        ]);
    }


    public function addFoodOrdernext(Request $request) : Response
    {
        return Jetstream::inertia()->render($request, 'FoodOrders/FoodOrders-detail-next', [
            
        ]);
    }

    public function createFoodOrdernext(Request $request) : Response
    {
        return Jetstream::inertia()->render($request, 'FoodOrders/CreateFoodOrders-next', [
            
        ]);
    }

    



}
