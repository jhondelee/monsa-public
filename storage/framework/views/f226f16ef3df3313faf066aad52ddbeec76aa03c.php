  

 <table class="table table-striped table-bordered dataTables-po" data-toggle="dataTable" data-form="deleteForm" >
    <thead>
        <tr>
            <th>ID</th>
            <th>PO #</th>
            <th>PO Date</th>
            <th>Supplier</th>
            <th>Total Amount</th>   
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>                                                   
        </tr>
    </thead>
        <tbody>
  
           <?php $__currentLoopData = $cancel_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cancel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($cancel->id); ?></td>
                    <td><?php echo e($cancel->po_number); ?></td>
                    <td><?php echo e(date('d-M-y', strtotime($cancel->po_date))); ?></td>
                    <td><?php echo e($cancel->supplier); ?></td>
                    <td class="text-right"><?php echo e(number_format($cancel->grand_total,2)); ?></td>

                    <td class="text-center">
                        <label class="label label-danger" ><?php echo e($cancel->status); ?></label> 
                    </td>
                    
                    <td class="text-center">

                    <?php if(!can('order.edit')): ?>
                        <div class="btn-group">
                            <a href="<?php echo e(route ('order.edit', $cancel->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-eye"></i></a>
                        </div>
                    <?php endif; ?>


                    <?php if(!can('order.delete')): ?>
                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs delete" onclick="confirmDelete('<?php echo e($cancel->id); ?>'); return false;" id="delete-btn"><i class="fa fa-trash"></i></a>
                        </div>
                    <?php endif; ?>


                    </td>

                </tr>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                           
        </tbody>
</table> 



<?php /**PATH C:\laravel\public_html\resources\views/pages/purchase_order/orders/cancel_list.blade.php ENDPATH**/ ?>