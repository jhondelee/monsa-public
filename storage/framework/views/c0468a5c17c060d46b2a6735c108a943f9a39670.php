  

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
  
           <?php $__currentLoopData = $posted_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posted): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($posted->id); ?></td>
                    <td><?php echo e($posted->po_number); ?></td>
                    <td><?php echo e(date('d-M-y', strtotime($posted->po_date))); ?></td>
                    <td><?php echo e($posted->supplier); ?></td>
                    <td class="text-right"><?php echo e(number_format($posted->grand_total,2)); ?></td>
                    <td class="text-center">
                        <label class="label label-warning" ><?php echo e($posted->status); ?></label> 
                    </td>
          
                    <td class="text-center">

                        <div class="btn-group">
                            <a href="<?php echo e(route ('order.edit', $posted->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-eye"></i></a>
                        </div>


                    </td>

                </tr>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                           
        </tbody>
</table> 



<?php /**PATH C:\laravel\public_html\resources\views/pages/purchase_order/orders/posted_list.blade.php ENDPATH**/ ?>