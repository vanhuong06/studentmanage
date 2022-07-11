<div class="box-body">
    {!! Form::normalInput('name', 'Tên', $errors) !!}
    {!! Form::normalInput('phone', 'SĐT', $errors) !!}
    {!! Form::normalInput('major', 'Ngành', $errors) !!}
    {!! Form::normalInput('school_code', 'Mã Trường', $errors) !!}
    {!! Form::normalInput('address', 'Địa chỉ', $errors) !!}
    {!! Form:: normalSelect('position', 'Vị trí', $errors, ['FE','BE','Mobile', 'BA']) !!}
{{--    {!! Form::normalInput('position', 'Position', $errors) !!}--}}
</div>
