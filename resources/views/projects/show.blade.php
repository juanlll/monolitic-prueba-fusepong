@extends('layouts.app') 
@section('title') Detalle del Proyecto #{{$project->id}} 
@endsection 
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detalle del Proyecto #{{$project->id}}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ URL::previous() }}" class="btn btn-primary form-btn float-right">Regresar</a>
        </div>
    </div>
    @include('stisla-templates::common.errors')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                @include('projects.show_fields')
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Historias de Usuario del Proyecto</h4>
                <div class="card-header-action">
                    <a href="{{ route('userStories.create')}}?projectId={{$project->id}}" class="btn btn-primary form-btn">Agregar Historia de Usuario <i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                @include('user_stories.table') @include('user_stories.templates.templates')
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
    <script>
        let recordsURL = "{{ route('userStories.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/user_stories/user_stories.js')}}"></script>
@endsection
