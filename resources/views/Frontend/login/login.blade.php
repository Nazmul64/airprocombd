@extends('Frontend.master')

@section('content')
<div class="login-section">
    <div class="container">
        <div class="row login-rows">
            <div class="col-lg-6">
                <div class="login-img-main">
                    <img src="{{ asset('frontend') }}/assets/images/D1I2tyHJ1704876360.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 form-section">
                <div class="login-form-main">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('frontend') }}/assets/images/WrK86hHx1659607850.png" alt="logo" />
                        </a>
                    </div>
                    <h4>Turn Your ideas into Reality</h4>

                    <div class="login-form-area">
                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" id="email" placeholder="Enter Your Email" class="form-control" name="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-2 position-relative">
                                <label class="form-label" for="password">Your Password</label>
                                <input type="password" id="password" placeholder="Enter Your password" name="password" class="form-control">
                                <span class="toggle-password" onclick="togglePassword('password')" style="position:absolute; right:10px; top:38px; cursor:pointer;">👁️</span>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col d-flex ">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked>
                                        <label class="form-check-label" for="form2Example31">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-end login-forgot">
                                    <!-- Simple link -->
                                    <a href="{{ route('password.forget') }}">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="form-btn primary-btn-forms btn-forms mb-4">
                                Sign in <div class="spinner-border formSpin" role="status"></div>
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
                        <p class="sign-up-option">Don't have an account? <a class="sign-up" href="{{ route('register') }}">
                            Create an account</a>
                        </p>
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
    field.type = field.type === "password" ? "text" : "password";
}
</script>
@endsection
