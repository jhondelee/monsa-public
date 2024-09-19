
    <table class="table table-bordered table-hover dataTables-consumable-items" id="dataTables-consumable-items">
        
        <thead>

            <tr>
                <th>ID</th>
                <th>Item Description</th>
                <th>Unit</th>
                <th>Request Qty</th>
                <th>Status</th>
                <th>Created by</th>
                <th>Action</th>  
            </tr>

        </thead>
                                        
        <tbody>

            @foreach($requestlist as $request)
                                            
                <tr>
                    
                    <td>{{$request->id}}</td>
                    <td>{{$request->reference_no}}</td>
                    <td>{{$request->description}}</td>
                    <td>{{$request->units}}</td>
                    <td>{{$request->request_qty}}</td>   

                    <td class="text-center">
                        @if ($request->posted == 0)
                            <label class="label label-warning " >Unpost</label>
                        @else
                            <label class="label label-success " >Posted</label>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="#" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                        </div> 
                        @if ($request->posted == 0)
                        <div class="btn-group">
                            <a href="{{route('consumables.delete_request',$request->id)}}" class="btn-primary btn btn-xs"><i class="fa fa-trash"></i></a>
                        </div>
                        @endif                
                    </td>

                </tr>  
            @endforeach
                                                                               
        </tbody>

    </table>




