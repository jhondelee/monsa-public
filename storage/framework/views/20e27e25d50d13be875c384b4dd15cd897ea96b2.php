    
<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome to MONSA Trading</span>
            </li>
            <li>
                <a href="<?php echo e(route('logout')); ?>" class="auth-logout">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
                <?php echo Form::open(['route'=>'logout', 'id'=>'logout-form']); ?> <?php echo Form::close(); ?>

            </li>
        </ul>
    </nav>
</div>
      <?php /**PATH C:\laravel\public_html\resources\views/layouts/topnavbar.blade.php ENDPATH**/ ?>