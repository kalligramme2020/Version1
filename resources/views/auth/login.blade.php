@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">

                <div class="text-center mb-3">
                    <img src="{{ asset('logo/zzzz.png') }}" alt="">
                </div>
                <div class="card mt-2">

                    <div class="card-body">

                        <div class="card-header-pills text-center mb-4"><h3 class="font-weight-bold text-success">Connexion</h3></div>
                        <div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf


                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Enter email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <input type="password" class="form-control" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group  justify-content-center mt-3 ml-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('se souvenir de moi') }}
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-outline-primary btn-sm text-dark">
                                        {{ __('Connexion') }}
                                    </button>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <p class="text-success font-weight-bold">se connecter avec:</p>

                                    <a type="button" class="btn-floating btn-fb btn-sm">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a type="button" class="btn-floating btn-tw btn-sm">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </div>

                                <div class="d-flex justify-content-center mt-2">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Mots de passe oublier?') }}
                                        </a>
                                    @endif
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
