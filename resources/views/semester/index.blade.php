@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('success'))
            <h6 class="alert alert-success">
                {{ session('success') }}
            </h6>
        @endif
    <div class="container">
        <br>
        <h1 class= "text-center animate__animated animate__fadeIn" style="animation-delay: 0.2s; color: white ;">&#x1f4da;&#x1f4da;&#x1f4da; Select Your Program &#x1f4da;&#x1f4da;&#x1f4da;</h1>
        <h4 class= "text-center animate__animated animate__fadeIn" style="animation-delay: 0.2s; color: white ;">To View Semester</h4>
        <br><br>
        <a class="button1" href="{{ route('semester.create') }}">
            <b>Add New Semester</b>
        </a>
        <div class="row justify-content-center">
            <div class="col-md-3 text-center">
                <a href="{{ route('semester.show', ['semester' => Auth::id(), 'program' => 'Foundation']) }}" >
                    <img src="{{ asset('images/foundation.jpg') }}" alt="Foundation" class="img-fluid animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
                </a>
            </div>
            <div class="col-md-3 text-center">
                <a href="{{ route('semester.show', ['semester' => Auth::id(), 'program' => 'Diploma']) }}">
                    <img src="{{ asset('images/diploma.jpg') }}" alt="Diploma" class="img-fluid animate__animated animate__zoomIn" style="animation-delay: 0.6s;">
                </a>
            </div>
            <div class="col-md-3 text-center">
                <a href="{{ route('semester.show', ['semester' => Auth::id(), 'program' => 'Degree']) }}">
                    <img src="{{ asset('images/degree.jpg') }}" alt="Degree" class="img-fluid animate__animated animate__zoomIn" style="animation-delay: 0.8s;">
                </a>
            </div>
            <div class="col-md-3 text-center">
                <a href="{{ route('semester.show', ['semester' => Auth::id(), 'program' => 'Masters']) }}">
                    <img src="{{ asset('images/masters.jpg') }}" alt="Masters" class="img-fluid animate__animated animate__zoomIn" style="animation-delay: 1.0s;">
                </a>
            </div>
        </div>
    </div>

@endsection
