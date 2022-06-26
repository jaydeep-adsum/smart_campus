<div id="addInterviewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Interview Tips') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addInterviewForm']) }}
            <div class="modal-body">
                <div class="row">
                    @if(Auth::user()->role==0)
                        <div class="form-group col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'institute_id']) }}
                        </div>
                    @endif
                    <div class="form-group col-sm-12">
                        {{ Form::label('question',__('Question').':') }}<span class="mandatory">*</span>
                        {{ Form::text('question', null, ['class' => 'form-control','required','id'=>'question']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Answer').':') }} <span class="mandatory">*</span>
                        {{ Form::textarea('answer', null, ['class' => 'form-control ckeditor','required','rows'=>'3','id'=>'answer']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'interviewBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
