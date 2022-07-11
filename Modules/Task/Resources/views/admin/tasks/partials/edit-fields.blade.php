<div class="box-body">
    <div class="row">
        <div class="col-xs-12 form-group">
            <label class="required" for="std_id">Name</label>
            <select class="form-control select2 {{ $errors->has('class') ? 'is-invalid' : '' }}" name="student_id" id="student_id" required>
                @foreach($std as $value => $class)
                    <option value="{{ $class }}"  {{ old('student_id') == $value ? 'selected' : '' }} >{{ $class }}</option>
                @endforeach
            </select>
            @if($errors->has('class'))
                <div class="invalid-feedback">
                    {{ $errors->first('class') }}
                </div>
            @endif
        </div>
        <div class="col-xs-12 form-group">
            <label class="required" for="date">Date</label>
            <input type="date" class="form-control" name="date" value="{{ $task->date }}">
            <p class="help-block"></p>
            @if($errors->has('date'))
                <p class="help-block">
                    {{ $errors->first('date') }}
                </p>
            @endif
        </div>
        <div class="col-xs-12 form-group">
            <label class="required" for="start_time">Start time</label>
            <input class="form-control lesson-timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ $task->start_time }}" required>
            @if($errors->has('start_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('start_time') }}
                </div>
            @endif

        </div>
        <div class="col-xs-12 form-group">
            <label class="required" for="end_time">end time</label>
            <input class="form-control lesson-timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ $task->end_time }}" required>
            @if($errors->has('end_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('end_time') }}
                </div>
            @endif

        </div>
</div>
