<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RoyalUI Admin</title>
    @include('admin.layout.partials.style')
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            @include('admin.layout.partials.alerts')
                            <div class="brand-logo">
                                <a href="/">
                                    <img src="{{ asset('logo/logo.jpeg') }}" alt="logo">
                                </a>
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" action="{{ route('auth.registerStore') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id=""
                                        placeholder="Fullname" name="name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id=""
                                        placeholder="Username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id=""
                                        placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id=""
                                        placeholder="No Whatsapp format = 628xxx" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="password" required>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN UP
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="/login" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.layout.partials.script')
</body>

</html>
