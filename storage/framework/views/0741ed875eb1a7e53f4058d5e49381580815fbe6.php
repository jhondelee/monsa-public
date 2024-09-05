<?php $__env->startSection('pageTitle','Ending'); ?>

<?php $__env->startSection('content'); ?>


        <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Ending Inventory</h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo e(route('main')); ?>">Home</a>
                        </li>
                        <li class="active">
                            <strong>Ending Inventory</strong>
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
                                <h5>Ending Inventory List</h5>
                                 <?php if(!can('ending.create')): ?>
                                <div class="ibox-tools"> 
                                    <a href="<?php echo e(route('ending.create')); ?>" class="btn btn-primary btn-sm" id="add-product"><i class="fa fa-plus">&nbsp;</i>Create Ending Inventory</a> 
                                </div>
                                <?php endif; ?>

                            </div>

                            <div class="ibox-content">
                              
                                <div class="table-responsive">
                                
                                    <table class="table table-striped table-hover dataTables-ending-inventory">
                                        <thead>
                                            <tr>

                                                <th>ID</th>
                                                <th>Ending Date</th>
                                                <th>Created by</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>  

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $endings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($ending->id); ?></td>
                                                <td><?php echo e(date("M-d-Y",strtotime($ending->ending_date))); ?></td>
                                                <td><?php echo e($ending->prepared_by); ?></td>
                                                <td>
                                                    <?php if($ending->status == 'POSTED'): ?>
                                                        <label class="label label-xs label-success">Posted</label>
                                                    <?php else: ?>
                                                        <label class="label label-xs label-warning">Unpposted</label>
                                                    <?php endif; ?>                                                
                                                </td>
                                                 <td class="text-center">
                                                    <a href="<?php echo e(route('ending.edit',$ending->id)); ?>" class="btn btn-xs btn-white">
                                                    <i class="fa fa-pencil"></i></a>
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
              $('.dataTables-ending-inventory').DataTable({
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

          
     
                   
    
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/warehouse/ending/index.blade.php ENDPATH**/ ?>