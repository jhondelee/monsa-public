<?php $__env->startSection('content'); ?>


  
<div class="middle-box text-center loginscreen animated fadeInDown">
   
       <div>
            <div>

                <h1 class="logo-name">
                  
                        <img alt="image" width="500" height="500" class="img-responsive" src="/img/temporary-logo.jpg"/>
                  
                </h1>

            </div>

            <h3>Monsa Sales and Inventory System</h3>

            <?php echo $__env->make('layouts.alert2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <form class="m-t" role="form" method="POST" action="<?php echo e(route('login')); ?>">

                <?php echo e(csrf_field()); ?>

                
                <div class="form-group">

                    <?php echo Form::text ('username',null,['class'=>'form-control','placeholder'=>'Username', 'required'=>'']); ?>


                       <?php if($errors->has('username')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('username')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>

                <div class="form-group">

                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">


                      <?php if($errors->has('password')): ?>
                            <span class="help-block">
                               <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>

                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <!-- <a href="#"><small>Forgot password?</small></a> -->

            </form>

            <p class="m-t"> <small>MONSA Trading &copy; 2024</small> </p>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Jhondel\OneDrive\Documents\GitHub\monsa-app\resources\views/auth/login.blade.php ENDPATH**/ ?>