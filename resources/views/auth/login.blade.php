@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <form class="registro" method="post">
    @csrf

        <div class="row justify-content-center">
          <h4>INICIO DE SESIÓN</h4>
        </div>

        <div class="row justify-content-center">
            <div class="form-group col-md-7">
              <label for="email">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="" required autocomplete="email" autofocus>
                {{-- EL VALUE LO DEJO VACIO PARA QUE NO PERSISTA CUANDO INGRESAN MAL EL USUARIO Y/O CONTRASEÑA value="{{ old('email') }}" --}}
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-md-7">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-check col-md-7">
                <input name="remember" id="remember" class="form-check-input" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                  Recordar mi dirección
                </label>
            </div>

        </div>

        <div class="row justify-content-center reg">
          <button type="submit" class="btn btn-success">Iniciar Sesión</button>
        </div>

        <div class="row justify-content-center reg">
            <div class="col-sm-3">
                <a href="/login/google" class="btn btn-danger">Ingresar con Google</a>
            </div>
            <div class="col-sm-3">
                <a href="/login/facebook" class="btn btn-primary">Ingresar con Facebook</a>
            </div>
        </div>

        <div class="row justify-content-end">
          @if (Route::has('password.request'))
            <a class="btn btn-outline-primary" href="{{ route('password.request') }}">
              {{ __('¿Olvidaste tu contraseña?') }}
            </a>
          @endif
        </div>

    </form>

</div>
<script type="text/javascript" src="/js/auth/login.js"></script>
@endsection
