<?php $__env->startSection('pageTitle','Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo e($title); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('main')); ?>">Home</a>
            </li>
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
                    <h5>User List</h5>
                    <div class="ibox-tools <?php echo e(can('user.create')); ?>">
                        
                        <a class="btn btn-w-m btn-primary btn-sm" href="<?php echo e(route('user.create')); ?>">

                            <i class="fa fa-plus">&nbsp;</i>Add User

                        </a> 
                                  
                    </div>                    
                </div>
                
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTables-example" data-toggle="dataTable" data-form="deleteForm" >
                             <thead>
                                    <tr>

                                    <th>ID</th>
                                    <th>Employee Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                           
                                    </tr>
                            </thead>
                            <tbody>

                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>

                                            <td><?php echo e($user->id); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->username); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e($user->role); ?></td>

                                            <td>

                                                 <div class="btn-group">        
                                                    <?php if($user->activated_status === 1): ?>
                                                        <span class="label label-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="label label-warning">Inactive</span>
                                                    <?php endif; ?>
                                                </div>
                                                
                                            </td>
                                            
                                            <td>


                                                <div class="btn-group">
                                                    <?php if(!can('user.edit')): ?>   
                                                    <a class="btn-info btn btn-xs " href="<?php echo e(route('user.edit',$user->id)); ?>">Edit</a>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="btn-group ">
                                                    <?php if(!can('user.delete')): ?> 
                                                    <?php echo Form::model($user, [ 'route' => ['user.delete', $user->id], 'class' =>'btn-group form-delete']); ?>

                                                    <?php echo e(method_field('DELETE')); ?>                                                                                                        
                                                    <?php echo Form::hidden('id', $user->id); ?>

                                                    <?php echo Form::submit(trans('Delete'), ['class' => 'btn btn-xs btn-danger', 'name' => 'delete_modal']); ?>

                                                    <?php echo Form::close(); ?>

                                                    <?php endif; ?>                                            
                                                          
                                                </div>
                                                           
                                                       
                                            </td>

                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                               
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>        
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/css/plugins/chosen/bootstrap-chosen.css')); ?>" />
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('/js/plugins/chosen/chosen.jquery.js')); ?>" type="text/javascript"></script>

<script type="text/javascript">
            
$(document).ready(function(){
    $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
        e.preventDefault();
        var $form=$(this);
        $('#confirmDelete').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $form.submit();
            });
        });

  });

      
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\public_html\resources\views/pages/user_management/user/index.blade.php ENDPATH**/ ?>