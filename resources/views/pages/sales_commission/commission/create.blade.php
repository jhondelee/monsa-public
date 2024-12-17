        
@extends('layouts.app')

@section('pageTitle','Sales Commission')

@section('content')


  <div class="row wrapper border-bottom white-bg page-heading">

            <div class="col-lg-10">

            <h2>Sales Commission</h2>

                <ol class="breadcrumb">
                    <li>

                        Home

                    </li>

                    <li class="active">

                        <strong>Commission</strong>

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
                            <h5>Agent Commission</h5>

                           
                        </div>
                        
                        <div class="ibox-content">
                            
                            <div class="form-horizontal m-t-md">

                            {!! Form::open(array('route' => array('commission.store','method'=>'POST'),'id'=>'commission_form')) !!}
                                   
                                @include('pages.sales_commission.commission._form')
                                     
                            {!! Form::close() !!} 

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>     


@endsection

@section('styles')
<link href="/css/plugins/footable/footable.core.css" rel="stylesheet">
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@endsection

@section('scripts')

<script src="/js/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">

        $(document).ready(function(){
            $('#btn-generate').on('click', function(){
                var _agentID = $('.employee_id').val();
                var _startDate = $('.from_date').val();
                var _endDate = $('.to_date').val();

                if ( !_agentID ) {

                    toastr.warning('Please select Agent Name','Warning')
                    return false;
                }

                if ( !_startDate ) {

                    toastr.warning('Please select Start Date','Warning')
                     return false;
                }

                if ( !_endDate ) {

                    toastr.warning('Please select End Date','Warning')
                     return false;
                }       

                //$('#dTable-selected-item-table').DataTable().empty();

                $.ajax({
                    url:  '{{ url('agent-commission/generate') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: { _token: "{{ csrf_token() }}",
                    id: _agentID, sdate: _startDate, edate: _endDate},  
                    success:function(results){      
                         
                        $('#dTable-selected-item-table').DataTable({
                            paging: false,
                            searching: false,
                            destroy: true,
                            data: results,
                            dom: '<"html5buttons"B>lTfgitp',
                            buttons: [],
                            columns: [
                                    {data: 'so_number', name: 'so_number'},
                                    {data: 'so_date', name: 'so_date'},
                                    {data: 'so_status', name: 'so_status'},
                                    {data: 'sub_agent', name: 'sub_agent'},
                                    {data: 'rate', name: 'rate'},
                                    {data: 'amount_com', name: 'amount_com',
                                        render: function(data, type, row){
                                            return '<h5 class="text-right">'+parseFloat(row.amount_com).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') +'<input type="hidden" name="amount_com[]" class="form-control input-sm text-right amount_com" id="amount_com" value='+row.amount_com+'></h5>'
                                        }
                                    },
                                    {data: 'total_sales', name: 'total_sales',
                                        render: function(data, type, row){
                                            return '<h4 class="text-right">'+parseFloat(row.total_sales).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') +'<input type="hidden" name="total_amount[]" class="form-control input-sm text-right total_amount" id="total_amount" value='+row.total_sales+'></h4>'
                                        }
                                    },
                                ],
                            });               
                        
                            var _total_amount = 0;
                            var _total_com = 0;

                            $( "#dTable-selected-item-table tbody > tr" ).each( function() {
                                var $row = $( this );        
                                var _subtotal = $row.find( ".total_amount" ).val();
                                var _subcom = $row.find( ".amount_com" ).val();
                            
                                _total_amount += parseFloat( ('0' + _subtotal).replace(/[^0-9-\.]/g, ''), 10 );
                                _total_com += parseFloat( ('0' + _subcom).replace(/[^0-9-\.]/g, ''), 10 );

                            });

                            $('#total_sales_amount').val( _total_amount );

                            _total_amount = _total_amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');

                            $('#total_sales').val(  _total_amount  ); 

                            $('#total_commission').val( _total_com );

                    }
                })            
            });

        });
      
        $(document).ready(function(){
            $('#btn-close').on('click', function(){
                document.location.href="/agent-commission"; 
            });
        });
        
        
        /* var _total_amount = 0;
                        var _ctr = 0;

                        for( var i = 0 ; i <= results.length ; i++ ) {

                                $('#dTable-selected-item-table tbody').append("<tr>\
                                    <td class='text-center'>"+results[i].so_number+"</td>\
                                    <td class='text-center'>"+results[i].so_date+"</td>\
                                    <td class='text-center'>"+results[i].status+"</td>\
                                    <td class='text-center'>"+results[i].sub_agent+"</td>\
                                    <td class='text-center'><input type='text' name='total_sales[]' class='form-control input-sm text-right total_sales' size='4'   id='total_sales' value='"+results[i].total_sales+"'></td></tr>");
                                
                                _ctr = _ctr + 1;
                        }  

                        if ( _ctr = 0 )
                        {
                            toastr.warning('No records will be generated on the selected date','Warning')
                        }  
        */

</script>

@endsection
