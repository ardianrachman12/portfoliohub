<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta Description -->
    <meta name="description"
        content="PortfolioHub adalah platform untuk menampilkan portofolio profesional Anda. Buat dan bagikan karya terbaik Anda dengan dunia.">
    <!-- Meta Keywords -->
    <meta name="keywords"
        content="portfolio, PortfolioHub, showcase, professional portfolio, karya, desain, fotografi, seni, programming, web development, creative work">
    <!-- Meta Author -->
    <meta name="author" content="PortfolioHub Team">
    <title>PortfolioHub | Register</title>
    @include('admin.layout.partials.style')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HP91T7P72D"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-HP91T7P72D');
    </script>
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
                                        placeholder="Fullname" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="" 
                                        placeholder="Username" name="username" value="{{ old('username') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="" 
                                        placeholder="Email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="" 
                                        placeholder="No Whatsapp format = 628xxx" name="phone" value="{{ old('phone') }}" required>
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
