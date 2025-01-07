
{!! Form::open(array('route' => array('assign_area.update'),'class'=>'form-horizontal','role'=>'form')) !!} 

 <div id="editModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
           
                {!! Form::token(); !!}
                {!! csrf_field() ; !!} 
                {!! Form::hidden('id',null, ['class'=>'form-control','id'=>'id_edit']) !!}
                <div class="editform"> 
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Main Agent <span class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        {!! Form::select ('employee_id',$employee, null,['placeholder' => 'Select Agent...','class'=>'chosen-select','required'=>true])!!}
                    </div>

                    <label class="col-sm-4 control-label">Percentage Rate </label>
                    <div class="col-sm-7">
                        {!! Form::text('main_rate',null, ['class'=>'form-control', 'required'=> true]) !!}
                    </div>
                </div>    

                <div class="hr-line-dashed"></div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Sub Agent 1 <span class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        {!! Form::select ('team_one',$employee, null,['placeholder' => 'Select Agent...','class'=>'chosen-select','required'=>true])!!}
                    </div>

                    <label class="col-sm-4 control-label">Percentage Rate </label>
                    <div class="col-sm-7">
                        {!! Form::text('rate_one',null, ['class'=>'form-control', 'required'=> true]) !!}
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Sub Agent 2 <span class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        {!! Form::select ('team_two',$employee, null,['placeholder' => 'Select Agent...','class'=>'chosen-select','required'=>true])!!}
                    </div>

                    <label class="col-sm-4 control-label">Percentage Rate </label>
                    <div class="col-sm-7">
                        {!! Form::text('rate_two',null, ['class'=>'form-control', 'required'=> true]) !!}
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Sub Agent 3 <span class="text-danger">*</span></label>
                    <div class="col-sm-7">
                        {!! Form::select ('team_three',$employee, null,['placeholder' => 'Select Agent...','class'=>'chosen-select','required'=>true])!!}
                    </div>

                    <label class="col-sm-4 control-label">Percentage Rate </label>
                    <div class="col-sm-7">
                        {!! Form::text('rate_three',null, ['class'=>'form-control', 'required'=> true]) !!}
                    </div>
                </div>
                </div>

            </div>
            <div class="modal-footer">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary btn-update']) !!}
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>                                 
            </div>
            
        </div>
     </div>
 </div>

{!! Form::close() !!} 


