    
@extends('layouts.app')

@section('pageTitle','Customer')

@section('content')



      <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Customer Mgnt.</h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="{{route('main')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Customer</strong>
                        </li>
                    </ol>

                </div>

        </div>
@include('layouts.alert')
@include('layouts.deletemodal')
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">

                <div class="col-lg-12">

                    <div class="ibox float-e-margins">

                        <div class="ibox-title">

                            <h5>Customer</h5>
                            <div class="ibox-tools"> 
                                    <a href="{{route('customer.index')}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-reply">&nbsp;</i>Back
                                    </a> 
                                </div>
                        </div>

                        <div class="ibox-content">

                            <div class="form-horizontal m-t-md">

  
                            {!! Form::model($customers, ['route' => ['customer.update', $customers->id],'id'=>'customer_form']) !!}

                                        
                            {!! Form::token(); !!}

                            {!! csrf_field() ; !!}

                        

                             <div class="form-group">
                                <input type="hidden" name="customer_id" id="customer_id" value="{{$customers->id}}">
                                <label class="col-sm-2 control-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::text('name',null, ['class'=>'form-control customer_name', 'required'=> true ,'id'=>'customer_name']) !!}
                                </div>
                                
                                <label class="col-sm-2 control-label">Contact Person</label>
                                <div class="col-sm-3">
                                
                                       {!! Form::text('contact_person',null, ['class'=>'form-control contact_person','id'=>'contact_person']) !!}
                                </div>


                            </div>


                            <div class="form-group">
                                 <label class="col-sm-2 control-label">Area <span class="text-danger">*</span></label>

                                <div class="col-sm-3">
                                    {!! Form::select ('area',$areas, $customers->area_id,['placeholder' => 'Choose Source Location...','class'=>'chosen-select required area', 'required'=>true])!!}
                                </div>
                                
                    
                            
                            <label class="col-sm-2 control-label">Contact Number 1</label>
                                <div class="col-sm-3">
                                     {!! Form::text('contact_number1',null, ['class'=>'form-control contact_no2' ,'id'=>'contact_no2']) !!}
                                </div>

                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-3">
                                    <div class="checkbox checkbox-success">
                                        {!! Form::checkbox('activated_area_amount', '1', null, ['id'=>'activated_amount']) !!}
                                        <label for="activated_amount">
                                            Activate Amount (Area)
                                        </label>
                                    </div>
                                </div>

                                <label class="col-sm-2 control-label">Contact Number 2</label>
                                <div class="col-sm-3">
                                     {!! Form::text('contact_number2',null, ['class'=>'form-control contact_no1','id'=>'contact_no1']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-3">
                                    <div class="checkbox checkbox-success">
                                        {!! Form::checkbox('activated_area_percentage', '1', null, ['id'=>'activated_precent']) !!}
                                        <label for="activated_precent">
                                            Activate Percentage (Area)
                                        </label>
                                    </div>
                                </div>


                                <label class="col-sm-2 control-label">Prepared by </label>
                                <div class="col-sm-3">
                                    {!! Form::text('created_by',$creator, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                                
                            </div>
                                   
                            <div class="form-group">

                                <label class="col-sm-2 control-label">Address <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                       {!! Form::textarea('address',null, array('class' => 'form-control', 'rows' => 3,'id'=>'address','required'=>true)) !!}
                                </div>  
                                
                                <label class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-3">
                                     {!! Form::text('email',null, ['class'=>'form-control email','id'=>'email']) !!}
                                </div>

                            </div>

                             
                            <div class="form-group">

                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4">
                                    <a class='btn btn-info btn-sm btn-add-item' id="btn-add-item"><i class='fa fa-plus'></i> Item</a>
                                </div>
                            </div>
                                                        
                            <div class="table-responsive">
                                                         
                                <table class="table table-bordered" id="dTable-price-item-table">                  

                                    <thead> 
                                        
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Item Description</th>
                                            <th>Units</th>
                                            <th>SRP</th>
                                            <th>Discount ₱</th>
                                            <th>Discount %</th>
                                            <th>Active</th>
                                            <th>Set SRP</th>
                                            <th class="text-center">Remove</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                            

                                    </tbody>

                                </table>
                                
                                <hr>
                            </div>
                            <div class="hr-line-dashed"></div>
                                <div class="row">
                                    <div class="col-md-12 form-horizontal">
                             
                                        <div class="ibox-tools pull-right">
                                             
                                                   
                                        <a class="btn btn-primary btn-danger" href="{{ route('customer.index') }}">Close</a> 

                                                      
                                                                                    
                                        {!! Form::submit('Save Changes', ['class' => 'btn btn-primary btn-save']) !!}  


                                         </div>

                                    </div>
                                </div>

                            {!! Form::close() !!}

                            </div>
                                                                     
                        </div>

                    </div>

                </div>

            </div>

        </div>


   
  @include('pages.customer_management.additem')
  @endsection

@section('scripts')

<script src="/js/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
              $('.dTable-ItemList-table').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []

            });

    });

    //add all items
  $(document).on('click','#add-all-item', function(){

        var _id = $('#customer_id').val();
      
        $.ajax({
            url:  '{{ url('all-items/price') }}',
            type: 'POST',
            dataType: 'json',
            data: { _token: "{{ csrf_token() }}",
            id: _id}, 
            success:function(results){
                
                for( var i = 0 ; i <= results.length ; i++ ) {
                   
                    $('#dTable-price-item-table tbody').append("<tr><td>"+item_id+"<input type='hidden' name='item_id[]' id='item_id' value="+item_id+"></td><td>"+item_descript+"</td><td>"+item_units+"</td><td>"+item_srp+"<input type='hidden' name='item_srp[]' id='item_srp' value="+item_srp+"><input type='hidden' name='item_cost[]' value="+item_cost+"></td>\
                        <td><input type='input' size='4' name='amountD[]' class='form-control input-sm text-right' placeholder='0.00' id='amountD'> </td>\
                        <td><input type='input' size='4' name='perD[]'  class='form-control input-sm text-right ' placeholder='0.00' id='perD'></td>\
                        <td class='text-center'><input type='checkbox' name='disc_active[]' id='disc_active' value='0'/></td>\
                        <td><input type='input' size='4' name='setSRP[]'  class='form-control input-sm text-right setSRP' placeholder='0.00' id='setSRP' readonly></td>\
                        <td class='text-center'><a class='btn btn-xs btn-danger' id='delete_line'><i class='fa fa-minus'></i>\
                    </td></tr>");
                    }
                }                
        });

        toastr.success('Items has been added!')

    });


    //add item on list
    $(document).on('click','.add-item-button', function(){

        var item_id = $(this).data('item_id');
        var item_name = $(this).data('item_name');
        var item_descript = $(this).data('item_descript');
        var item_units = $(this).data('item_untis');
        var item_cost = $(this).data('item_cost');
        var item_srp = $(this).data('item_srp');

        $('#dTable-price-item-table tbody').append("<tr><td>"+item_id+"<input type='hidden' name='item_id[]' id='item_id' value="+item_id+"></td><td>"+item_descript+"</td><td>"+item_units+"</td><td>"+item_srp+"<input type='hidden' name='item_srp[]' id='item_srp' value="+item_srp+"><input type='hidden' name='item_cost[]' value="+item_cost+"></td>\
            <td><input type='input' size='4' name='amountD[]' class='form-control input-sm text-right' placeholder='0.00' id='amountD'> </td>\
            <td><input type='input' size='4' name='perD[]'  class='form-control input-sm text-right ' placeholder='0.00' id='perD'></td>\
            <td class='text-center'><input type='checkbox' name='disc_active[]' id='disc_active' value='"+item_id+"'/></td>\
            <td><input type='input' size='4' name='setSRP[]'  class='form-control input-sm text-right setSRP' placeholder='0.00' id='setSRP' readonly></td>\
            <td class='text-center'><a class='btn btn-xs btn-danger' id='delete_line'><i class='fa fa-minus'></i>\
        </td></tr>");

        toastr.success(item_descript,'Added!')

    });

    //show modal
    $(document).on('click', '.btn-add-item', function() {
        $('.modal-title').text('Add Item');
        $('#myModal').modal('show'); 
    });




    
     // remove item 
    $('#dTable-price-item-table').on('click', '#delete_line', function(){
        $(this).closest('tr').remove();
    });
    
     $('#dTable-price-item-table').on('click','#disc_active',function(e){
 
        var _chckbox_per = $(this).closest('tr').find('#disc_active').val();

        if($(this).closest('tr').find('#disc_active').is(':checked')){

            var _srp = parseFloat($(this).closest( 'tr ').find( '#item_srp' ).val());

            var _srpD = parseFloat($(this).closest( 'tr ').find( '#amountD' ).val());

            var _perD = parseFloat($(this).closest( 'tr' ).find( '#perD' ).val());


                if ( !_perD == false && !_srpD == false ){

                    $(this).closest( 'tr').find( '#setSRP' ).val('0');

                }

                if ( !_srpD == false && !_perD == true){

                    var _amoundD=0.00;

                        if (isNaN( _srpD )){
                            _srpD = 0.00;
                        }else{
                            _amoundD = ( _srp - _srpD );
                        }

                    $(this).closest( 'tr').find( '#setSRP' ).val( _amoundD.toFixed(2));
                    
                }

                if ( !_perD == false && !_srpD == true ){

                    var _perAmount = 0.00;
                    var _SetSRP = 0.00;

                        if (isNaN(_perD)){
                            _SetSRP = 0.00;
                        }else{

                            _perAmount = ( _srp * _perD ) / 100;

                            _SetSRP = ( _srp - _perAmount);

                        }

                    $(this).closest( 'tr').find( '#setSRP' ).val( _SetSRP.toFixed(2))   ;
                    
                }

                

            
        } else {

            $(this).closest( 'tr').find( '#setSRP' ).val('0.00');
        }    
             
     });


    $(document).ready(function(){
    
        var _id = $('#customer_id').val();
      
        $.ajax({
            url:  '{{ url('customer/price') }}',
            type: 'POST',
            dataType: 'json',
            data: { _token: "{{ csrf_token() }}",
            id: _id}, 
            success:function(results){
                
                for( var i = 0 ; i <= results.length ; i++ ) {
                   //append to table
                    $('#dTable-price-item-table tbody').append("<tr><td>"+results[i].item_id+"<input type='hidden' name='item_id[]' id='item_id' value="+results[i].item_id+"></td><td>"+results[i].item_descript+"</td><td>"+results[i].item_units+"</td><td>"+results[i].item_srp+"<input type='hidden' name='item_srp[]' id='item_srp' value="+results[i].item_srp+"><input type='hidden' name='item_cost[]' value="+results[i].item_cost+"></td>\
                        <td><input type='input' size='4' name='amountD[]' class='form-control input-sm text-right' placeholder='0.00' id='amountD' value="+results[i].amountD+"> </td>\
                        <td><input type='input' size='4' name='perD[]'  class='form-control input-sm text-right ' placeholder='0.00' id='perD' value="+results[i].perD+"></td>\
                        <td class='text-center chkbx'><input type='checkbox' name='disc_active[]' id='disc_active' value="+results[i].item_id+"></td>\
                        <td><input type='input' size='4' name='setSRP[]'  class='form-control input-sm text-right setSRP' placeholder='0.00' id='setSRP' value="+results[i].setSRP+" readonly></td>\
                        <td class='text-center'><a class='btn btn-xs btn-danger' id='delete_line'><i class='fa fa-minus'></i>\
                    </td></tr>");
                    
                    if(results[i].disc_active == 1){
                        
                         $(".chkbx input[value='"+results[i].item_id+"']").attr('checked','checked');

                    }
                } 
                
               
            }                
        });
    });
      
  

 
</script>

@endsection














