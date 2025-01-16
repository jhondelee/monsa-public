<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Factories\Dashboard\Factory as DashboardFactory;
use App\Factories\User\Factory as UserFactory;
use App\Role;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
                DashboardFactory $dashboard,
                UserFactory $user

     ){ 
        $this->user               = $user;
        $this->dashboard          = $dashboard;
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $user = auth()->user()->id;
        $role = role::where('level',$user)->first();

        

    //----SALES Previous Month---//
            $sales = $this->dashboard->sales_of_previous_month()->first();
            $sales_total = 0;
            if (!$sales ){


                $sales_monthyear = $this->dashboard->current_year()->first();

                $sales_monthyear = $sales_monthyear->cur_yr;
 
                $sales_total = '0.00';

            }else{


                $sales_monthyear = $sales->sales_monthyear;

                $sales_total = $sales->total_sales;

            }
        
    //----SALES Current Month---//
        $c_sales = $this->dashboard->sales_of_current_month()->first();
  
        if (! $c_sales ){

            $sales_percent = "0";

            $current_sales = "0.00"; 

        } else {

            $current_sales = $c_sales->total_sales;

            if ($sales_total > 0){

             $sales_percent =  $c_sales->total_sales / $sales->total_sales * 100;

            }else{

                $sales_percent = "0";

            }
        }

        //----ORDER Previous Month---//
            $orders = $this->dashboard->order_of_previous_month()->first();
            $order_total = 0;
            if (!$orders ){


                $orders_monthyear = $this->dashboard->current_year()->first();

                $orders_monthyear = $orders_monthyear->cur_yr;
 
                $order_total = '0.00';

            }else{


                $orders_monthyear = $orders->order_monthyear;

                $order_total = $orders->total_order;

            }
        
    //----ORDER Current Month---//
        $c_orders = $this->dashboard->order_of_current_month()->first();

        if (! $c_orders->total_order ){

            $order_percent = "0";

            $current_orders = "0.00"; 

        } else {

            $current_orders = $c_orders->total_order;

            if ($order_total > 0){

             $order_percent =  $c_orders->total_order / $orders->total_order * 100;

            }else{

                $order_percent = "0";

            }
        }

           


        return view('pages.dashboard.index',compact(
                    'sales_monthyear',
                    'sales_total',
                    'sales_percent',
                    'orders_monthyear',
                    'order_total',
                    'order_percent',
                    'current_orders',
                    'current_sales'
            ));
               
    }


}
