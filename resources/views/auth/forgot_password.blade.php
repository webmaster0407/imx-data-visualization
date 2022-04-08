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
          <h4 class="text-center mb-4 text-white">Olvidé mi Contraseña</h4>
          <form action="{!! route('forgot-password'); !!}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="text-white"><strong>Email</strong></label>
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Escribe el email registrado" onkeydown="$('.error-small-white').fadeOut(0);">
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
            </div>
            <div class="text-center">
              <button type="submit" class="btn bg-white text-primary btn-block">ENVIAR</button>
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
