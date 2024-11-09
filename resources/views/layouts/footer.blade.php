<!-- Contact Section-->
<section class="page-section" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contact Me</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" action="{{ route('sendWhatsapp', $data->id) }}" method="POST" target="_blank">
                    @csrf
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" type="text" placeholder="Enter your name..."
                            data-sb-validations="required" name="name" required />
                        <label for="name">Full name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" placeholder="name@example.com"
                            data-sb-validations="required,email" name="email" required />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.
                        </div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <!-- Phone number input-->
                    {{-- <div class="form-floating mb-3">
                        <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890"
                            data-sb-validations="required" />
                        <label for="phone">Phone number</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is
                            required.</div>
                    </div> --}}
                    <!-- Message input-->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..."
                            style="height: 10rem" data-sb-validations="required" name="message" required></textarea>
                        <label for="message">Message</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    {{-- <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a
                                href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div> --}}
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3">Error sending message!</div>
                    </div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send via Whatsapp</button>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">My Location</h4>
                <p class="lead mb-0">
                    {{ $profiling->district }}, {{ $profiling->subdistrict }},
                    <br />
                    {{ $value_regency_title }}, {{ $value_province_title }}, {{ $profiling->postal_code }}
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">My Social Media</h4>
                @php
                    use Illuminate\Support\Str;

                    $socialLinks = $profiling->links ?? [];
                @endphp

                @foreach ($socialLinks as $index => $link)
                    @php
                        $externalLink =
                            $link !== null
                                ? (Str::startsWith($link, ['http://', 'https://'])
                                    ? $link
                                    : 'http://' . $link)
                                : '#';

                        $socialIcon = '';

                        switch ($index) {
                            case 0:
                                $socialIcon = 'fa-facebook-f';
                                break;
                            case 1:
                                $socialIcon = 'fa-instagram';
                                break;
                            case 2:
                                $socialIcon = 'fa-linkedin-in';
                                break;
                            case 3:
                                $socialIcon = 'fa-github';
                                break;
                            // Add more cases if needed
                        }
                    @endphp

                    <a class="btn btn-outline-light btn-social mx-1"
                        @if ($link !== null) target="_blank" href="{{ $externalLink }}" @endif>
                        <i class="fab fa-fw {{ $socialIcon }}"></i>
                    </a>
                @endforeach

                {{-- <a class="btn btn-outline-light btn-social mx-1"
                    @if ($link[0] === null) href="#" @else href="{{ $link[0] }}" @endif
                    target="_blank">
                    <i class="fab fa-fw fa-facebook-f"></i>
                </a>
                <a class="btn btn-outline-light btn-social mx-1"
                    @if ($link[1] === null) href="#" @else href="{{ $link[1] }}" @endif
                    target="_blank">
                    <i class="fab fa-fw fa-instagram"></i>
                </a>
                <a class="btn btn-outline-light btn-social mx-1"
                    @if ($link[2] === null) href="#" @else href="{{ $link[2] }}" @endif
                    target="_blank">
                    <i class="fab fa-fw fa-linkedin-in"></i>
                </a>
                <a class="btn btn-outline-light btn-social mx-1"
                    @if ($link[3] === null) href="#" @else href="{{ $link[3] }}" @endif
                    target="_blank">
                    <i class="fab fa-fw fa-github"></i>
                </a> --}}
            </div>

            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">About Website</h4>
                <p class="lead mb-0">
                    Website ini dapat anda gunakan untuk membuat
                    portofolio yang menarik dan reflektif tentang kemampuan dan pencapaian anda. Semua ini untuk
                    membantu anda memamerkan karya terbaik anda secara online.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright &copy; Portfoliohub.my.id 2024</small></div>
</div>
