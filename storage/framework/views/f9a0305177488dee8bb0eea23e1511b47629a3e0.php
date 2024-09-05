
    <?php if(!can('inventory.create')): ?>
        <a href="#" class="btn btn-warning btn-sm add-inventory-item">
        <i class="fa fa-plus">&nbsp;</i>Inventory</a>
    <?php endif; ?>   
     <a href="<?php echo e(route('inventory.print')); ?>" class="btn btn-info btn-sm print-inventory-item">
        <i class="fa fa-print">&nbsp;</i>Print Warehouse</a>
         <a href="<?php echo e(route('inventory.print-inventory')); ?>" class="btn btn-info btn-sm print-inventory-item">
        <i class="fa fa-print">&nbsp;</i>Print Inventory</a>
    <div class="hr-line-dashed"></div>
    <table class="table table-striped table-hover dataTables-items">
        <thead>
            <tr>

                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Units</th>
                <th>On Hand</th>
                <th>SRP</th>
                <th>Location</th>
                <th>Status</th>
                <th class="text-center">Action</th>  

            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>           
                    <td><?php echo e($inventory->id); ?></td>
                    <td>
                        <?php if($inventory->picture!=""): ?>
                            <img class="img-thumbnail img-responsive text-center"  width="56" height="56" src="/item_image/<?php echo $inventory->picture; ?>"/>
                        <?php else: ?>
                            <img class="img-thumbnail img-responsive text-center"  width="56" height="56" alt="image" src="<?php echo asset('item_image/image_default.png'); ?>">
                        <?php endif; ?>
                        <?php echo e($inventory->name); ?>

                    </td>
                    <td><?php echo e($inventory->description); ?></td>
                    <td><?php echo e($inventory->units); ?></td>
                    <td><?php echo e($inventory->onhand_quantity); ?></td>
                    <td><?php echo e($inventory->srp); ?></td>
                    <td><?php echo e($inventory->location); ?></td>
                    <td><label class="label label-warning" ><?php echo e($inventory->status); ?></label></td>
                    <td class="text-center">
                            <div class="btn-group">
                                <a href="<?php echo e(route('inventory.show',$inventory->item_id)); ?>" class="btn-primary btn btn-xs"><i class="fa fa-eye"></i></a>
                            </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                           
        </tbody>
    </table>



<?php /**PATH C:\laravel\public_html\resources\views/pages/warehouse/inventory/inventory_list.blade.php ENDPATH**/ ?>