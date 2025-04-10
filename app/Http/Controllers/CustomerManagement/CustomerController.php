<?php

namespace App\Http\Controllers\CustomerManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Factories\Customer\Factory as CustomerFactory;
use App\Factories\Item\Factory as ItemFactory;
use App\User as Users;
use App\Item;
use App\Customer;
use App\CustomerPrice;
use App\Area;


class CustomerController extends Controller
{
      public function __construct(
            Users $user,
            CustomerFactory $customer,
            ItemFactory $items
        )
    {
        $this->user = $user;
        $this->customer = $customer;
        $this->items = $items;
        $this->middleware('auth');
    }

    public function index()
    {
        
        $customers = $this->customer->getindex();

  
        return view('pages.customer_management.index',compact('customers'));
    }


    public function create()
    {
        $items = $this->items->getitemList();

        $item_name = Item::pluck('name','name');

        $creator = $this->user->getCreatedbyAttribute(auth()->user()->id);

        $approver = $this->user->getemplist()->pluck('emp_name','id');
        
        $areas =  Area::pluck('name','id');

        return view('pages.customer_management.create',compact('areas','creator','items','item_name'));
    }


    public function getAdditionalAreaValue(Request $request)
    {   
        
        $results = Area::find($request->id);
        
            return response()->json($results);
    }


    public function getCustomerItemSrp(Request $request)
    {
        $results = $this->customer->getCustomerItemSrp($request->id);

            return response()->json($results);
    }


    public function getAddAllItems(Request $request)
    {
        $results =  $this->items->getitemList();

            return response()->json($results);
    }

    public function getSelectedItems(Request $request)
    {
            $results =  $this->items->getitemname($request->value);

            return response()->json($results);
    }

    public function getItemCost(Request $request)
    {
            $results =  $this->items->getiteminfo($request->value)->first();

            return response()->json($results);
    }


    public function doSave(Request $request)
    {

            $customerPrices = New CustomerPrice;

            $customerPrices->customer_id            = $request->_csx_id;

            $customerPrices->item_id                = $request->item_id;

            $customerPrices->unit_cost              = $request->item_cost;

            $customerPrices->srp                    = $request->srp;

            $customerPrices->srp_discounted         = $request->srpD;

            $customerPrices->percentage_discount    = $request->perD;              

            $customerPrices->activated_discount     = $request->chk_active;

            $customerPrices->set_srp                = $request->setsrp;

            $customerPrices->save();

            $results = $customerPrices->id;

        return response()->json($results);
    }


    public function store(Request $request)
    {

         $this->validate($request, [
            'name'          => 'required',
            'area'          => 'required',
            'address'       => 'required'
        ]);

        $customers = New Customer;

        $customers->name                        = $request->name;

        $customers->area_id                     = $request->area;

        $customers->address                     = $request->address;   

        $customers->contact_person              = $request->contact_person; 

        $customers->contact_number1             = $request->contact_number1;

        $customers->contact_number2             = $request->contact_number2;

        $customers->email                       = $request->email;

        $customers->activated_area_amount       = $request->activated_area_amount;

        $customers->activated_area_percentage   = $request->activated_area_percentage;

        $customers->created_by                 = auth()->user()->id;
          
        $customers->save();

        $getItemIds = $request->get('item_id');
        $getItemSrp = $request->get('item_srp');
        $getItemCost = $request->get('item_cost');
        $getAmountDisc = $request->get('amountD');
        $getPercentDisc = $request->get('perD');
        $activated = $request->get('disc_active');
        $getSetSRP = $request->get('setSRP');


        if (isset($getItemIds)){

            $i = 0;
            foreach ($getItemIds as $key => $getItemId) {

                if (isset($activated[$i])){
                    $activeDisc = 1;
                }else{
                    $activeDisc = 0;
                }
                
                $customerPrices = New CustomerPrice;

                $customerPrices->customer_id            = $customers->id;

                $customerPrices->item_id                = $getItemId;

                $customerPrices->unit_cost              = $getItemCost[$i];

                $customerPrices->srp                    = $getItemSrp[$i];

                $customerPrices->srp_discounted         = $getAmountDisc[$i];

                $customerPrices->percentage_discount    = $getPercentDisc[$i];              

                $customerPrices->activated_discount     = $activeDisc;

                $customerPrices->set_srp                = $getSetSRP[$i];

                $customerPrices->save();

                $i++;

            }
        }

        //for ($i=0; $i < count($getItemId) -1 ; $i++) { }

        return redirect()->route('customer.index')

            ->with('success','Customer has been saved successfully.');
    }

    
    public function edit($id)
    {
       
        $customers = Customer::find($id);

        $items = $this->items->getitemList();

        $item_name = Item::pluck('name','name');

        $creator = $this->user->getCreatedbyAttribute($customers->created_by);

        $approver = $this->user->getemplist()->pluck('emp_name','id');
        
        $areas =  Area::pluck('name','id');

        return view('pages.customer_management.edit',compact('areas','creator','items','customers','item_name'));
    }

