<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Factories\Item\Factory as ItemFactory;
use App\Factories\SalesOrder\Factory as SalesOrderFactory;
use Yajra\Datatables\Datatables;
use App\Item;
use App\Inventory;
use App\SalesOrder;
use App\SalesOrderItems;
use App\UnitOfMeasure; 
use App\Customer; 
use App\WarehouseLocation;
use App\User as Users;
use Carbon\Carbon;
use Fpdf;
use DB;


class SalesController extends Controller
{

    public function __construct(
            Users $user,
            ItemFactory $items,
            SalesOrderFactory $salesorder
        )
    {
        $this->user = $user;
        $this->items = $items;
        $this->salesorders = $salesorder;
        $this->middleware('auth');
    }


    public function index()
    {   

        $salesorders         = $this->salesorders->getindex()->where('status','NEW')->sortByDesc('id');
        $posted_salesorder   = $this->salesorders->getindex()->where('status','POSTED')->sortByDesc('id');
        $cancel_salesorder   = $this->salesorders->getindex()->where('status','CANCELED')->sortByDesc('id');
        $closed_salesorder   = $this->salesorders->getindex()->where('status','CLOSED')->sortByDesc('id');
        

        return view('pages.salesorder.index',compact('salesorders','posted_salesorder','cancel_salesorder','closed_salesorder'));
    }


    public function create()
    {
        
        $items = $this->items->getindex();

        $creator = $this->user->getCreatedbyAttribute(auth()->user()->id);

        $employee = $this->user->getemplist()->pluck('emp_name','id');

        $customer_id = Customer::pluck('name','id');

        $location  = WarehouseLocation::pluck('name','id');

        $salesorder_status = "NEW";

          return view('pages.salesorder.create',compact('employee','creator','customer_id','items','salesorder_status','location'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'po_date'       => 'required',
            'supplier_id'   => 'required',
            'approved_by'   => 'required'
        ]);

        $unitCostTotal=0;

        $salesorder                     = New SalesOrder;

        $salesorder->so_number          = $this->salesorders->getSONo();

        $salesorder->so_date            = $request->so_date;

        $salesorder->remarks            = $request->remarks;

        $salesorder->customer_id        = $request->customer_id;

        $salesorder->unti_cost_total    = $unitCostTotal;

        $salesorder->total_discount     = $request->discount;

        $salesorder->total_sales        = $request->grand_total;

        $salesorder->approved_by        = $request->approved_by;

        $salesorder->created_by         = auth()->user()->id;

        $salesorder->status             = 'NEW';

        $salesorder->save();

        $orders_id      = $orders->id;
        $item_id        = $request->get('item_id');
        $item_quantity  = $request->get('quantity');
        

        for ( $i=0 ; $i < count($item_id) ; $i++ ){

            $items = $this->items->getindex()->where('id', $item_id[$i])->first();

            $order_items                    = New OrderItems;

            $order_items->order_id          = $orders_id;

            $order_items->item_id           = $items->id;

            $order_items->quantity          = $item_quantity[$i];

            $order_items->unit_cost         = 0.00;

            $order_items->unit_total_cost   = 0.00;

            $order_items->save();


        }


        return redirect()->route('salesorder.index')

            ->with('success','Order has been saved successfully.');
    }
    

    public function getInventoryItems(Request $request)
    {
        
        $results = $this->salesorders->getInventoryItems($request->id);   

        return response()->json($results);     

    }

    // Get the Customer Price Setup

    public function getcustomeritems(Request $request)
    {
        $invenId = Inventory::findOrfail($request->id);     

       $csPrice = $this->salesorders->getCSitems($request->cs)->where('item_id',$invenId->item_id)->first();   

        return response()->json(['invenId' => $invenId, 'csPrice' => $csPrice]);;       
        
    }

    public function getPOitems(Request $request)
    {
     
        $results = $this->items->getForPO($request->id);   

        return response()->json($results);       
        
    }




    public function additemSupplier(Request $request)
    {
        
        $results = $this->items->additemSupplier($request->id);   

        return response()->json($results);       
        
    }

