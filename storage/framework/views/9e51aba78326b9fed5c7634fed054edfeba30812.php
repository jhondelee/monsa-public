
<?php echo Form::token();; ?>


<?php echo csrf_field() ;; ?>


<div class="form-group">
    <label class="col-sm-2 control-label">Role <span class="text-danger">*</span></label>
    <div class="col-sm-3">
        <?php echo Form::select('role_id', $roleList, (isset($user->roles[0]->id)?$user->roles[0]->id:null), ['placeholder'=>'--', 'class' =>'form-control m-b chosen-select', 'required'=>'']); ?>

    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group">
    <label class="col-sm-2 control-label">Employee Number <span class="text-danger">*</span><br><small class="text-navy">Unique</small></label>
    <div class="col-sm-2">
        <?php echo Form::text('emp_number', (isset($user->employees->emp_number)?$user->employees->emp_number:null), ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">First Name <span class="text-danger">*</span></label>
    <div class="col-sm-4">
        <?php echo Form::text('firstname', (isset($user->employees->firstname)?$user->employees->firstname:null), ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Middle Name <span class="text-danger">*</span></label>
    <div class="col-sm-4">
        <?php echo Form::text('middlename', (isset($user->employees->middlename)?$user->employees->middlename:null), ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Last Name <span class="text-danger">*</span></label>
    <div class="col-sm-4">
        <?php echo Form::text('lastname', (isset($user->employees->lastname)?$user->employees->lastname:null), ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Department <span class="text-danger">*</span></label>
    <div class="col-sm-4">
        <?php echo Form::text('department', (isset($user->employees->department)?$user->employees->department:null), ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Position <span class="text-danger">*</span></label>
    <div class="col-sm-4">
        <?php echo Form::text('position', (isset($user->employees->position)?$user->employees->position:null), ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>


<div class="hr-line-dashed"></div>

<div class="form-group">
    <label class="col-sm-2 control-label">Email <span class="text-danger">*</span><br><small class="text-navy">Unique</small></label>
    <div class="col-sm-4">
        <?php echo Form::text('email', null, ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Username <span class="text-danger">*</span><br><small class="text-navy">Unique</small></label>
    <div class="col-sm-3">
        <?php echo Form::text('username', null, ['class'=>'form-control', 'required'=>'']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Password <span class="text-danger">*</span></label>
    <div class="col-sm-3">
        <?php echo Form::password('password', ['class'=>'form-control']+(!isset($user)?['required'=>'']:[])); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Confirm Password <span class="text-danger">*</span></label>
    <div class="col-sm-3">
        <?php echo Form::password('password_confirmation', ['class'=>'form-control']+(!isset($user)?['required'=>'']:[])); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-6">
        <div class="checkbox checkbox-success">
            <?php echo Form::checkbox('activated', '1', null, ['id'=>'activated']); ?>

            <label for="activated">
                Activate
            </label>
        </div>
    </div>
</div>


<div class="hr-line-dashed"></div>

<div class="form-group">

    <div class="col-sm-4 col-sm-offset-2">

        <a class="btn btn-warning" href="<?php echo e(route('user.index')); ?>">Cancel</a> 

        &nbsp;
                                                           
        <?php echo Form::submit(' Save Changes ', ['class' => 'btn btn-primary']); ?>

                                            
    </div>  

</div>
<?php /**PATH C:\laravel\public_html\resources\views/pages/user_management/user/_form.blade.php ENDPATH**/ ?>