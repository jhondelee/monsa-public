  

 <table class="table table-striped table-bordered dataTables-po">
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
  
           <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_open): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    
                    <td><?php echo e($order_open->id); ?></td>
                    <td><?php echo e($order_open->po_number); ?></td>
                    <td><?php echo e(date('m-d-y', strtotime($order_open->po_date))); ?></td>
                    <td><?php echo e($order_open->supplier); ?></td>
                    <td class="text-right"><?php echo e(number_format($order_open->grand_total,2)); ?></td>
                    <td class="text-center">
                        <?php if($order_open->status == 'NEW'): ?>
                            <label class="label label-info" >NEW</label> 
                        <?php else: ?>
                            <?php echo e($order_open->status); ?>

                        <?php endif; ?>
                    </td>
                    <td class="text-center">

                    <?php if(!can('order.edit')): ?>
                        <div class="btn-group">
                            <a href="<?php echo e(route ('order.edit', $order_open->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                        </div>
                    <?php endif; ?>

                    <?php if(!can('order.cancel')): ?>
                        <div class="btn-group">
                            <a class="btn-primary btn btn-xs delete" onclick="confirmCancel('<?php echo e($order_open->id); ?>'); return false;"><i class="fa fa-ban"></i></a>
                        </div>
                    <?php endif; ?>
                    </td>

                </tr>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                           
        </tbody>
</table> 



<?php /**PATH C:\laravel\public_html\resources\views/pages/purchase_order/orders/po_list.blade.php ENDPATH**/ ?>