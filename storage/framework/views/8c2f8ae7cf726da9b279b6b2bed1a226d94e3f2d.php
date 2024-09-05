<?php $__env->startSection('pageTitle','Item'); ?>

<?php $__env->startSection('content'); ?>


        <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2></h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo e(route('main')); ?>">Home</a>
                        </li>
                        <li class="active">
                            <strong>Items</strong>
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
                                <h5>Item List</h5>
          
                                 <?php if(!can('item.create')): ?>
                                <div class="ibox-tools"> 
                                    <a href="<?php echo e(route('item.create')); ?>" class="btn btn-primary btn-sm add-modal">
                                        <i class="fa fa-plus">&nbsp;</i>Item
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
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>UOM</th>
                                            <th class="text-center">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>

                                                    
                                                    <td><?php echo e($item->id); ?></td>
                                                    <td><?php echo e($item->code); ?></td>
                                                    <td><?php echo e($item->name); ?></td>
                                                    <td><?php echo e($item->description); ?></td>
                                                    <td><?php echo e($item->units); ?></td>
                                                    <td class="text-center">
                                                        <?php if(!can('item.edit')): ?>
                                                        <div class="btn-group">
                                                            <a href="<?php echo e(route('item.edit',$item->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if(!can('item.delete')): ?>
                                                        <div class="btn-group">
                                                          <a class="btn-primary btn btn-xs delete" onclick="confirmDelete('<?php echo e($item->id); ?>'); return false;"><i class="fa fa-trash"></i></a>
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

           
    
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/item_management/items/index.blade.php ENDPATH**/ ?>