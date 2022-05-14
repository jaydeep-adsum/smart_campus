<div id="editQuestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Question & Response') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editQuestionForm']) }}
            <div class="modal-body">
                {{ Form::hidden('questionId',null,['id'=>'questionId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('category',__('Category').':') }}<span class="mandatory">*</span>
                        {{ Form::text('category', null, ['class' => 'form-control','required','id'=>'editCategory']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Response').':') }} <span class="mandatory">*</span>
                        {{ Form::textarea('response', null, ['class' => 'form-control ckeditor','required','rows'=>'3','id'=>'editResponse']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'editQuestionBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
