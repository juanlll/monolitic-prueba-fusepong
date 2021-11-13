<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!} {!! Form::text('name', null, ['class' => 'form-control','minlength' => 2,'maxlength' => 255]) !!}
</div>

<!-- Company Id Field -->
<div class="form-group col-sm-6">
    <label for="company_id">Compañia:</label><span class="text-danger">*</span>
    <select id="company_id" name="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" value="{{ old('company_id') }}" autofocus required>
                                @foreach ($companies as $company)
                                <option value="{{$company->id}}" {{ request()->get('companyId') == $company->id ? 'selected':''}}>{{$company->name}}</option>
                                @endforeach    
                            </select>
    <div class="invalid-feedback">
        {{ $errors->first('company_id') }}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ URL::previous() }}" class="btn btn-light">Cancelar</a>
</div>