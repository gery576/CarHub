@extends('layout')
@section('content')
<main class="container pb-2">
  <h1 class="text-center display-6 py-3">Belépés</h1>
  <div class="card">
    <div class="card-body">
      <form action="/login" method="post">
        @error('faild')
          <div class="alert alert-danger"><p>{{ $message }}</p></div>
        @enderror
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Felhasználónév:</label>
          <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}">
          @error('username')<p class="text-danger">{{ $message }}</p>@enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Jelszó:</label>
          <input type="password" name="password" id="password" class="form-control">
          @error('password')<p class="text-danger">{{ $message }}</p>@enderror
        </div>
        <div class="d-flex justify-content-center">
          <button class="btn btn-dark" type="submit">Belépek</button>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection
