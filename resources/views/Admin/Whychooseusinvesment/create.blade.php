@extends('Admin.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>কেন আমাদের ইনভেস্টমেন্ট নির্বাচন করবেন</h4>
            <a href="{{ route('whychooseusinvesment.index') }}" class="btn btn-success">পেছনে যান</a>
        </div>
        <div class="card-body">
            <form action="{{ route('whychooseusinvesment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- শিরোনাম -->
                <div class="mb-3">
                    <label for="title" class="form-label">শিরোনাম (এটি শুধু একবার ব্যবহার করবেন)</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="শিরোনাম লিখুন" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- বর্ণনা -->
                <div class="mb-3">
                    <label for="description" class="form-label">বর্ণনা (এটি শুধু একবার ব্যবহার করবেন)</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="বর্ণনা লিখুন">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- আইকন -->
                <div class="mb-3">
                    <label for="icon" class="form-label">আইকন</label>
                    <textarea name="icon" id="icon" class="form-control" rows="2" placeholder="আইকন HTML লিখুন (যেমন: &lt;i class='fas fa-user-circle'&gt;&lt;/i&gt;)">{{ old('icon') }}</textarea>
                    @error('icon')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- মেইন শিরোনাম -->
                <div class="mb-3">
                    <label for="main_title" class="form-label">মূল শিরোনাম</label>
                    <input type="text" name="main_title" id="main_title" class="form-control" placeholder="মূল শিরোনাম লিখুন" value="{{ old('main_title') }}">
                    @error('main_title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- মেইন বর্ণনা -->
                <div class="mb-3">
                    <label for="main_description" class="form-label">মূল বর্ণনা</label>
                    <textarea name="main_description" id="main_description" class="form-control" rows="4" placeholder="মূল বর্ণনা লিখুন">{{ old('main_description') }}</textarea>
                    @error('main_description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- স্ট্যাটাস -->
                <div class="mb-3">
                    <label for="status" class="form-label">স্ট্যাটাস</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>একটিভ</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>ইনঅ্যাকটিভ</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- সাবমিট বাটন -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">সেভ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
