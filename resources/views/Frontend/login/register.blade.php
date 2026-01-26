@extends('Frontend.master')

@section('content')
<div class="login-section">
    <div class="container">
        <div class="row login-rows">
            <div class="col-lg-6">
                <div class="login-img">
                    <img src="{{ asset('frontend') }}/assets/images/D1I2tyHJ1704876360.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 form-section">
                <div class="login-form">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('frontend') }}/assets/images/WrK86hHx1659607850.png" alt="logo" />
                        </a>
                    </div>
                    <h4>Create Your Account</h4>
                    <div class="login-form-area">
                        <form action="{{ route('register.submit') }}" method="POST" class="form" novalidate>
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Your Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="username">User Name</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="User Name" value="{{ old('username') }}">
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="phone">Phone Number</label>
                                <div class="input-group">
                                    <input type="tel" name="phone" id="phone" placeholder="Phone" class="form-control" value="{{ old('phone') }}">
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="ref_code">Referral Code</label>
                                <div class="input-group">
                                    <input type="text" name="ref_code" id="ref_code" placeholder="Optional" class="form-control" value="{{ old('ref_code', request('ref')) }}">
                                    @error('ref_code')<span class="error-msg">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-2 position-relative">
                                <label class="form-label" for="password">Your Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <span class="toggle-password" onclick="togglePassword('password')" style="position:absolute; right:10px; top:38px; cursor:pointer;">👁️</span>
                                @error('password')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-outline mb-2 position-relative">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" name="password_confirmation" class="form-control">
                                <span class="toggle-password" onclick="togglePassword('confirm-password')" style="position:absolute; right:10px; top:38px; cursor:pointer;">👁️</span>
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col d-flex ">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="termes" checked>
                                        <label class="form-check-label" for="termes">
                                            <a href="{{ route('termsconditions') }}" class="link">Terms & Conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="form-btn primary-btn-forms btn-forms mb-4">
                                Create Account <div class="spinner-border formSpin" role="status"></div>
                            </button>

                            <div class="position-absolute w-full">
                                <div class="alert alert-success alert-dismissible fade show" style="display: none;">
                                    <p class="m-0 text-success"></p>
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                                    <p class="m-0 text-danger"></p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="social-icon-section">
                        <p class="sign-up-option">Already you have an account in here? <a class="sign-up" href="{{ route('user.login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password toggle script -->
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}
</script>
@endsection
