    <div id="myModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                <h3 class="modal-title"></h3>

            </div>
            <div class="modal-body">
                <div class="form-horizontal m-t-md">
                     
                        <div class="table-responsive">
                            <div class="scroll_content" style="width:100%; height:350px; margin: 0;padding: 0;overflow-y: scroll">
                            <table class="table table-bordered dTable-ItemList-table" id="dTable-ItemList-table">
                                <thead> 
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Description</th>
                                            <th>Units</th>
                                            <th>SRP</th>
                                            <th class="text-center">Remove</th>
                                        </tr>

                                </thead>
                                
                                    <tbody >

                                        @foreach($items as $item)

                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->unit_code}}</td>
                                                <td>{{$item->srp}}</td>
                                                <td class='text-center'>
                                                    <a href="#" class="btn-info btn btn-xs add-item-button" id="add-item-button"
                                                    data-item_id="{{$item->id}}"
                                                    data-item_name="{{$item->name}}"
                                                    data-item_descript="{{$item->description}}"
                                                    data-item_untis="{{$item->unit_code}}"
                                                    data-item_srp="{{$item->srp}}"
                                                    data-item_cost="{{$item->unit_cost}}"><i class="fa fa-plus"></i>
                                                </td>

                                            </tr>

                                        @endforeach
                                           
                                    </tbody>
                                
                            </table> 
                            </div>       
                        </div>
                        

                        <hr>

                    <div class="row">

                        <div class="col-md-12 form-horizontal">

                            <div class="ibox-tools pull-right">
                                
                                <button type="button" class="btn btn-danger btn-close" data-dismiss="modal" >Close</button>       

                            </div>

                        </div>

                    </div>
                
                </div>

            </div>
        </div>
    </div>  
  </div>  


