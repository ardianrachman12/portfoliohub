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
    <title>PortfolioHub | Home</title>
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
        <!-- partial:partials/_navbar.html -->
        @include('admin.layout.partials.navbar')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('admin.layout.partials.sidebar')

            <!-- partial -->
            <!-- main-panel start -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('admin.layout.partials.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('admin.layout.partials.script')
</body>

</html>
