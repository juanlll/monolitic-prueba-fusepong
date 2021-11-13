@extends('layouts.app') @section('css')
<link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" /> @endsection @section('title') Detalle De La Compañia #{{$company->id}} @endsection @section('content')
<section class="section">
    <div class="section-header">
        <h1>Detalle De La Compañia #{{$company->id}}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('companies.index') }}" class="btn btn-primary form-btn float-right">Back</a>
        </div>
    </div>
    @include('stisla-templates::common.errors')
    <div class="section-body">
        @include('companies.show_fields')
        <div class="card card-primary">
            <div class="card-header">
                <h4>Proyectos De La Compañia #{{$company->id}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('projects.create')}}?companyId={{$company->id}}" class="btn btn-primary form-btn">Agregar Proyecto <i class="fas fa-plus"></i></a>
                </div>
            </div>

            <div class="card-body">
                @include('projects.table') @include('projects.templates.templates')
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Usuarios Suscritos</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png" alt="avatar">
                        <div class="media-body">
                            <div class="float-right text-primary">Now</div>
                            <div class="media-title">Farhan A Mujib</div>
                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="https://demo.getstisla.com/assets/img/avatar/avatar-2.png" alt="avatar">
                        <div class="media-body">
                            <div class="float-right">12m</div>
                            <div class="media-title">Ujang Maman</div>
                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="https://demo.getstisla.com/assets/img/avatar/avatar-3.png" alt="avatar">
                        <div class="media-body">
                            <div class="float-right">17m</div>
                            <div class="media-title">Rizal Fakhri</div>
                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 rounded-circle" width="50" src="https://demo.getstisla.com/assets/img/avatar/avatar-4.png" alt="avatar">
                        <div class="media-body">
                            <div class="float-right">21m</div>
                            <div class="media-title">Alfa Zulkarnain</div>
                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                        </div>
                    </li>
                </ul>
                <div class="text-center pt-1 pb-1">
                    <a href="#" class="btn btn-primary btn-lg btn-round">
                  View All
                </a>
                </div>
            </div>
        </div>

    </div>

</section>
@endsection @section('scripts')
<script>
    let recordsURL = "{{ route('projects.index') }}/";
</script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
<script src="{{mix('assets/js/projects/projects.js')}}"></script>
@endsection