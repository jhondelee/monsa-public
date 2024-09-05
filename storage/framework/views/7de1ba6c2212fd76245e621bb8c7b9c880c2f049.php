        


<?php $__env->startSection('pageTitle','Users'); ?>

<?php $__env->startSection('content'); ?>


      <div class="row wrapper border-bottom white-bg page-heading">

            <div class="col-lg-10">

            <h2>User Management</h2>

                <ol class="breadcrumb">

                    <li class="active">

                        <strong>User List</strong>

                    </li>
                    
                </ol>

            </div>

        </div>

<?php echo $__env->make('layouts.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.deletemodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">

                <div class="col-lg-12">

                    <div class="ibox float-e-margins">

                        <div class="ibox-title">

                            <h5>Edit User</h5>
                            
                        </div>

                        <div class="ibox-content">

                            <div class="form-horizontal m-t-md">

                                     <?php echo Form::model($user, ['route' => ['user.update', $user->id]]); ?>


                                        <?php echo $__env->make('pages.user_management.user._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                  
                                    <?php echo Form::close(); ?>


                            </div>
                                                                     
                        </div>

                    </div>

                </div>

            </div>

        </div>




  <?php $__env->stopSection(); ?>


















<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/user_management/user/edit.blade.php ENDPATH**/ ?>