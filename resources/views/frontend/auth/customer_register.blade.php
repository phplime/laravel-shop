@extends('frontend.baseapp')
@section('content')
    <section class="customer_loginSection customer_registerSection">
        <div class="container">
            <div class="row align-center justify-center">
                <div class="col-md-10 col-lg-6 col-sm-12">
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-body">
                                <div class="topTitle text-center">
                                    <h3>Registration</h3>
                                </div>
                                <div class="form-input-body">

                                    <div class="form-group">
                                        <label for="name">Name<span class="error">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email<span class="error">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="password">Password <span class="error">*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="password">
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer loginCard-footer">
                                <button type="submit" class="btn submit-btn block w-full"><i class="fa fa-user-plus"></i> Register</button>
                                <p class="mb-0 mt-2 text-color">Have an account..?? <a
                                        href="{{ route('customer_login', ['slug' => 'kinbo']) }}">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
