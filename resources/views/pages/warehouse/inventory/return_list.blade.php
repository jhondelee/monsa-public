    <a href="{{route('returns.create')}}" class="btn btn-warning btn-sm">
    <i class="fa fa-plus">&nbsp;</i>Return Item</a>

    <div class="hr-line-dashed"></div>
    <table class="table table-striped table-hover dataTables-items">
        <thead>
            <tr>

                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Units</th>
                <th>On Hand</th>
                <th>Location</th>
                <th class="text-center">Action</th>  

            </tr>
        </thead>
        <tbody>
            @foreach($returnLists as $returnList)
                <tr>           
                    <td>{{$returnList->id}}</td>
                    <td>
                        @if ($returnList->picture!="")
                            <img class="img-thumbnail img-responsive text-center"  width="56" height="56" src="/item_image/{!! $returnList->picture !!}"/>
                        @else
                            <img class="img-thumbnail img-responsive text-center"  width="56" height="56" alt="image" src="{!! asset('item_image/image_default.png') !!}">
                        @endif
                        {{$returnList->name}}
                    </td>
                    <td>{{$returnList->description}}</td>
                    <td>{{$returnList->units}}</td>
                    <td>{{$returnList->onhand_quantity}}</td>
                    <td>{{$returnList->location}}</td>
                    <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('inventory.show',$returnList->item_id)}}" class="btn-primary btn btn-xs"><i class="fa fa-eye"></i></a>
                            </div>
                    </td>
                </tr>
            @endforeach                                                           
        </tbody>
    </table>
