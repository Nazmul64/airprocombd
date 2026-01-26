@extends('Frontend.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Reset Password</h4>
                </div>
                <div class="card-body">

                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.reset.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{ old('email', $email ?? '') }}" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required>
                            <span class="toggle-password" onclick="togglePassword('password')" style="position:absolute; right:10px; top:38px; cursor:pointer;">👁️</span>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm new password" required>
                            <span class="toggle-password" onclick="togglePassword('password_confirmation')" style="position:absolute; right:10px; top:38px; cursor:pointer;">👁️</span>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>

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
