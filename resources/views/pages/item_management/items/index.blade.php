@extends('layouts.app')

@section('pageTitle','Item')

@section('content')


        <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2></h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="{{route('main')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Items</strong>
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
                                <h5>Item List</h5>
          
                                 @if (!can('item.create'))
                                <div class="ibox-tools"> 
                                    <a href="{{route('item.create')}}" class="btn btn-primary btn-sm add-modal">
                                        <i class="fa fa-plus">&nbsp;</i>Item
                                    </a> 
                                </div>
                                @endif  

                            </div>

                            <div class="ibox-content">
                              
                                <div class="table-responsive">
                                    
                                    <table class="table table-striped table-hover dataTables-items"data-toggle="dataTable" data-form="deleteForm" >
                                        <thead>
                                        <tr>

                                            
                                            <th>Id</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>UOM</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($items as $item)

                                                <tr>

                                                    
                                                    <td>{{$item->id}}</td>
                                                    <td>{{$item->code}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->description}}</td>
                                                    <td>{{$item->units}}</td>
                                                    <td class="text-center">
                                                        @IF($item->activated == 1)
                                                            <label class="label label-success" >Active</label> 
                                                        @ELSE
                                                            <label class="label label-warning" >Inctive</label> 
                                                        @ENDIF
                                                    </td>
                                                    <td class="text-center">
                                                        @if (!can('item.edit'))
                                                        <div class="btn-group">
                                                            <a class="btn-danger btn btn-xs edit-modal" 
                                                            data-id="{{$item->id}}"
                                                            data-descript="{{$item->description}}"
                                                            data-srp="{{$item->srp}}"
                                                            data-unit_cost="{{$item->unit_cost}}">
                                                            <i class="fa fa-money"></i></a>
                                                        </div>

                                                        <div class="btn-group">
                                                            <a href="{{route('item.edit',$item->id)}}" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                         
                           
                                                        @endif
                                                        @if (!can('item.delete'))
                                                        <div class="btn-group">
                                                          <a class="btn-primary btn btn-xs delete" onclick="confirmDelete('{{$item->id}}'); return false;"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                        @endif
                                                    </td>

                                                </tr>

                                            @endforeach
                                                                               
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            
          @include('pages.item_management.items.price')

@endsection


@section('scripts')

<script src="/js/plugins/footable/footable.all.min.js"></script>

<script type="text/javascript">
    


        $(document).ready(function(){
              $('.dataTables-items').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    //{ extend: 'copy'},
                    //{extend: 'csv'},
                    //{extend: 'excel', title: 'Item List'},
                    {extend: 'pdf', title: 'Item'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

        function confirmDelete(data,model) {   
         $('#confirmDelete').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $(this).attr("disabled","disabled");
                document.location.href="/item/delete/"+data;
            });
        }


        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add Area');
            $('#myModal').modal('show');
        });

        // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Update Cost/Srp');
            $('#id_edit').val($(this).data('id'));
            $('#descript_edit').val($(this).data('descript'));
            $('#srp_edit').val($(this).data('srp'));
            $('#unit_cost_edit').val($(this).data('unit_cost'));
            $('#editModal').modal('show');
        });

           
    
    
</script>

@endsection