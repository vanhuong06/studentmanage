<div class="box-body">
    {!! Form::normalInput('school_name', 'Tên', $errors, $school) !!}
    {!! Form::normalInput('school_code', 'Code', $errors, $school) !!}
            <div class='form-group{{ $errors->has('tags') ? ' has-error' : '' }}'>
                {!! Form::label('Các Ngành') !!}
                <select name="school_major[]" id="major" class="input-tags" multiple>
                    <?php foreach ($jobs as $value): ?>
                    <option value="{{ $value->major_id  }}" {{ in_array($value->school_code , $schools) ? ' selected' : null }} >{{ $value->major_id }}</option>
                    <?php endforeach; ?>
                </select>
            </div>
</div>

@push('js-stack')
    <script>
        $( document ).ready(function() {
            $('.input-tags').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });
        });
    </script>
@endpush