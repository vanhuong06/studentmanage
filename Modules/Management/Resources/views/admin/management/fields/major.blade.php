<div class='form-group{{ $errors->has('tags') ? ' has-error' : '' }}'>
    {!! Form::label('tags', $managements) !!}
    <select name="tags[]" id="tags" class="input-tags" multiple>
        <?php foreach ($managements as $tag): ?>
        <option value="{{ $tag->position }}" {{ in_array($tag->position, $tags) ? ' selected' : null }}>{{ $tag->position }}</option>
        <?php endforeach; ?>
    </select>
    {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
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