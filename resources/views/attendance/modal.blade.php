<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Attendance') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addAttendanceForm']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Select Moth').':') }}
                        {{ Form::selectMonth('month',now()->month,['class' => 'form-control status-filter w-100','id'=>'month']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Select Year').':') }}
                        {{ Form::selectRange('year',1900,now()->year,now()->year,['class' => 'form-control status-filter w-100','id'=>'year']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Department').':') }}
                        {{  Form::select('department', $department, null, ['id' => 'filter_department', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Department']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Year').':') }}
                        {{  Form::select('student_year', $year, null, ['id' => 'filter_year', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Year']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label(__('Semester').':') }}
                        {{ Form::select('semester', $semester, null, ['id' => 'filter_semester', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Semester']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('Save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'attendanceSave']) }}
                    <button type="button" class="btn btn-default ml-1"
                            data-dismiss="modal">{{ __('Cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
