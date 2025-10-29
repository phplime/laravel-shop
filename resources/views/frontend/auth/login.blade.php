@extends('index')
@section('content')
    @include('frontend.home.home_menu')

    <section class="loginSection" style="background-image: url('{{ asset('frontend/images/login-bg.jpg') }}')">
        <div class="container">
            <div class="row align-center justify-center">
                <div class="col-md-8 col-lg-5 col-sm-12">
                    <form action="" method="post">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="topTitle">
                                    <h3>Login</h3>
                                </div>
                                <div class="form-input-body">

                                    <div class="form-group">
                                        <label for="email">Email / Username <span class="error">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <i class="icofont-envelope"></i>
                                            </div>
                                            <input type="text" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password <span class="error">*</span> <a href="">Forgot</a></label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <i class="icofont-ui-lock"></i>
                                            </div>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer loginCard-footer">
                                <button type="submit" class="btn submit-btn block ml-auto"><i class="icofont-hand-drag1"></i> Login</button>
                                <p class="m-0 text-color">Don't have an account..?? <a href="{{ route('register') }}">Register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
