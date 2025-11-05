@extends('frontend.partials.frontend_app')
@section('content')
@include('frontend.landing_page.home_menu')
    <section class="loginSection" style="background-image: url('{{ asset('assets/frontend/images/login-bg.jpg') }}')">
        <div class="container">
            <div class="row align-center justify-content-center">
                <div class="col-md-8 col-lg-5 col-sm-12">
                    <form action="{{ url('weblogin') }}" method="post" onsubmit="formSubmit(event,this)">
                        @csrf;
                        <div class="card
                        shadow-none">
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
                                            <input type="text" name="identifier" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password <span class="error">*</span> <a
                                                href="">Forgot</a></label>
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
                                <button type="submit" class="btn submit-btn block ml-auto"><i
                                        class="icofont-hand-drag1"></i> Login</button>
                                <p class="m-0 text-color">Don't have an account..?? <a
                                        href="{{ url('register') }}">Register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
