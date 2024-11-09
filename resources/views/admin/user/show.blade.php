@extends('layouts.app')
@section('title', $data->username)
@section('content')
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <div class="image-avatar mb-4">
                @if ($profiling && $profiling->avatar)
                    <img src="/uploads/avatar/{{ $profiling->avatar }}" alt="">
                @else
                    <img src="{{ asset('logo/profile-default.webp') }}" alt="">
                @endif
            </div>
            {{-- <img class="masthead-avatar mb-5" src="{{asset('template-home/assets/img/avataaars.svg')}}" alt="..." /> --}}
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">{{ $data->name }}</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">
                @if (isset($profiling->jobs[0]))
                    {{ $profiling->jobs[0] }}
                @endif -
                @if (isset($profiling->jobs[1]))
                    {{ $profiling->jobs[1] }}
                @endif -
                @if (isset($profiling->jobs[2]))
                    {{ $profiling->jobs[2] }}
                @endif
            </p>
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Portfolio</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                @foreach ($projects as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="portfolio-item mx-auto ratio ratio-16x9 " data-bs-toggle="modal"
                            data-bs-target="#portfolioModal{{ $loop->iteration }}">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i
                                        class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="/uploads/{{ $item->image[0] }}" alt="..."
                                style="object-fit: cover; width: 100%; height: 100%;" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="page-section portfolio" id="certificate">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Certificate</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                @foreach ($certificates as $item)
                    <div class="col-md-4 col-lg-3 mb-5">
                        <div class="portfolio-item mx-auto ratio ratio-16x9 " data-bs-toggle="modal"
                            data-bs-target="#certificateModal{{ $loop->iteration }}">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i
                                        class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="/uploads/{{ $item->image[0] }}" alt="..."
                                style="object-fit: cover; width: 100%; height: 100%;" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">Profile</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            {{-- <div class="row"> --}}
            <div class="col-lg-8 m-auto mb-4">
                <p class="text-center" style="font-size: 20px;">{{ $profiling->description }}</p>
            </div>
            <!-- About Section Button-->
            <div class="text-center">
                <a class="btn btn-xl btn-outline-light" href="/register">
                    <i class="fas fa-edit me-2"></i>
                    Create Your Website Now
                </a>
            </div>
        </div>
    </section>
    <!-- Portfolio Modals-->
    @foreach ($projects as $item)
        <div class="portfolio-modal modal fade" id="portfolioModal{{ $loop->iteration }}" tabindex="-1"
            aria-labelledby="portfolioModal{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">
                                        {{ $item->title }}
                                    </h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- slider image portfolio-->
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($item->image as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img class="d-block" src="/uploads/{{ $image }}"
                                                        alt="..." width="100%">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Portfolio Modal - Text-->
                                    <div class="mt-4">
                                        <p>{{ $item->deskripsi }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ strpos($item->url, 'http://') === 0 || strpos($item->url, 'https://') === 0 ? $item->url : 'http://' . $item->url }}"
                                            target="_blank">
                                            <button class="btn btn-info d-block w-100">Go to site</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Certificate Modals-->
    @foreach ($certificates as $item)
        <div class="portfolio-modal modal fade" id="certificateModal{{ $loop->iteration }}" tabindex="-1"
            aria-labelledby="certificateModal{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">
                                        {{ $item->title }}
                                    </h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <!-- slider image portfolio-->
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($item->image as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img class="d-block" src="/uploads/{{ $image }}"
                                                        alt="..." width="100%">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Portfolio Modal - Text-->
                                    <div class="mt-4">
                                        <p>{{ $item->deskripsi }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ strpos($item->url, 'http://') === 0 || strpos($item->url, 'https://') === 0 ? $item->url : 'http://' . $item->url }}"
                                            target="_blank">
                                            <button class="btn btn-info d-block w-100">Go to site</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
