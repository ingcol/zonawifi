@extends('layouts.app_login')

@section('content')
<div style="height: 70px; box-shadow: 0 0 12px #ccc" class="bg-white p-4">
<h6><i class="fa fa-wifi"></i> Zonas wifi Kalu</h6>

</div>
<div class="wrapper" >
  <form method="POST" action="{{ route('login') }}" class="form-signin pb-4">
    @csrf
    <h4 class="form-signin-heading text-center mt-4">Acceder al sistema </h4>
    <input id="login" type="text" class="form-control mb-4" placeholder="Usuario / Email" name="login" value="{{ old('login') }}" required>
    @if ($errors->has('login'))
    <span class="help-block">
      <strong>{{ $errors->first('login') }}</strong>
  </span>
  @endif
  <input id="password" type="password" class="form-control mb-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
  @error('password')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
<button type="submit" class="btn form-control form-bg-success btn-lg  mb-4 "> <i class="ik ik-arrow-up-circle"></i> Ingresar</button>
</form>
</div>
@endsection