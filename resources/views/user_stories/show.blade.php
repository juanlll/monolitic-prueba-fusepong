@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('title')
    Detalle de Historia de Usuario #{{$userStory->id}}
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
        <h1> Detalle de Historia de Usuario #{{$userStory->id}}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('userStories.index') }}"
                 class="btn btn-primary form-btn float-right">Regresar</a>
        </div>
      </div>
   @include('stisla-templates::common.errors')
    <div class="section-body">
           <div class="card">
            <div class="card-body">
                    @include('user_stories.show_fields')
            </div>
            </div>
            <div class="card card-primary">
            <div class="card-header">
                <h4>Tickets De La Historia De Usuario #{{$userStory->id}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('tickets.create')}}?userStory={{$userStory->id}}" class="btn btn-primary form-btn">Agregar Ticket <i class="fas fa-plus"></i></a>
                </div>
            </div>

            <div class="card-body">
                @include('tickets.table') @include('tickets.templates.templates')
            </div>
        </div>
    </div>
    </section>
@endsection

@section('scripts')
    <script>
        let recordsURL = "{{ route('tickets.index') }}/";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/tickets/tickets.js')}}"></script>
@endsection