    public function orderToSupplier(Request $request)
    {

        $results = $this->orders->orderToSupplier($request->id);

        return response()->json($results); 

      
    }

    
    public function edit($id)
    {

        $items = $this->items->getindex();

        $creator = $this->user->getCreatedbyAttribute(auth()->user()->id);

        $approver = $this->user->getemplist()->pluck('emp_name','id');

        $supplier = Supplier::pluck('name','id');

        $order = Order::find($id);

        $order_status = $order->status;

        return view('pages.salesorder.edit',compact('order','creator','approver','supplier','items','order_status'));

    }


    public function update(Request $request,$id)
    {
          $this->validate($request, [
            'po_date'       => 'required',
            'supplier_id'   => 'required',
            'approved_by'   => 'required'
        ]);


        $orders                  = Order::find($id);

        $orders->po_number      = $request->po_number;

        $orders->po_date        = $request->po_date;

        $orders->remarks        = $request->remarks;

        $orders->supplier_id    = $request->supplier_id;

        $orders->discount       = 0;

        $orders->grand_total    = 0;

        $orders->approved_by    = $request->approved_by;

        $orders->save();

        $item_id        = $request->get('id');
        $item_quantity  = $request->get('quantity');
        


         if(count($request->get('id')) > 0);
        {

            $order_items = OrderItems::where('order_id',$id)->get();

             if(count($order_items) > 0)
             {
                foreach ($order_items as $key => $order_item) 
                {
                    $orderitems = OrderItems::findOrfail($order_item->id);

                    $orderitems->delete();
                }

             }



            for ( $i=0 ; $i < count($item_id) ; $i++ ){

                $items = $this->items->getindex()->where('id', $item_id[$i])->first();

                $order_items                    = New OrderItems;

                $order_items->order_id          = $id;

                $order_items->item_id           = $items->id;

                $order_items->quantity          = $item_quantity[$i];

                $order_items->unit_cost         = 0;

                $order_items->unit_total_cost   = 0;

                $order_items->save();

                               
            }

             return redirect()->route('salesorder.index')

                ->with('success','Order has been saved successfully.');


        } 
   
        {

            return redirect()->back()->with('error','Please add item to purchase!');

        }

        


    }


    public function cancel($id)
    {

        $order = Order::find($id);

        $order->status = 'CANCELED';

         $order->save();

        
        return redirect()->route('salesorder.index')

            ->with('success','Order has been canceled successfully.');

    }


    public function post($id)
    {

        $order = Order::find($id);

        $order->status = 'POSTED';

         $order->save();

        
        return redirect()->route('salesorder.index')

            ->with('success','Order has been posted successfully.');

    }



    public function destroy($id)
    {

        $order = Order::find($id);

        $order_items = OrderItems::where('order_id',$id)->get();

          if(count($order_items) > 0)
            {
                foreach ($order_items as $key => $order_item) 
                {
                    $orderitems = OrderItems::findOrfail($order_item->id);

                    $orderitems->delete();
                }

            }

        $order->delete();

        
        return redirect()->route('salesorder.index')

            ->with('success','Order has been canceled successfully.');

    }


