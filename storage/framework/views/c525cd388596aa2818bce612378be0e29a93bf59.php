 <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="/img/temp-logo.jpg" />
                                 </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo e($auth_employee->firstname); ?> <?php echo e($auth_employee->lastname); ?></strong>
                                 </span> <span class="text-muted text-xs block"><?php echo e($auth_role->display_name); ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo e(route('user.edit',$auth_user->id)); ?>">Change password</a></li>
                                <li class="divider"></li>
                                <li><a id="logout-form" href="<?php echo e(route('logout')); ?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            <img alt="image" class="img-circle" src="/img/logo_v2.jpg"/>
                        </div>
                    </li> 

           <?php $__currentLoopData = $auth_navigation->where('group_id', null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isRouteExist($nav->route_name)): ?>
                    <li class="<?php echo e(isActive($nav->route_name)); ?>">
                        <a href="<?php echo e(route($nav->route_name)); ?>">
                            <i class="fa <?php echo e($nav->icon_class); ?>"></i> 
                            <span class="nav-label"><?php echo e($nav->display_name); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            
            <?php $__currentLoopData = $navGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($auth_navigation->where('group_id', $group->id)->count()): ?>
                    <li class="nav-group">
                        <a href="#"><i class="fa <?php echo e($group->icon_class); ?>"></i><span class="nav-label"><?php echo e($group->name); ?></span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                        <?php $__currentLoopData = $auth_navigation->where('group_id', $group->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isRouteExist($nav->route_name)): ?>
                                <li class="<?php echo e(isActive($nav->route_name)); ?>"><a href="<?php echo e(route($nav->route_name)); ?>"><i class="fa fa-caret-right"></i> <?php echo e($nav->display_name); ?></a></li>                           
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <li class="landing_link">
                        <a ui-sref="landing" href="#"><i class=""></i> <span class="nav-label ng-binding"></span> <span class="label label-warning pull-right"></span></a>
                    </li>

            </ul>

    </div>

</nav>
        

   <?php /**PATH C:\laravel\public_html\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>