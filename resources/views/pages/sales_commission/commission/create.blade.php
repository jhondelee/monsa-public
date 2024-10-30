    
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
                var _agentName = $('.employee_id').val();
                var _startDate = $('.start_date').val();
                var _endDate = $('.end_date').val();
           
            if ( !_agentName ) {

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


            });
        });
      
        $(document).ready(function(){
            $('#btn-close').on('click', function(){
                document.location.href="/agent-commission"; 
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
