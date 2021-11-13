<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $userStory->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $userStory->name }}</p>
</div>

<!-- Project Id Field -->
<div class="form-group">
    {!! Form::label('project_id', 'Project Id:') !!}
    <p>{{ $userStory->project_id }}</p>
</div>

<!-- As A Field -->
<div class="form-group">
    {!! Form::label('as_a', 'As A:') !!}
    <p>{{ $userStory->as_a }}</p>
</div>

<!-- So That Field -->
<div class="form-group">
    {!! Form::label('so_that', 'So That:') !!}
    <p>{{ $userStory->so_that }}</p>
</div>

<!-- I Want Field -->
<div class="form-group">
    {!! Form::label('i_want', 'I Want:') !!}
    <p>{{ $userStory->i_want }}</p>
</div>

<!-- Acceptance Criteria Field -->
<div class="form-group">
    {!! Form::label('acceptance_criteria', 'Acceptance Criteria:') !!}
    <p>{{ $userStory->acceptance_criteria }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userStory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userStory->updated_at }}</p>
</div>

