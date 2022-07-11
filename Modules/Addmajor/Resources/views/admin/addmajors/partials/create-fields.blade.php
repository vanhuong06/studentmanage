<div class="box-body">
{{--    {!! Form:: normalSelect('school_code', 'Trường', $errors, [$sch]) !!} // Create view--}}
{{--    {!! Form::normalInput('major_id', 'Mã Ngành', $errors) !!}--}}
    <div class='form-group{{ $errors->has('tags') ? ' has-error' : '' }}'>
        <select name="major[]" id="major" class="input-tags">
            {!! Form::label('school_name', $sch) !!}
            @foreach($mj as $aKey)
                <option value="{{$aKey -> major_id  .'-'.$aKey->major_name }}">{{$aKey->major_name}}</option>
            @endforeach
        </select>
    </div>
    <div class='form-group{{ $errors->has('tags') ? ' has-error' : '' }}'>
    <select name="addMajor[]" id="major" class="input-tags">
        {!! Form::label('school_name', $sch) !!}
        @foreach($sch as $aKey)
                <option value="{{$aKey -> school_name}}">{{$aKey->school_name}}</option>
        @endforeach
    </select>
    </div>
</div>


@push('js-stack')
    <script>
        $( document ).ready(function() {
            $('.input-tags').selectize({
                create: true,
                sortField: "text",
            });
        });
    </script>
@endpush