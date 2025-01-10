@extends('layouts.main')


@section('content')
    <section>
        <div class="ccd-profile">
            <div class="container page--width">
                <h1 class="page--head">Account</h1>
                <!-- Profile  -->
                <div class="profile__wrap">
                    <!-- accordion -->
                    <div class="profile__accordion accordion">
                        <details open>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Orders
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <p>You haven't placed any orders yet.</p>

                                <div class="ccd--orders">
                                    <ul class="order__lists">
                                        <li class="order__list">
                                            <a href="{{ url('view-order') }}" class="order__list-link">
                                                <div class="order__list-pic">
                                                    <img src="images/b7.jpg" alt="product-image"
                                                        class="img-fluid order__list-img" width="100" height="100"
                                                        loading="lazy">
                                                </div>
                                                <div class="order__list-info">
                                                    <div class="order__list-title">
                                                        OrderID : ccd_12345
                                                    </div>
                                                    <div class="order__list-date">
                                                        Placed on Jan 15, 2023
                                                    </div>
                                                    <div class="order__list-status">
                                                        <span class="badge text-bg-danger">
                                                            Pending
                                                        </span>
                                                    </div>
                                                    <div class="order__list-total">
                                                        Rs. 1999
                                                    </div>
                                                </div>
                                                <div class="order__list-icon">
                                                    <i class="fa-solid fa-angle-right icon"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="order__list">
                                            <a href="{{ url('view-order') }}" class="order__list-link">
                                                <div class="order__list-pic">
                                                    <img src="images/b6.jpg" alt="product-image"
                                                        class="img-fluid order__list-img" width="100" height="100"
                                                        loading="lazy">
                                                </div>
                                                <div class="order__list-info">
                                                    <div class="order__list-title">
                                                        OrderID : ccd_12345
                                                    </div>
                                                    <div class="order__list-date">
                                                        Placed on Jan 15, 2023
                                                    </div>
                                                    <div class="order__list-status">
                                                        <span class="badge text-bg-danger">
                                                            Pending
                                                        </span>
                                                    </div>
                                                    <div class="order__list-total">
                                                        Rs. 1999
                                                    </div>
                                                </div>
                                                <div class="order__list-icon">
                                                    <i class="fa-solid fa-angle-right icon"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="order__list">
                                            <a href="{{ url('view-order') }}" class="order__list-link">
                                                <div class="order__list-pic">
                                                    <img src="images/b8.jpg" alt="product-image"
                                                        class="img-fluid order__list-img" width="100" height="100"
                                                        loading="lazy">
                                                </div>
                                                <div class="order__list-info">
                                                    <div class="order__list-title">
                                                        OrderID : ccd_12345
                                                    </div>
                                                    <div class="order__list-date">
                                                        Placed on Jan 15, 2023
                                                    </div>
                                                    <div class="order__list-status">
                                                        <span class="badge text-bg-success">
                                                            delivered
                                                        </span>
                                                    </div>
                                                    <div class="order__list-total">
                                                        Rs. 1999
                                                    </div>
                                                </div>
                                                <div class="order__list-icon">
                                                    <i class="fa-solid fa-angle-right icon"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </details>
                    </div>

                    <div class="profile__accordion accordion">
                        <details>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-user-check"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Profile
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <div class="profile__block">
                                    <div class="row justify-content-center px-3 px-sm-0">
                                        <div class="col-lg-6 col-md-10 col-12">
                                            <div>
                                                <form id="updateProfileForm">

                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="name@example.com"
                                                            value="{{ auth()->user()->name }}" required>
                                                        <label for="name">Name</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="name@example.com"
                                                            value="{{ auth()->user()->email }}">
                                                        <label for="email">Email address</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="mobile"
                                                            placeholder="name@example.com"
                                                            value="{{ auth()->user()->mobile }}">
                                                        <label for="mobile">mobile</label>
                                                    </div>

                                                    <div class="custom-acc__btns my-4 text-center">
                                                        <button type="submit" class="btn-main">Update Profile</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </details>
                    </div>

                    <div class="profile__accordion accordion">
                        <details>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-user-check"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Change Password
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <div class="profile__block">
                                    <div class="row justify-content-center px-3 px-sm-0">
                                        <div class="col-lg-6 col-md-10 col-12">
                                            <div>
                                                <form id="updatePasswordForm">

                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="old_pass"
                                                            placeholder="name@example.com">
                                                        <label for="old_pass">Old Password</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="new_pass"
                                                            placeholder="name@example.com">
                                                        <label for="new_pass">New Password</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="confirm_pass"
                                                            placeholder="name@example.com">
                                                        <label for="conform_pass">Confirm New Password</label>
                                                    </div>

                                                    <div class="custom-acc__btns my-4 text-center">
                                                        <button type="submit" class="btn-main">Update Password</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </details>
                    </div>


                    <div class="profile__accordion accordion">
                        <details>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Track Order
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <div class="row justify-content-center px-3 px-sm-0">
                                    <div class="col-lg-6 col-md-10 col-12">
                                        <div>

                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com" value="78997">
                                                <label for="floatingInput">Order ID</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com" value="56756756">
                                                <label for="floatingInput">Mobile Number</label>
                                            </div>

                                            <div class="custom-acc__btns my-4 text-center">
                                                <button class="btn-main">Search Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </details>
                    </div>
                    <!-- accordion END -->
                </div>
                <!-- Profile END -->


            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // update user profile
            $('#updateProfileForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission
                let isValid = true;

                // Clear previous error messages
                $('.error-message').text('');

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

                // If all fields are valid, submit the form or proceed with AJAX
                if (isValid) {

                    $.ajax({
                        url: '/update-profile',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                            name: name,
                            email: email,
                            mobile: mobile,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $.Toast("Hooray!", "Profile updated successfully", "success", {
                                    timeout: 6000,
                                    has_progress: true,
                                });
                                // Optionally update the form dynamically
                                $('#name').val(response.data.name);
                                $('#email').val(response.data.email);
                                $('#mobile').val(response.data.mobile);
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

            // update user password
            $('#updatePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let isValid = true;

                // Validate old password (not empty)
                const oldPass = $('#old_pass').val().trim();
                
                
                if (!oldPass) {
                  console.log(oldPass);
                    $.Toast("Oops!", "Old password cannot be empty", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate new password (minimum 6 characters)
                const newPass = $('#new_pass').val().trim();
                if (!newPass) {
                    $.Toast("Oops!", "New password cannot be empty", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                } else if (newPass.length < 6) {
                    $.Toast("Oops!", "New password must be at least 6 characters", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate confirm password (must match new password)
                const confirmPass = $('#confirm_pass').val().trim();
                if (!confirmPass) {
                    $.Toast("Oops!", "Confirm password cannot be empty", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                } else if (confirmPass !== newPass) {
                    $.Toast("Oops!", "Passwords do not match.", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                

                // If all fields are valid, submit the form (e.g., via AJAX)
                if (isValid) {

                    $.ajax({
                        url: '/update-password',
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            oldPass: oldPass,
                            newPass: newPass,
                            confirmPass: confirmPass,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $.Toast("Hooray!", response.message, "success", {
                                    timeout: 6000,
                                    has_progress: true,
                                });
                                $('#updatePasswordForm')[0].reset();
    
                            }else{
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
