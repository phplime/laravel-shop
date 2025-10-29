@extends('index')
@section('content')
    @include('frontend.home.home_menu')
    <div class="registerSection">
        <div class="register_leftContent">
            <div class="registerImg">
                <img src="{{ asset('frontend/images/register.png') }}" alt="image">
            </div>
        </div>
        <div class="register_RightContent">
            <form action="" method="post" class="register_form">
                <div class="topTitle">
                    <h3>Create an account</h3>
                </div>

                <div class="form_inputArea">
                    <div class="form-group">
                        <label for=""><i class="fa-regular fa-user-circle"></i> Owner Name <span class="error">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name...">
                    </div>
                    <div class="form-group">
                        <label for=""><i class="fa-solid fa-user-secret"></i> Username <span class="error">*</span></label>
                        <input type="text" name="username" class="form-control" placeholder="Username...">
                    </div>
                    <div class="form-group">
                        <label for=""><i class="icofont-envelope"></i> Email <span class="error">*</span></label>
                        <input type="text" name="email" class="form-control" placeholder="Email...">
                    </div>
                    <div class="form-group">
                        <label for=""><i class="icofont-phone"></i> Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone...">
                    </div>
                    <div class="form-group">
                        <label for=""><i class="fa-solid fa-key"></i> Password <span class="error">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="***">
                    </div>
                    <div class="form-group">
                        <label for=""><i class="fa-solid fa-key"></i> Confirm Password <span class="error">*</span></label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="***">
                    </div>
                </div>
                <div class="register-action">
                    <button type="submit" class="btn submit-btn block ml-auto"><i class="fa-solid fa-user-plus"></i>
                        Signup</button>
                    <p class="m-0 text-color">Already have an account..?? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
