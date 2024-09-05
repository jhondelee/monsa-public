<?php $__env->startSection('pageTitle','Incoming'); ?>

<?php $__env->startSection('content'); ?>


	    <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Incoming Item</h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo e(route('main')); ?>">Home</a>
                        </li>
                        <li class="active">
                            <strong>Incoming</strong>
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
                                <h5>Incoming List</h5>
                                 <?php if(!can('incoming.create')): ?>
                                <div class="ibox-tools">

                                    <a href="<?php echo e(route('incoming.create')); ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search">&nbsp;</i>Searc Purchase Order</a>
                                     
                                </div>
                                <?php endif; ?>

                            </div>

                            <div class="ibox-content">
                              
                                <div class="table-responsive">
                                    
                                    <table class="table table-bordered table-hover dataTables-incoming" id="dataTables-incoming">
                                        <thead>
                                        <tr>

                                            
                                            <th>PO Number</th>
                                            <th>DR Number</th>
                                            <th>DR Date</th>
                                            <th>Received By</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $incomings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incoming): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($incoming->po_number); ?></td>
                                                    <td><?php echo e($incoming->dr_number); ?></td>
                                                    <td><?php echo e(date('m-d-Y', strtotime($incoming->dr_date))); ?></td>
                                                 
                                                    
                                                    <td><?php echo e($incoming->received_by); ?></td>
                                                    <td>
                                                        <?php if($incoming->status == 'RECEIVING'): ?>
                                                            <label class="label label-success">RECEIVING</label>
                                                        <?php else: ?>
                                                            <label class="label label-danger">CLOSED</label>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if(!can('incoming.edit')): ?>
                                                        <div class="btn-group">
                                                            <a href="<?php echo e(route('incoming.edit',$incoming->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if(!can('incoming.delete')): ?>
                                                         <?php if($incoming->status == 'RECEIVING'): ?>
                                                            <div class="btn-group">
                                                              <a class="btn-primary btn btn-xs delete" onclick="confirmDelete('<?php echo e($incoming->id); ?>'); return false;"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                         <?php endif; ?>
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

<script type="text/javascript">
    


        $(document).ready(function(){
              $('.dataTables-incoming').DataTable({
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
                document.location.href="/incoming/delete/"+data;
            });
        }

    
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/purchase_order/incoming/index.blade.php ENDPATH**/ ?>