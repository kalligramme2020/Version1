@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-4">

                <div class="text-center mb-4">
                    <img src="{{ asset('logo/zzzz.png') }}" alt="">
                </div>
                <div class="card mt-2">

                    <div class="card-body">

                        <div class="card-header-pills text-center mb-4"><h3 class="text-success font-weight-bold">Inscription</h3></div>
                        <div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="nom">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="mots de passe" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                </div>

                                <div class="d-flex justify-content-center mt-2 mb-3">
                                    <button type="submit" class="btn btn-outline-primary btn-sm text-primary">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>

                                <div class="d-flex justify-content-center mb-2">
                                    <p>Vous avez deja un compte?  <a href="{{ route('login') }}" class="text-success font-weight-bold">Connexion</a></p>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
