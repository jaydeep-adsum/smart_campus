<div id="editSemesterModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Semester') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editSemesterForm']) }}
            <div class="modal-body">
                {{ Form::hidden('semesterId',null,['id'=>'semesterId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('semester',__('Semester').':') }}<span class="mandatory">*</span>
                        {{ Form::text('semester', null, ['class' => 'form-control','required','id'=>'editSemester']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'editSemesterBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
