<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 50]) !!}
</div>

<!-- As A Field -->
<div class="form-group col-sm-6">
    {!! Form::label('as_a', 'As A:') !!}
    {!! Form::text('as_a', null, ['class' => 'form-control','minlength' => 5,'maxlength' => 300]) !!}
</div>

<!-- So That Field -->
<div class="form-group col-sm-6">
    {!! Form::label('so_that', 'So That:') !!}
    {!! Form::text('so_that', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 500]) !!}
</div>

<!-- I Want Field -->
<div class="form-group col-sm-6">
    {!! Form::label('i_want', 'I Want:') !!}
    {!! Form::text('i_want', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 500]) !!}
</div>

<!-- Acceptance Criteria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('acceptance_criteria', 'Acceptance Criteria:') !!}
    {!! Form::text('acceptance_criteria', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 500]) !!}
</div>

<!-- Project Id Field -->
<div class="form-group col-sm-6">
    <label for="project_id">Proyectos:</label><span class="text-danger">*</span>
    <select id="project_id" name="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}" value="{{ old('project_id') }}" autofocus required>
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}" {{ request()->get('projectId') == $project->id ? 'selected':''}}>{{$project->name}}</option>
                                @endforeach    
                            </select>
    <div class="invalid-feedback">
        {{ $errors->first('project_id') }}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ URL::previous() }}" class="btn btn-light">Cancelar</a>
</div>
