<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Meta Description -->
    <meta name="description"
        content="PortfolioHub adalah platform untuk menampilkan portofolio profesional Anda. Buat dan bagikan karya terbaik Anda dengan dunia.">
    <!-- Meta Keywords -->
    <meta name="keywords"
        content="portfolio, PortfolioHub, showcase, professional portfolio, karya, desain, fotografi, seni, programming, web development, creative work">
    <!-- Meta Author -->
    <meta name="author" content="PortfolioHub Team">
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
    <title>PortfolioHub | @yield('title')</title>
    @include('layouts.style')
</head>

<body id="page-top">
    <!-- Navigation-->
    @include('layouts.navbar')
    @yield('content')
    <!-- Footer-->
    @include('layouts.footer')
    @include('layouts.scripts')
</body>

</html>
