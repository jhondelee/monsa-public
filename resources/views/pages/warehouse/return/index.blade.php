@extends('layouts.app')

@section('pageTitle','Return')

@section('content')


	    <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Return Item</h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="{{route('main')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Return</strong>
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
                                <h5>Return Item List</h5>
                                 @if (!can('returns.create'))
                                <div class="ibox-tools">

                                    <a href="{{route('returns.create')}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search">&nbsp;</i>Search SO Number</a>
                                     
                                </div>
                                @endif

                            </div>

                            <div class="ibox-content">
                              
                                <div class="table-responsive">
                                    
                                    <table class="table table-bordered table-hover dataTables-return" id="dataTables-return">
                                        <thead>
                                        <tr>

                                            
                                            <th>Id</th>
                                            <th>Reference No.</th>
                                            <th>SO Number</th>
                                            <th>Return Date</th>
                                            <th>Customer</th>

                                            <th class="text-center">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($returns as $return)
                                                <tr>
                                                    <td>{{$return->id}}</td>
                                                    <td>{{$return->reference_no}}</td>
                                                    <td>{{$return->so_number}}</td>
                                                    <td>{{date('m-d-Y', strtotime($return->return_date))}}</td>
                                                    <td>{{$return->customer_name}}</td>

                                                    <td class="text-center">
                                                        @if (!can('returns.edit'))
                                                        <div class="btn-group">
                                                            <a href="{{route('returns.edit',$return->id)}}" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                        @endif
                                                        @if (!can('returns.delete'))
                                                            <div class="btn-group">
                                                              <a class="btn-primary btn btn-xs delete" onclick="confirmDelete('{{$return->id}}'); return false;"><i class="fa fa-trash"></i></a>
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

            
          
@endsection


@section('scripts')

<script type="text/javascript">
    


        $(document).ready(function(){
              $('.dataTables-return').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                order: [ [0, 'desc'] ],
                buttons: [
                    //{ extend: 'copy'},
                    //{extend: 'csv'},
                    //{extend: 'excel', title: 'Farm List'},
                    {extend: 'pdf', title: 'Procurement'},

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
                document.location.href="/returns/delete/"+data;
            });
        }

    
    
</script>

@endsection