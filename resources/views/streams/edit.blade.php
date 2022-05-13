<div id="editStreamModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Stream') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editStreamForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="streamValidationErrorsBox"></div>
                {{ Form::hidden('streamId',null,['id'=>'streamId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('stream',__('Stream').':') }}<span class="mandatory">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required','id'=>'editStream']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'editStreamBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
