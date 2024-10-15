    
@extends('layouts.app')

@section('pageTitle','Sales Order')

@section('content')


  <div class="row wrapper border-bottom white-bg page-heading">

            <div class="col-lg-10">

            <h2>Sales Order</h2>

                <ol class="breadcrumb">
                    <li>

                        Home

                    </li>

                    <li class="active">

                        <strong>Sales</strong>

                    </li>
                                      
                </ol>

            </div>

        </div>
       @include('layouts.alert')
       @include('layouts.deletemodal')

        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Order</h5>                            
                           
                        </div>
             
                        <div class="ibox-content">
                            
                            @if (!can('salesorder.post'))

                                @if ($salesorder->status == 'NEW')
                                           
                                <div class="btn-group">
                                     <button type="button" class="btn btn-success" onclick="confirmPost('{{$salesorder->id}}'); return false;" id="post-btn"><i class="fa fa-check">&nbsp;</i>Post&nbsp; </button>
                                </div>

                                @endif


                            @endif
                                     <a href="{{route('salesorder.print',$salesorder->id)}}" class="btn btn-primary btn-print"><i class="fa fa-print">&nbsp;</i>Print</a> 

                            <div class="form-horizontal m-t-md">
                 
                           
                            {!! Form::model($salesorder, ['route' => ['salesorder.update', $salesorder->id],'id'=>'salesorder_form']) !!}
                                   
                                @include('pages.salesorder._form_add')

                            {!! Form::hidden('salesorder_id',$salesorder->id, ['class'=>'form-control id','id'=>'salesorder_id']) !!}
                            
                            {!! Form::close() !!} 

                    
                

                            </div>
                    </div>
                </div>
            </div>
        </div>     

        @include('pages.salesorder.add_item')


@endsection



@section('scripts')

<script src="/js/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">

        $('#customer_id').on('change', function (e) {

            var id = this.value;
         
            $('#dTable-selected-item-table').datatable().destroy()
           
        });

       
        $(document).on('click', '.btn-show-item', function() {
            var _id = $('#location').val();
            var _cs = $('#customer_id').val();

            if ( !_cs ){

                toastr.warning('Please select Customer','Warning')
                 return false;

            } 

            if ( !_id ){

                  toastr.warning('Please select Source Location','Warning')
                 return false;

            } else {

                    $('.modal-title').text('Add Item');
                    $('#myModal').modal('show'); 

                $(function() {
                    $.ajax({
                        url:  '{{ url('sales/additem') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: { _token: "{{ csrf_token() }}",
                        id: _id}, 
                        success:function(results){

       

                            $('#dTable-ItemList-table').DataTable({
                                destroy: true,
                                pageLength: 100,
                                responsive: true,
                                fixedColumns: true,
                                data: results,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [],
                                columns: [
                                    {data: 'id', title: 'id',
                                        render: function(data,type,row){
                                        return '<input type="text" name="item_id[]" class="form-control input-sm text-center item_id" size="3"  readonly="true" id ="item_id" value="'+ row.id +'">';
                                        }
                                    },    
                                    {data: 'description', title: 'Item Description'},                               
                                    {data: 'untis', title: 'Units'},
                                    {data: 'srp', title: 'SRP'},
                                    {data: 'unit_quantity', title: 'Qty',
                                        render: function(data, type, row){
                                            return '<input type="input" size="4" name="setQty[]"  class="form-control input-sm text-right setQty" placeholder="0.00" id="setQty"><input type="hidden"  name="unitQty[]" id="unitQty" value="'+ row.unit_quantity +'">';
                                        }
                                    },
                                    {data: 'status', title: 'Status',
                                        render: function(data, type, row){
                                            if(row.status=='In Stock'){
                                                return '<label class="label label-warning" >In Stock</label>  '
                                            }else{
                                                return '<label class="label label-danger" >Out of Stock</label>';
                                            }   
                                        }
                                    },
                                    {data: 'id', title: 'Action',
                                        render: function(data,type,row) {
                                             return '<a class="btn-primary btn btn-xs text-right btn-add-items" onclick="confirmAddItem('+ row.id +'); return false;"><i class="fa fa-plus"></i></a>';
                                        }
                                    }
                                    ]
                            });
                        }
                    });
                });
            }

        });

          
