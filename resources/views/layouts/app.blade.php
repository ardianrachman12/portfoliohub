<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Freelancer - Start Bootstrap Theme</title>
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
