@extends('layouts.app')

@section('pageTitle','Inventory')

@section('content')


      <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Consumable Inventory</h2>
                    <ol class="breadcrumb">
                        <li class="active">
                             <a href="{{ route('main') }}">Home</a>
                        </li>
                        <li>
                            <strong><a href="#">Consumable Inventory</a></strong>
                        </li>
                    
                    </ol>
                </div>
        </div>

        @include('layouts.alert')
        @include('layouts.deletemodal')    

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content" >                       

                                <div class="row m-t-lg">
                                    <div class="col-lg-12">
                                        <div class="tabs-container">
                                            <ul class="nav nav-tabs">

                                                @if (!can('consumables.index'))
                                                <li class="active">
                                                    <a data-toggle="tab" href="#tab-1">
                                                    <i class="fa fa-briefcase">&nbsp;</i>Inventory
                                                    </a>
                                                </li>
                                                @endif

                                                <li>
                                                    <a data-toggle="tab" href="#tab-2">
                                                    <i class="fa fa-send">&nbsp;</i>Item Request List
                                                    </a>
                                                </li>


                                            </ul>
                                            <div class="tab-content">
                                                    <div id="tab-1" class="tab-pane active">
                                                        <div class="panel-body">
                                                           <div class="table-responsive" >
                                                            
                                                        @include('pages.warehouse.consumables.consumable_list') 
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
       
                                                <div id="tab-2" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="table-responsive" >

                                                        @include('pages.warehouse.consumables.item_request.request_list') 
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('pages.warehouse.consumables.add_item') 
@include('pages.warehouse.consumables.item_request.add_request')    
          
@endsection

@section('styles')
<link href="/css/plugins/footable/footable.core.css" rel="stylesheet">
@endsection


@section('scripts')
<script src="/js/plugins/footable/footable.all.min.js"></script>
<script type="text/javascript">

        $(document).ready(function(){
              $('.dataTables-consumable-items').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
            });
        });


        $(document).on('click', '.add-consumable-item', function() {
           $('.modal-title').text('Add Consumable Item');
           $('#myModal').modal('show');
        }); 

        $(document).on('click', '#add-ticket-request', function() {
           $('.modal-title').text('Add Request Item');
            $('#inven_id').val($(this).data('id'));
            $('#item_name').val($(this).data('name'));
            $('#item_units').val($(this).data('units'));
           $('#myModalrequest').modal('show');
        }); 
      

        function confirmDelete(data,model) {   
         $('#confirmDelete').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $(this).attr("disabled","disabled");
                document.location.href="/consumable/delete/"+data;
            });
        }


     function confirmPost(data,model) {   

                document.location.href="/consumable/deduct/"+data;
    
        }


   



</script>

@endsection