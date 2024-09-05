<?php if(Session::has('info') or Session::has('message')): ?>
    <div class="alert alert-<?php echo e(Session::get('status','info','warning')); ?> alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
        <?php if(is_array(Session::get('message'))): ?>
            <?php if(count(Session::get('message')) > 1): ?>
                <ul>
                <?php $__currentLoopData = Session::get('message'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($message); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <?php echo e(Session::get('message')[0]); ?>    
            <?php endif; ?>
        <?php else: ?>
            <?php echo e(Session::get('message')); ?>

        <?php endif; ?>
    </div>   
<?php endif; ?><?php /**PATH C:\laravel\public_html\resources\views/layouts/alert2.blade.php ENDPATH**/ ?>