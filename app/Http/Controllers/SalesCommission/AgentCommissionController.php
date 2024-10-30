<?php

namespace App\Http\Controllers\SalesCommission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Factories\AssignArea\Factory as AssignAreaFactory;
use App\User as Users;
use App\Area;
use App\CommissionRate;
use App\AssignArea;
use DB;

class AgentCommissionController extends Controller
{
     public function __construct(
            Users $user,
            AssignAreaFactory $assing_areas
        )
    {
        $this->user = $user;
        $this->assignedarea = $assing_areas;
        $this->middleware('auth');  
    }


    public function index()
    {
        $employee = $this->user->getemplist()->pluck('emp_name','id');

        return view('pages.sales_commission.commission.index',compact('employee'));
    }

        public function create(Request $request)
    {
        $employee = $this->user->getemplist()->pluck('emp_name','id');

        return view('pages.sales_commission.commission.index',compact('employee'));
    }
}
