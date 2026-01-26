@extends('Frontend.master')
@section('content')
 <div class="breadcrumb-section" data-background="{{asset('frontend')}}/assets/images/57U8bXGi1705124911.png">
        <div class="container">
            <div class="row breadcrumb-rows">
                <div class="col-lg-7">
                    <div class="breadcrumb-content wow fadeInLeft">
                        <h2 class="pt-20 breadcrumb-header">Privacy Policy</h2>
                        <h5><a href="{{route('frontend')}}"class="text-white">Home></a></h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="contact-us-section">
        @foreach ($priavacypolicy as $item)
        <div class="container">
            <div class="contact-us-section-header wow fadeInUp" data-wow-delay="0.1s">
                <h6>{{$item->title ?? ''}}</h6>
            </div>
            <div class="term-content wow fadeInUp" data-wow-delay="0.2s">
                <p>{{$item->description ?? ''}}</p>
            </div>

        </div>
        @endforeach
    </div>
@endsection
