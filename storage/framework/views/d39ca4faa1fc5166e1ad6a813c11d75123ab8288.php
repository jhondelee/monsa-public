<?php $__env->startSection('pageTitle','Suppliers'); ?>

<?php $__env->startSection('content'); ?>


        <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2></h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo e(route('main')); ?>">Home</a>
                        </li>
                        <li class="active">
                            <strong>Supplier</strong>
                        </li>
                       
                    </ol>

                </div>

        </div>

       <?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <?php echo $__env->make('layouts.deletemodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Supplier List</h5>
          
                                 <?php if(!can('supplier.create')): ?>
                                <div class="ibox-tools"> 
                                    <a href="<?php echo e(route('supplier.create')); ?>" class="btn btn-primary btn-sm add-modal">
                                        <i class="fa fa-plus">&nbsp;</i>Supplier
                                    </a> 
                                </div>
                                <?php endif; ?>  

                            </div>

                            <div class="ibox-content">
                              
                                <div class="table-responsive">
                                    
                                    <table class="table table-striped table-hover dataTables-items"data-toggle="dataTable" data-form="deleteForm" >
                                        <thead>
                                        <tr>

                                            
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Created_by</th>
                                            <th class="text-center">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>

                                                    
                                                    <td><?php echo e($supplier->id); ?></td>
                                                    <td><?php echo e($supplier->name); ?></td>
                                                    <td><?php echo e($supplier->address); ?></td>
                                                    <td><?php echo e($supplier->created_by); ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group tooltip-demo">
                                                            <a href="<?php echo e(route('supplier.items',$supplier->id)); ?>" class="btn-info btn btn-xs" data-toggle="tooltip" data-placement="left" title="Items"><i class="fa fa-th-list"></i></a>
                                                        </div>
                                                        <?php if(!can('supplier.edit')): ?>
                                                        <div class="btn-group">
                                                            <a href="<?php echo e(route('supplier.edit',$supplier->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if(!can('supplier.delete')): ?>
                                                        <div class="btn-group">
                                                          <a class="btn-primary btn btn-xs delete" onclick="confirmDelete('<?php echo e($supplier->id); ?>'); return false;"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                        <?php endif; ?>
                                                    </td>

                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                               
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            
          
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script src="/js/plugins/footable/footable.all.min.js"></script>

<script type="text/javascript">
    


        $(document).ready(function(){
              $('.dataTables-items').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    //{ extend: 'copy'},
                    //{extend: 'csv'},
                    //{extend: 'excel', title: 'Suppier List'},
                    {extend: 'pdf', title: 'Suppliers'},

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
                document.location.href="/supplier/delete/"+data;
            });
        }


  
        
        
        
  
      
           
    
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/item_management/suppliers/index.blade.php ENDPATH**/ ?>