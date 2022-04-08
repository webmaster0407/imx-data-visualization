{{-- Extends layout --}}
@extends('layout.fullwidth')

{{-- Content --}}
@section('content')
<div class="col-md-6">
  <div class="authincation-content">
    <div class="row no-gutters">
      <div class="col-xl-12">
        <div class="auth-form">
          <div class="text-center mb-3">
            <a href="{!! url('/index'); !!}"><img src="{{ asset('images/logo-full.png') }}" alt=""></a>
          </div>
          <h4 class="text-center mb-4 text-white">Ingresar a tu Cuenta</h4>
          <form action="{!! url('auth/login'); !!}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="mb-1 text-white"><strong>Usuario</strong></label>
              <input type="text" class="form-control" value="{{ old('username') }}" id="username" name="username" placeholder="" required>
            </div>
			<div class="form-group">
              <label class="mb-1 text-white"><strong>Contraseña</strong></label>
              <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="" required>
            </div>
            @foreach ($errors->all() as $error)
            <small class="error-small-white">{{ $error }}</small>
            @endforeach
            @if (\Session::has('status'))
            <div class="alert alert-success">
              <ul>
                <small class="error-small-white">{!! \Session::get('status') !!}</small>
              </ul>
            </div>
            @endif
            <div class="form-row d-flex justify-content-between mt-4 mb-2">
              <div class="form-group">
                <div class="custom-control custom-checkbox ml-1 text-white">
                  <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                  <label class="custom-control-label" for="remember">Recordar mis preferencias</label>
                </div>
              </div>
            </div><br>
            <div class="text-center">
              <button type="submit" class="btn bg-white text-primary btn-block">Ingresar</button><br><h5 class="text-center mb-4 text-white">Al acceder a este sitio web aceptas que conoces y estás de acuerdo con nuestro aviso de privacidad. <a href="https://geo.pvem-cdmx.org.mx/avisoprivacidad.html" target="_blank" class="text-white">Da click aquí para leerlo.</a></h5>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<style media="screen">
.error-small-white{
  margin-top: 5px;
  color: white;
}
</style>
@endsection
