<div class="box-body">
    {!! Form::normalInput('name', 'Name', $errors, $management) !!}
    {!! Form::normalInput('phone', 'Phone', $errors, $management) !!}
    {!! Form::normalInput('major', 'Ngành', $errors, $management) !!}
    {!! Form::normalInput('school_code', 'Code', $errors ,$management) !!}
    {!! Form::normalInput('address', 'Địa chỉ', $errors, $management) !!}
    {!! Form:: normalSelect('position', 'Position', $errors, ['FE','BE','Mobile', 'BA'], $management) !!}
</div>

