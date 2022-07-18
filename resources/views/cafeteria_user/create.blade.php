<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add User') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addForm']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name',__('Name').':') }}<span class="mandatory">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required','id'=>'name']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('email',__('Email').':') }}<span class="mandatory">*</span>
                        {{ Form::text('email', null, ['class' => 'form-control','required','id'=>'email']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('password',__('Password').':') }}<span class="mandatory">*</span>
                        {{ Form::text('password', null, ['class' => 'form-control','required','id'=>'password']) }}
                    </div>
                    @if(Auth::user()->role==0)
                        <div class="form-group col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                        </div>
                    @endif
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'yearBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
