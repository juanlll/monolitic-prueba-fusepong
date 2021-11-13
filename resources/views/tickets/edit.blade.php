@extends('layouts.app')
@section('title')
    Editar Ticket #{{$ticket->id}} 
@endsection
@section('content')
    <section class="section">
            <div class="section-header">
                <h3 class="page__heading m-0">Editar Ticket #{{$ticket->id}} </h3>
                <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                    <a href="{{ URL::previous() }}"  class="btn btn-primary">Regresar</a>
                </div>
            </div>
  <div class="content">
              @include('stisla-templates::common.errors')
              <div class="section-body">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-body ">
                                    {!! Form::model($ticket, ['route' => ['tickets.update', $ticket->id], 'method' => 'patch']) !!}
                                        <div class="row">
                                            @include('tickets.fields')
                                        </div>

                                    {!! Form::close() !!}
                            </div>
                         </div>
                    </div>
                 </div>
              </div>
   </div>
  </section>
@endsection
