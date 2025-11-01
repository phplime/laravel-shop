<div class="home_navMenu">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="navButton">

                <a class="navbar-brand" href="{{ url('') }}"><img
                        src="{{ asset('assets/frontend/images/shop2.png') }}" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="icofont-navigation-menu"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mr-auto homeNav_items mt-2 mt-lg-0">
                    <li class="nav-item mr-2">
                        <a class="{{ isset($data['page_title']) && $data['page_title'] == 'Home' ? 'active' : '' }}"
                            href="{{ url('') }}"> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ isset($data['page_title']) && $data['page_title'] == 'Pricing' ? 'active' : '' }}"
                            href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('kinbo') }}">Demo</a>

                    </li>
                </ul>
                <ul class="my-2 my-lg-0 ml-auto d-flex gap-10 homeNav_actionBtn">
                    <li class="nav-item">
                        <a class="ci-register-btn" href="{{ url('register') }}"><i class="fas fa-user-plus"></i>
                            Register </a>
                    </li>
                    <li class="nav-item">
                        <a class="ci-login-btn " href="{{ url('login') }}"><i class="fas fa-sign-out-alt"></i>Login</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</div>