    public function update(Request $request,$id)
    {

         $this->validate($request, [
            'name'          => 'required',
            'area'          => 'required',
            'address'       => 'required'
        ]);



        $customers =   Customer::findorfail($id);

        $customers->name                        = $request->name;

        $customers->area_id                     = $request->area;

        $customers->address                     = $request->address;   

        $customers->contact_person              = $request->contact_person; 

        $customers->contact_number1             = $request->contact_number1;

        $customers->contact_number2             = $request->contact_number2;

        $customers->email                       = $request->email;

        $customers->activated_area_amount       = $request->activated_area_amount;

        $customers->activated_area_percentage   = $request->activated_area_percentage;

        $customers->created_by                 = auth()->user()->id;
          
        $customers->save();


            $getItemIds = $request->get('item_id');

            $getItemSrp = $request->get('item_srp');

            //$getItemCost = $request->get('item_cost');

            $getAmountDisc = $request->get('amountD');

            $getPercentDisc = $request->get('perD');

            $getSetSRP = $request->get('setSRP');
            
            $activated = $request->get('disc_active');

                $customerSRPs = CustomerPrice::where('customer_id',$id)->get();

                if(isset($customerSRPs))
                {
                    foreach ($customerSRPs as $key => $customerSRP) 
                    {
                        $csPrice = CustomerPrice::findOrfail($customerSRP->id);

                        $csPrice->delete();
                    }

                }


        if (isset($getItemIds)){

           for ($i=0; $i < count($getItemIds); $i++) { 

                if (isset($activated[$i])){
                    $activeDisc = 1;
                }else{
                    $activeDisc = 0;
                }
                
                $customerPrices = New CustomerPrice;

                $customerPrices->customer_id            = $customers->id;

                $customerPrices->item_id                = $getItemId;

                if (isset($getItemCost[$i])){
                    $customerPrices->unit_cost              = $getItemCost[$i];
                }else{
                    $customerPrices->unit_cost              = 0;
                }
                
                if (isset($getItemSrp[$i])){
                    $customerPrices->srp                    = $getItemSrp[$i];
                }else{
                    $customerPrices->srp                    =0;
                }
             
                if (isset($getAmountDisc[$i])){
                    $customerPrices->srp_discounted         = $getAmountDisc[$i]; 
                }else{
                    $customerPrices->srp_discounted         = 0;
                }
             
                
                if (isset($getPercentDisc[$i])){
                    $customerPrices->percentage_discount    = $getPercentDisc[$i];               
                }else{
                    $customerPrices->percentage_discount    = 0;
                }
                

                $customerPrices->activated_discount     = $activeDisc;

                if (isset($getPercentDisc[$i])){
                    $customerPrices->set_srp                = $getPercentDisc[$i];              
                }else{
                    $customerPrices->set_srp    = 0;
                }


                $customerPrices->save();

            }
        }
       

            
    

        /*    if (isset($activated))
            {
                foreach ($activated as $key => $value) {
                         
                    //$activeID= CustomerPrice::where('customer_id',$id)->where('item_id',$value)->first();

                        $activeID  = $this->customer->getItemFromCustomer($id,$value);
                  
                        $activeprice = CustomerPrice::find($activeID->id);

                        $activeprice->activated_discount = 1;
               
                        $activeprice->save(); 
                
                    
                }
            }*/


        return redirect()->route('customer.index')

            ->with('success','Customer has been updated successfully.');
    }



    public function destroy($id)
    {

        $customers =   Customer::findorfail($id);

        $customers->delete();

            $customerSRPs = CustomerPrice::where('customer_id',$id)->get();

                if(count($customerSRPs) > 0)
                {
                    foreach ($customerSRPs as $key => $customerSRP) 
                    {
                        $csPrice = CustomerPrice::findOrfail($customerSRP->id);

                        $csPrice->delete();
                    }

                }

       return redirect()->route('customer.index')

            ->with('success','Customer has been deleted successfully.');

    }


}