    public function print($id)
    {

        $orders = Order::find($id);       
        
        $pdf = new Fpdf('P');
        $pdf::AddPage('P','A4');
        //$pdf::Image('/home/u648374046/domains/monsais.net/public_html/public/img/monsa-logo-header.jpg',10, 5, 30.00);
        $pdf::Image('img/temporary-logo.jpg',5, 5, 40.00);
        $pdf::SetFont('Arial','B',12);
        $pdf::SetY(20);     


        // Header
        //$pdf::Image('img/monsa-logo-header.jpg',90, 5, 25.00);
        //$pdf::Image('img/qplc_logo.jpg',5, 5, 40.00);
        $pdf::SetFont('Arial','B',12);
        $pdf::SetY(20);  

        $pdf::Ln(2);
        $pdf::SetFont('Arial','B',12);
        $pdf::SetXY($pdf::getX(), $pdf::getY());
        $pdf::cell(185,1,"Purchse Order",0,"","C");

        $pdf::Ln(18);
        $pdf::SetFont('Arial','B',9);
        $pdf::SetXY($pdf::getX(), $pdf::getY());
        $pdf::cell(20,6,"PO Number",0,"","L");
        $pdf::SetFont('Arial','',9);
        $pdf::cell(40,6,': '.$orders->po_number,0,"","L");
        $pdf::SetFont('Arial','B',9);
        $pdf::cell(100,6,"PO Date",0,"","R");
        $pdf::SetFont('Arial','',9);
        $po_date = Carbon::parse($orders->po_date);
        $pdf::cell(30,6,': '.$po_date->format('M d, Y'),0,"","L");
        

        $pdf::Ln(6);
        $pdf::SetFont('Arial','B',9);
        $pdf::SetXY($pdf::getX(), $pdf::getY());
        $pdf::cell(20,6,"Supplier",0,"","L");
        $pdf::SetFont('Arial','',9);
        $supplier = Supplier::find($orders->supplier_id);
        $pdf::cell(40,6,': '.$supplier->name,0,"","L");

        $pdf::Ln(6);
        $pdf::SetFont('Arial','B',9);
        $pdf::SetXY($pdf::getX(), $pdf::getY());
        $pdf::cell(20,6,"Status",0,"","L");
        $pdf::SetFont('Arial','',9);
        $pdf::cell(40,6,': '.$orders->status,0,"","L");

        $pdf::Ln(6);
        $pdf::SetFont('Arial','B',9);
        $pdf::SetXY($pdf::getX(), $pdf::getY());
        $pdf::cell(20,6,"Remarks",0,"","L");
        $pdf::SetFont('Arial','',9);
        $pdf::cell(40,6,': '.$orders->remarks,0,"","L");


        //Column Name
            $pdf::Ln(15);
            $pdf::SetFont('Arial','B',9);
            $pdf::cell(10,6,"No.",0,"","L");
            $pdf::cell(40,6,"Item Name",0,"","L");
            $pdf::cell(75,6,"Description",0,"","L");
            $pdf::cell(25,6,"Unit",0,"","C");
            $pdf::cell(30,6,"Order Quantity",0,"","C");


         $pdf::Ln(1);
        $pdf::SetFont('Arial','',9);
        $pdf::cell(30,6,"_________________________________________________________________________________________________________",0,"","L");

        $orde_items = $this->items->getForPO($id);;
        $order_number = 0;
        foreach ($orde_items as $key => $value) {

            $pdf::Ln(5);
            $pdf::SetFont('Arial','',9);
            $pdf::cell(10,6,$order_number=$order_number+1,0,"","L");
            $pdf::cell(40,6,$value->name,0,"","L");
            $pdf::cell(75,6,$value->description,0,"","L");
  
            $pdf::cell(25,6,$value->units,0,"","C");
            $pdf::cell(30,6,number_format($value->quantity,2),0,"","C");
        }

        $pdf::Ln(5);
            $pdf::SetFont('Arial','I',8);
            $pdf::cell(185,6,"--Nothing Follows--",0,"","C");

        $pdf::Ln(3);
        $pdf::SetFont('Arial','',9);
        $pdf::cell(30,6,"_________________________________________________________________________________________________________",0,"","L");


        /*
        $pdf::Ln(10);
        $pdf::SetFont('Arial','B',9);
        $pdf::cell(150,6,"Discount :",0,"","R");
        $pdf::SetFont('Arial','',9);
        $pdf::cell(30,6,number_format($orders->discount,2),0,"","R");

        $pdf::Ln(5);
        $pdf::SetFont('Arial','B',9);
        $pdf::cell(150,6,"Total Amount :",0,"","R");
        $pdf::SetFont('Arial','',9);
        $pdf::cell(30,6,number_format($orders->grand_total,2),0,"","R");
        */
       

        $preparedby = $this->user->getCreatedbyAttribute($orders->created_by);
       

        $approveddby = $this->user->getCreatedbyAttribute($orders->approved_by);
       

        $pdf::Ln(25);
        $pdf::SetFont('Arial','B',9);
        $pdf::cell(60,6,"      ".$preparedby."      ",0,"","C");
        $pdf::cell(60,6,"      ".""."      ",0,"","C");
        $pdf::cell(60,6,"      ".$approveddby."      ",0,"","C");

        $pdf::ln(0);
        $pdf::SetFont('Arial','',9);
        $pdf::cell(60,6,"_________________________",0,"","C");
        $pdf::cell(60,6,"",0,"","C");
        $pdf::cell(60,6,"_________________________",0,"","C");


        $pdf::Ln(4);
        $pdf::SetFont('Arial','',9);
        $pdf::cell(60,6,"Prepared by",0,"","C");
        $pdf::cell(60,6,"",0,"","C");
        $pdf::cell(60,6,"Approved by",0,"","C");


        $pdf::Ln();
        $pdf::Output();
        exit;

    }
}   