<div id="editInterviewModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Interview Tips') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editInterviewForm']) }}
            <div class="modal-body">
                {{ Form::hidden('interviewId',null,['id'=>'interviewId']) }}
                <div class="row">
                    @if(Auth::user()->role==0)
                        <div class="form-group col-sm-12">
                            {{ Form::label(__('Institute Name').':') }} <span class="mandatory">*</span>
                            {{ Form::select('institute_id', $institute,null, ['class' => 'form-control','required','id'=>'edit_institute_id']) }}
                        </div>
                    @endif
                    <div class="form-group col-sm-12">
                        {{ Form::label('question',__('Question').':') }}<span class="mandatory">*</span>
                        {{ Form::text('question', null, ['class' => 'form-control','required','id'=>'editQuestion']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Answer').':') }} <span class="mandatory">*</span>
                        {{ Form::textarea('answer', null, ['class' => 'form-control ckeditor','required','rows'=>'3','id'=>'editAnswer']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'editInterviewBtnSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
