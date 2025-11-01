<div class="row">
    <div class="col-md-9">

        <div class="checkout_loginArea">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control only_number">
                </div>
                <div class="form-group">
                    <label for="">Password / <a href="" class="decoration-none">Forgot</a></label>
                    <input type="password" name="password" class="form-control only_number">
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="icofont-hand-drag1"></i> Login</button>
                <div class="mt-5">
                    <p class="m-0 text-color">Doesn't an account?? <a href="javascript:;"
                            class="decoration-none customer__login login">Register</a></p>
                </div>
            </form>
        </div><!-- Login Area End./ -->

        <div class="checkout_registerArea" style="display: none">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Name <span class="error">*</span></label>
                    <input type="text" name="name" class="form-control only_number">
                </div>
                <div class="form-group">
                    <label for="">Phone <span class="error">*</span></label>
                    <input type="text" name="phone" class="form-control only_number">
                </div>
                <div class="form-group">
                    <label for="">Password <span class="error">*</span></label>
                    <input type="password" name="password" class="form-control only_number">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password <span class="error">*</span></label>
                    <input type="password" name="password" class="form-control only_number">
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="icofont-hand-drag1"></i>
                    Register</button>
                <div class="mt-5">
                    <p class="m-0 text-color">Already have an account?? <a href="javascript:;"
                            class="decoration-none customer__login">Login</a></p>
                </div>
            </form>
        </div><!-- Login Area End./ -->

    </div>
</div>