//

 
        $('.chosen-select').chosen({width: "100%"});


        $('#dTable-ItemList-table tbody').on('click','.btn-add-items',function(event){
            var _setQty =  parseFloat($(this).closest( 'tr' ).find( '#setQty' ).val());
            var _unitQty =  parseFloat($(this).closest( 'tr' ).find( '#unitQty' ).val());
            var _itemID =  parseFloat($(this).closest( 'tr' ).find( '#item_id' ).val());
            var _total_amount = 0.00;
            var _total_dis_amount = 0.00;
            var _total_dis_percent = 0.00;

            if ( isNaN( _setQty) || !_setQty ){

                 toastr.warning('Item quantity is 0','Warning');
                 return false;
            } 

            if ( _setQty > _unitQty ){

                toastr.warning('Not enough stocks','Warning');
                return false;

            } else {
                
                var _id = _itemID;
                var _cs = $('#customer_id').val();
            //
                $.ajax({
                url:  '{{ url('sales/getcustomeritems') }}',
                type: 'POST',
                dataType: 'json',
                data: { _token: "{{ csrf_token() }}",
                id: _id, cs: _cs}, 
                success:function(results){

                            var _Gamount = _setQty * parseFloat( results.csPrice.set_srp );
                //
                          $('#dTable-selected-item-table tbody').append("<tr><td><input type='text' name='invenId[]' class='form-control input-sm text-center invenId' size='3'  value="+ results.invenId.id +" readonly></td>\
                            <td>"+ results.csPrice.description +"</td>\
                            <td>"+'('+ results.invenId.unit_quantity +') '+results.csPrice.units+"</td><td><input type='text' name='setQty[]' class='form-control input-sm text-center setQty' size='3'  value="+ _setQty.toFixed(2) +" readonly></td><td><input type='text' name='setPrice[]' class='form-control input-sm text-center setPrice' size='6'  id='setPrice' value="+results.csPrice.srp +" readonly></td><td><input type='text' name='dis_amount[]' class='form-control input-sm text-center dis_amount' size='6'  id='dis_amount' value="+results.csPrice.dis_amount+" readonly></td><td><input type='text' name='dis_percent[]' class='form-control input-sm text-center dis_percent' size='3'  id='dis_percent' value="+results.csPrice.dis_percent+" readonly></td><td><input type='text' name='setSRP[]' class='form-control input-sm text-center setSRP' size='6'  id='setSRP' value="+results.csPrice.set_srp+" readonly></td><td><b><input type='text' name='gAmount[]' class='form-control input-sm text-right gAmount' size='6'  id='gAmount' value="+_Gamount.toFixed(2)+" readonly></b></td>\
                            <td class='text-center'><a class='btn btn-xs btn-danger' id='delete_line'><i class='fa fa-minus'></i></td>\
                              </tr>");

                        toastr.info(results.csPrice.description  +' has been added','Success!')


                        $( "#dTable-selected-item-table tbody > tr" ).each( function() {
                                var $row = $( this );        
                                var _subtotal = $row.find( ".gAmount" ).val();
                                var _dis_amount = $row.find( ".dis_amount" ).val();
                                var _dis_percent = $row.find( ".dis_percent" ).val();
            
                        _total_amount += parseFloat( ('0' + _subtotal).replace(/[^0-9-\.]/g, ''), 10 );
                        
                         _total_dis_amount += parseFloat( ('0' + _dis_amount).replace(/[^0-9-\.]/g, ''), 10 );
                           
                        _total_dis_percent += parseFloat( ('0' + _dis_percent).replace(/[^0-9-\.]/g, ''), 10 );

                        });

                         _total_amount = _total_amount.toFixed(2);
                        $('#total_sales').val(  _total_amount  );

                         _total_dis_amount = _total_dis_amount.toFixed(2);
                        $('#total_amount_discount').val(  _total_dis_amount  );

                         _total_dis_percent = _total_dis_percent.toFixed(2);
                        $('#total_percent_discount').val(  _total_dis_percent  );
                    }
                });
            }   
         });


       $('#dTable-selected-item-table').on('click', '#delete_line', function(){

            $(this).closest('tr').remove();  
                
                var _total_amount = 0;
                var _total_dis_amount = 0;
                var _total_dis_percent = 0;
                    
                     $( "#dTable-selected-item-table tbody > tr" ).each( function() {
                            var $row = $( this );        
                            var _subtotal = $row.find( ".gAmount" ).val();
                            var _dis_amount = $row.find( ".dis_amount" ).val();
                            var _dis_percent = $row.find( ".dis_percent" ).val();
                    
                        _total_amount += parseFloat( ('0' + _subtotal).replace(/[^0-9-\.]/g, ''), 10 );
                            
                        _total_dis_amount += parseFloat( ('0' + _dis_amount).replace(/[^0-9-\.]/g, ''), 10 );
                           
                        _total_dis_percent += parseFloat( ('0' + _dis_percent).replace(/[^0-9-\.]/g, ''), 10 ); 
                    });

                _total_amount = _total_amount.toFixed(2);
                $('#total_sales').val(  _total_amount  );

                _total_dis_amount = _total_dis_amount.toFixed(2);
                $('#discount_amount').val(  _total_dis_amount  );

                _total_dis_percent = _total_dis_percent.toFixed(2);
                $('#discount_percentage').val(  _total_dis_percent  );

        });

        
        $("#remove-row").click(function(){
            $("table tbody").find('input[name="remove"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });

         $(".btn-remove").click(function(){
            $("table tbody").find('input[name="remove"]').each(function(){
                if($(this).is(":checked")){
                    
                    $(this).parents("tr").remove();

                    }
            });
        });


        $('.date').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd'
         });

        $(".btn-remove").click(function(){

            $("table tbody").find('input[name="remove"]').each(function(){

                var _total_amount = 0.00;
                $( "#dTable-selected-item-table tbody > tr" ).each( function() {
                    var $row = $( this );        
                    var _subtotal = $row.find( ".item_unit_total_cost" ).val();
    
                    _total_amount += parseFloat( ('0' + _subtotal).replace(/[^0-9-\.]/g, ''), 10 );     
                });
                    _total_amount = _total_amount.toFixed(2);
                    $('input[name="grand_total"]').val(  _total_amount  );
                });

        });
 
        $('.chosen-select').chosen({width: "100%"});

        
        function confirmPost(data,model) {   
         $('#confirmPost').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#post-btn', function(){
                $(this).attr("disabled","disabled");
                document.location.href="/salesorder/post/"+data;
            });
        }

        function confirmAddItem(data) {   
            var id = data;
            $.ajax({
            url:  '{{ url('salesorder/getitems') }}',
            type: 'POST',
            dataType: 'json',
            data: { _token: "{{ csrf_token() }}",
            id: id}, 
            success:function(results){
                                               
                $('#dTable-selected-item-table tbody').append("<tr><td><input type='text' name='id[]' class='form-control input-sm text-center id' required=true size='4'  value="+ results.id +" readonly></td>\
                        <td>"+ results.description +"</td>\
                        <td>"+ results.units +"</td>\
                        <td>\
                        <input type='text' name='quantity[]' class='form-control input-sm text-center item_quantity' required=true size='4'  placeholder='0.00'  id ='item_quantity'>\
                        </td>\
                        <td style='text-align:center;'>\
                            <div class='checkbox checkbox-success'>\
                                <input type='checkbox' name='remove'><label for='remove'></label>\
                            </div>\
                        </td>\
                    </tr>"); 

                    toastr.success(results.description +' has been added','Success!')
                }
            })
        }


        $(document).ready(function(){
            $('#btn-close').on('click', function(){
                document.location.href="/order"; 
            });
        });

        function submit_validate() {
            var ctr = $('#dTable-selected-item-table>tbody>tr').length;
            if (ctr > 0){
                $('#orders_form').submit();
            }else{
                toastr.warning('No Items to be save!','Invalid!')
            }
         }


</script>

@endsection
