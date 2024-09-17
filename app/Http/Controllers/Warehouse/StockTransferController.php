<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Factories\StockTransfer\Factory as StockTransferFactory;
use App\Factories\Inventory\Factory as InventoryFactory;
use App\Factories\Item\Factory as ItemFactory;
use App\Factories\Incoming\Factory as IncomingFactory;
use App\User as Users;
use App\Item;
use App\Incoming;
use App\Inventory;
use App\InventoryMovement;
use App\InventoryMovementItems;
use App\WarehouseLocation;
    use Carbon\Carbon;
use Fpdf;
use DB;



class StockTransferController extends Controller
{
      public function __construct(
            Users $user,
            ItemFactory $items,
            InventoryFactory $inventory,
            IncomingFactory $incomings,
            StockTransferFactory $stocktransfer
        )
    {
        $this->user = $user;
        $this->inventory = $inventory;
        $this->items = $items;
        $this->incomings = $incomings;
        $this->stocktransfer =  $stocktransfer;
        $this->middleware('auth');  
    }

    public function index()
    {   

        $location = WarehouseLocation::pluck('name','id');

        return view('pages.warehouse.stock_transfer.add',compact('location'));
    }

    public function create()
    {   

        $location = WarehouseLocation::pluck('name','id');

        return view('pages.warehouse.stock_transfer.add',compact('location'));
    }

    public function sourcedataTable(Request $request)
    {   
        $results = $this->stocktransfer->AddTransferItem($request->id);
        
        return response()->json($results);
    }



    public function store(Request $request)
    {   
        $this->validate($request, [
            'reference_no'  => 'required',
            'source'        => 'required',
            'destination'   => 'required',
            'transfer_date' => 'required'
        ]);


        $inv_movement = New InventoryMovement;

        $inv_movement->reference_no     = $request->reference_no;

        $inv_movement->source           = $request->source;

        $inv_movement->destination      = $request->destination;

        $inv_movement->notes            = $request->notes;

        $inv_movement->transfer_date    = $request->transfer_date;

        $inv_movement->created_by       = $this->user->getCreatedbyAttribute(auth()->user()->id);;

        $inv_movement->status           = 'CREATED';

        $inv_movement->save();


            $inven_id = $request->get('item_id');

            $req_quantity = $request->get('qty_value');


                for ( $i=0 ; $i < count($inven_id) ; $i++ ){

                    $inv_items = Inventory::findorfail($inven_id[$i]);

                        $inv_movement_items = New InventoryMovementItems;

                        $inv_movement_items->inventory_movement_id      = $inv_movement->id;

                        $inv_movement_items->inventory_id               = $inven_id[$i];

                        $inv_movement_items->item_id                    = $inv_items->item_id;

                        $inv_movement_items->quantity                   = $req_quantity[$i];

                        $inv_movement_items->from_locaton               = $request->source;

                        $inv_movement_items->to_location                = $request->destination;

                        $inv_movement_items->posted                     = 0;

                        $inv_movement_items->save();
                }    

        return redirect()->route('transfer.index')

            ->with('success','Inventory Movement has been successfully added.');
    }

}
