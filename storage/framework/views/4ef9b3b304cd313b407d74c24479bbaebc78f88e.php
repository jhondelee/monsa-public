  

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
  
           <?php $__currentLoopData = $closed_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $closed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($closed->id); ?></td>
                    <td><?php echo e($closed->po_number); ?></td>
                    <td><?php echo e(date('m-d-y', strtotime($closed->po_date))); ?></td>
                    <td><?php echo e($closed->supplier); ?></td>
                    <td class="text-right"><?php echo e(number_format($closed->grand_total,2)); ?></td>
                    <td class="text-center"><?php echo e($closed->status); ?></td>
                    <td class="text-center">

                        <div class="btn-group">
                            <a href="<?php echo e(route ('purchase_order.edit', $closed->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-eye"></i></a>
                        </div>


                    </td>

                </tr>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                           
        </tbody>
</table> 



<?php /**PATH C:\laravel\public_html\resources\views/pages/purchase_order/orders/closed_list.blade.php ENDPATH**/ ?>