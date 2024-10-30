<?php

namespace App\Http\Controllers\SalesCommission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Factories\AgentCommission\Factory as AgentCommissionFactory;
use App\User as Users;
use App\Area;
use App\CommissionRate;
use App\AssignArea;
use DB;

class AgentCommissionController extends Controller
{
     public function __construct(
            Users $user,
            AgentCommissionFactory $agent_commission
        )
    {
        $this->user = $user;
        $this->agentcommission = $agent_commission;
        $this->middleware('auth');  
    }


    public function index()
    {
        $employee = $this->user->getemplist()->pluck('emp_name','id');

        return view('pages.sales_commission.commission.index',compact('employee'));
    }

    public function create()
    {

        $employee = $this->user->getemplist()->pluck('emp_name','id');

        $creator = $this->user->getCreatedbyAttribute(auth()->user()->id);

        return view('pages.sales_commission.commission.create',compact('employee','creator'));
    }

     public function store(Request $request)
     {
        $this->validate($request,[
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);



        return redirect()->route('commission.index')

            ->with('success','Agent Commission has been saved successfully.');

     }

     public function generateCommission(Request $request)
     {
        
        $results = $this->agentcommission->getsalesCom($request->id);   

        return response()->json($results); 
        
     }


}
