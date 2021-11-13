
<!-- User Story Id Field -->
<div class="form-group col-sm-6">
    <label for="user_story_id">Historia De Usuario:</label><span class="text-danger">*</span>
    <select id="user_story_id" name="user_story_id" class="form-control{{ $errors->has('user_story_id') ? ' is-invalid' : '' }}" value="{{ old('user_story_id') }}" autofocus required>
        @foreach ($userStories as $userStory)
        <option value="{{$userStory->id}}" {{ request()->get('projectId') == $userStory->id ? 'selected':''}}>{{$userStory->name}}</option>
        @endforeach    
    </select>
    <div class="invalid-feedback">
        {{ $errors->first('user_story_id') }}
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estado:') !!}<span class="text-danger">*</span>
    {!! Form::select('status',[
        'ACTIVE' => 'ACTIVE', 
        'IN_PROCESS' => 'IN_PROCESS',
        'FINISHED' => 'FINISHED'
        ],null,['class'=>'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12">
    {!! Form::label('comments', 'Comentarios:') !!}<span class="text-danger">*</span> {!! Form::textarea('comments', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 50]) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tickets.index') }}" class="btn btn-light">Cancelar</a>
</div>