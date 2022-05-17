<div id="addYearModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Year') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addYearForm']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('year',__('Year').':') }}<span class="mandatory">*</span>
                        {{ Form::text('year', null, ['class' => 'form-control','required','id'=>'year']) }}
                    </div>
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
