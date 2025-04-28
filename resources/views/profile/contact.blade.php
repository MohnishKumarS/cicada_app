@extends('layouts.main')


@section('content')
    {{-- contact info --}}
    <section class="pb-0">
        <h1 class="text-center page--head">Contact Us </h1>
        <div class="container page--width">
            <div class="ccd-cinfo">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <div class="ccd-cinfo_text text-center">
                            <div class="ccd-cinfo_icon">
                                <img width="70" height="70" src="{{ asset('images/common/mail.png') }}"
                                    alt="mail" />
                            </div>
                            <h3 class="ccd-cinfo_title">Email</h3>
                            <p class="ccd-cinfo_desc">cicadapeoplesneed@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <div class="ccd-cinfo_text text-center">
                            <div class="ccd-cinfo_icon">
                                <img width="70" height="70" src="{{ asset('images/common/phone.png') }}"
                                    alt="mobile" />
                            </div>
                            <h3 class="ccd-cinfo_title">Phone</h3>
                            <p class="ccd-cinfo_desc">91+ 6384044807</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="ccd-cinfo_text text-center">
                            <div class="ccd-cinfo_icon">
                                <img width="70" height="70" src="{{ asset('images/common/location.png') }}"
                                    alt="address" />
                            </div>
                            <h3 class="ccd-cinfo_title">Address</h3>
                            <p class="ccd-cinfo_desc">21, dasd adasd ,asdsd ,chennai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us -->
    <section>
        <div class="custom-acc">
            <div class="container">
                <div class="row justify-content-center px-3 px-sm-0">
                    <div class="col-lg-10 col-md-10 col-12">
                        <div>
                            <form id="contactForm">
                                <h1 class="custom-acc__head page--head">Get in touch!</h1>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="name"
                                                placeholder="name@example.com">
                                            <label for="name">Name</label>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="mobile" maxlength="10"
                                                placeholder="name@example.com">
                                            <label for="mobile">Phone No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="email"
                                        placeholder="name@example.com">
                                    <label for="email">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="message" style="height: 100px"></textarea>
                                    <label for="message">Comments</label>
                                </div>

                                <div class="custom-acc__btns text-center">
                                    <button class="btn-main" type="submit">Enquiry Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* contact info */
        .ccd-cinfo {
            .ccd-cinfo_title {
                font-size: 24px;
                font-weight: 600;
                margin-top: 15px;
            }

            .ccd-cinfo_desc {
                font-size: 16px;
                color: #D2D3D5;
            }

            @media (max-width:768px) {
                .ccd-cinfo_icon img {
                    width: 50px;
                    height: 50px;
                }
            }
        }
    </style>
@endpush


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let isValid = true;


                // Validate name field
                const name = $('#name').val().trim();
                if (name.length < 3 || name.length > 50) {
                    $.Toast("Oops!", "Name must be between 3 and 50 characters", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }



                // Validate mobile field
                const mobile = $('#mobile').val().trim();
                const mobileRegex = /^\d{10}$/; // Exactly 10 digits
                if (!mobileRegex.test(mobile)) {
                    $.Toast("Oops!", "Please enter a valid 10-digit mobile number", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate email field
                const email = $('#email').val().trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
                if (!emailRegex.test(email)) {
                    $.Toast("Oops!", "Please enter a valid email address", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                const message = $('#message').val().trim();

                // If all fields are valid, submit the form or proceed with AJAX
                if (isValid) {

                    $.ajax({
                        url: '/contact/store',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: name,
                            email: email,
                            mobile: mobile,
                            message: message,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $.Toast("Hooray!",
                                    "Your enquiry has been submitted successfully",
                                    "success", {
                                        timeout: 6000,
                                        has_progress: true,
                                    });
                                $('#contactForm')[0].reset();

                            } else {
                                $.Toast("Oops!", response.message, "error", {
                                    timeout: 6000,
                                    has_progress: true,
                                });

                            }
                        },
                        error: function(xhr) {
                            // alert('Error: ' + xhr.responseJSON.message);
                            $.Toast("Oops!", 'something went wrong!', "error", {
                                timeout: 6000,
                                has_progress: true,
                            });
                        },
                    });
                }
            });
        });
    </script>
@endpush
