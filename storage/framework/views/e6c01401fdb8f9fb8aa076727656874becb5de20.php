<?php $__env->startSection('pageTitle','Inventory'); ?>

<?php $__env->startSection('content'); ?>


	  <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Warehouse Inventory</h2>
                    <ol class="breadcrumb">
                        <li class="active">
                             <a href="<?php echo e(route('main')); ?>">Home</a>
                        </li>
                        <li>
                            <strong><a href="#">Inventory</a></strong>
                        </li>
                    
                    </ol>
                </div>
        </div>

        <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.deletemodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    

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

                                                <?php if(!can('inventory.index')): ?>
                                                <li class="active">
                                                    <a data-toggle="tab" href="#tab-1">
                                                    <i class="fa fa-briefcase">&nbsp;</i>Inventory
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(!can('transfer.index')): ?>
                                                <li>
                                                    <a data-toggle="tab" href="#tab-2">
                                                    <i class="fa fa-send">&nbsp;</i>Stock Transfer
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                            </ul>
                                            <div class="tab-content">
                                                    <div id="tab-1" class="tab-pane active">
                                                        <div class="panel-body">
                                                           <div class="table-responsive" >
                                                            
                                                            <?php echo $__env->make('pages.warehouse.inventory.inventory_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php if(!can('transfer.index')): ?>
                                                <div id="tab-2" class="tab-pane">
                                                    <div class="panel-body">
                                                        <div class="table-responsive" >

                                                            <?php echo $__env->make('pages.warehouse.inventory.transfer_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
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

<?php echo $__env->make('pages.warehouse.inventory.create.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          
<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>
<link href="/css/plugins/select2/select2.min.css" rel="stylesheet">
<script src="/js/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
        
        $(document).ready(function(){
              $('.dataTables-items').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
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

        $(document).ready(function(){
              $('.dataTables-trasfer').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
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
                document.location.href="/warehouse/deduct/"+data;
            });
        }



        function confirmDeleteOrder(data,model) {  
         $('#confirmDelete').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $(this).attr("disabled","disabled");
                document.location.href="/stock-transfer/delete/"+data;
            });
        }

        
        $(document).on('click', '.add-inventory-item', function() {
           $('.modal-title').text('Add Inventory Item');
           $('#myModal').modal('show');
        });   
        
        $('#inventory_item_id').change(function(){
            var id = $(this).val();
            var _item_name = $('#inventory_item_id option:selected').text();
      
                $.ajax({
                    url:  '<?php echo e(url('inventory/iteminfo')); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { _token: "<?php echo e(csrf_token()); ?>",
                    id: id}, 
                    success:function(results){

                        $('#unit_price').val(results.unit_cost);

                            toastr.info(results.description ,'Unit Cost')
                    }
                });
        })
        
        
        $(document).on('click', '.deduct-inventory-item', function() {
           $('.modal-title').text('Deduct Inventory Item');
           $('.source_deduct').val($(this).data('')).trigger("chosen:updated");
           $('.items_deduct').val($(this).data('')).trigger("chosen:updated");
           $('#deduct-Modal').modal('show');
        });  



                $('.chosen-select').chosen({width: "100%"});
                $('#source_deduct').change(function(){ 
                  var _source_deduct = $(this).val();
                  
                    $.ajax({
                        url:  '<?php echo e(url('inventory-deduct/source')); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: { _token: "<?php echo e(csrf_token()); ?>",
                        loc: _source_deduct}, 
                        success:function(results){
                          
                            $('div #item-option').empty();
                            $('div #item-option').append('<select name="items_deduct" id="items_deduct" class="form-control chosen-select"></select>');

                            $('#items_deduct').empty();
                            $("#items_deduct").append('<option>Please choose items</option>');
                            for(var i = 0 ; i <= results.length ; i++ ) {
                                $("#items_deduct").append('<option value='+results[i].id+'>'+results[i].name+'</option>');
                            }
                            $('#items_deduct').chosen();
                            $('.chosen-select').chosen({width: "100%"});
                        }
                    });
                    
                });

        
      
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/warehouse/inventory/index.blade.php ENDPATH**/ ?>