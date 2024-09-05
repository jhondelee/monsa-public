

<a href="/transfer/add" class="btn btn-warning">
<i class="fa fa-exchange">&nbsp;</i>Create Transfer Order</a>

<div class="hr-line-dashed"></div>
<table class="table table-striped table-hover dataTables-trasfer" >
    <thead>
        <tr>
            <th>Reference No.</th>
            <th>Source Loc.</th>
            <th>Destination Loc.</th>
            <th>Creator</th>
            <th>Date Transfer</th>
            <th>Status</th>
            <th class="text-center">Action</th>   
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $transferLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transferList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>           
                <td><?php echo e($transferList->reference_no); ?></td>
                <td><?php echo e($transferList->source); ?></td>
                <td><?php echo e($transferList->destination); ?></td>
                <td><?php echo e($transferList->created_by); ?></td>
                <td><?php echo e(date('m-d-Y', strtotime($transferList->transfer_date))); ?></td>
                <td>
                    <?php if($transferList->status == 'CREATED'): ?>
                        <label class="label label-info" >Pending</label> 
                    <?php else: ?>
                        <label class="label label-danger" >Posted</label> 
                    <?php endif; ?>
                </td>
                
                <td class="text-center">
                    <?php if(!can('transfer.edit')): ?>
                        <div class="btn-group">
                            <a href="<?php echo e(route('transfer.edit',$transferList->id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-pencil"></i></a>
                        </div>
                    <?php endif; ?>
                    <?php if($trasferList->status != 'POSTED'): ?>
                        <?php if(!can('transfer.delete')): ?>
                             <div class="btn-group">
                                <a class="btn-danger btn btn-xs" onclick="confirmDeleteOrder('<?php echo e($transferList       ->id); ?>'); return false;"><i class="fa fa-trash"></i></a>
                            </div>
                        <?php endif; ?>  
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                           
    </tbody>
</table>
<?php /**PATH C:\laravel\public_html\resources\views/pages/warehouse/inventory/transfer_list.blade.php ENDPATH**/ ?>