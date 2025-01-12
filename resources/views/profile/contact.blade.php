@extends('layouts.main')


@section('content')
    <!-- contact us -->
    <section>
        <div class="custom-acc">
            <div class="container">
                <div class="row justify-content-center px-3 px-sm-0">
                    <div class="col-lg-10 col-md-10 col-12">
                        <div>
                            <form id="contactForm">
                                <h1 class="custom-acc__head page--head">Contact Us</h1>
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
