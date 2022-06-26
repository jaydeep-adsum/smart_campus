<div id="addQuestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Question & Response') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addQuestionForm']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('category',__('Category').':') }}<span class="mandatory">*</span>
                        {{ Form::select('category', ['Motivational'=>'Motivational','Behaviour'=>'Behaviour'],null, ['class' => 'form-control','required','id'=>'department_id']) }}
                    </div>
                    @if(Auth::user()->role==0)
                        <div class="form-group col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                        </div>
                    @endif
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Response').':') }} <span class="mandatory">*</span>
                        {{ Form::textarea('response', null, ['class' => 'form-control ckeditor','required','rows'=>'3','id'=>'response']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'questionBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
