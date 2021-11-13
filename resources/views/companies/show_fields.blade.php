<div class="card author-box card-primary">
    <div class="card-body">
        <div class="author-box-left">
            <img alt="image" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
            <div class="clearfix"></div>
            <a href="#" class="btn btn-primary mt-3">Suscrito</a>
        </div>
        <div class="author-box-details">
            <div class="author-box-name">
                <a href="#">{{$company->name}}</a>
            </div>
            <div class="author-box-job">Nit: {{$company->nit}}</div>
            <div class="author-box-description" style="font-size: initial;">
                <p>La compañia <strong>{{$company->name}}</strong> está ubicada en <strong>{{$company->address}}</strong>, y sus datos de contacto son: correo electronico es <strong>{{$company->email}}</strong> y telefono <strong>{{$company->phone}}</strong>.
                </p>
            </div>
        </div>
    </div>
</div>