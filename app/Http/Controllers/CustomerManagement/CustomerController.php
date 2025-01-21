<?php

namespace App\Http\Controllers\CustomerManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Factories\Customer\Factory as CustomerFactory;
use App\Factories\Item\Factory as ItemFactory;
use App\User as Users;
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

        $creator = $this->user->getCreatedbyAttribute(auth()->user()->id);

        $approver = $this->user->getemplist()->pluck('emp_name','id');
        
        $areas =  Area::pluck('name','id');

        return view('pages.customer_management.create',compact('areas','creator','items'));
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

        $getItemId = $request->get('item_id');
        $getItemSrp = $request->get('item_srp');
        $getItemCost = $request->get('item_cost');
        $getAmountDisc = $request->get('amountD');
        $getPercentDisc = $request->get('perD');
        $activated = $request->get('disc_active');
        $getSetSRP = $request->get('setSRP');

        for ($i=0; $i < count($getItemId); $i++) { 

            if (isset($activated[$i])){
                $activeDisc = 1;
            }else{
                $activeDisc = 0;
            }
            
            $customerPrices = New CustomerPrice;

            $customerPrices->customer_id            = $customers->id;

            $customerPrices->item_id                = $getItemId[$i];

            $customerPrices->unit_cost              = $getItemCost[$i];

            $customerPrices->srp                    = $getItemSrp[$i];

            $customerPrices->srp_discounted         = $getAmountDisc[$i];

            $customerPrices->percentage_discount    = $getPercentDisc[$i];              

            $customerPrices->activated_discount     = $activeDisc;

            $customerPrices->set_srp                = $getSetSRP[$i];

            $customerPrices->save();
        }

        return redirect()->route('customer.index')

            ->with('success','Customer has been saved successfully.');
    }

    
    public function edit($id)
    {
       
        $customers = Customer::find($id);

        $items = $this->items->getitemList();

        $creator = $this->user->getCreatedbyAttribute($customers->created_by);

        $approver = $this->user->getemplist()->pluck('emp_name','id');
        
        $areas =  Area::pluck('name','id');

        return view('pages.customer_management.edit',compact('areas','creator','items','customers'));
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


            $getItemId = $request->get('item_id');

            $getItemSrp = $request->get('item_srp');

            $getItemCost = $request->get('item_cost');

            $getAmountDisc = $request->get('amountD');

            $getPercentDisc = $request->get('perD');

            $getSetSRP = $request->get('setSRP');



                $customerSRPs = CustomerPrice::where('customer_id',$id)->get();

                if(count($customerSRPs) > 0)
                {
                    foreach ($customerSRPs as $key => $customerSRP) 
                    {
                        $csPrice = CustomerPrice::findOrfail($customerSRP->id);

                        $csPrice->delete();
                    }

                }


        for ($i=0; $i < count($getItemId); $i++) { 
            
            $customerPrices = New CustomerPrice;

            $customerPrices->customer_id            = $customers->id;

            $customerPrices->item_id                = $getItemId[$i];

            $customerPrices->unit_cost              = $getItemCost[$i];

            $customerPrices->srp                    = $getItemSrp[$i];

            $customerPrices->srp_discounted         = $getAmountDisc[$i];

            $customerPrices->percentage_discount    = $getPercentDisc[$i];              

            $customerPrices->set_srp                = $getSetSRP[$i];

            $customerPrices->save();
        }

        $activated = $request->get('disc_active');

        if (isset ($activated))
        {
            foreach ($activated as $key => $value) {
                     
                $activeprice = CustomerPrice::where('customer_id',$id)->where('item_id',$value)->first();

                $activeprice->activated_discount = 1;

                $activeprice->save();
            }
        }


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
