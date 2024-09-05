    


<?php $__env->startSection('pageTitle','Item'); ?>

<?php $__env->startSection('content'); ?>




<div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-lg-10">

                    <h2>Item</h2>

                   <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo e(route('main')); ?>">Home</a>
                        </li>
                        <li class="active">
                            <strong>Item</strong>
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

                            <h5>Create Item</h5>
                            
                        </div>

                        <div class="ibox-content">

                            <div class="form-horizontal m-t-md">

                                <?php echo Form::open(['route'=>'item.store' ,'enctype'=>"multipart/form-data",  'class'=>'form-horizontal']); ?> 

                                    <?php echo $__env->make('pages.item_management.items._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                  
                                <?php echo Form::close(); ?>


                            </div>
                                                                     
                        </div>

                    </div>

                </div>

            </div>

        </div>




  <?php $__env->stopSection(); ?>


















<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/item_management/items/create.blade.php ENDPATH**/ ?>