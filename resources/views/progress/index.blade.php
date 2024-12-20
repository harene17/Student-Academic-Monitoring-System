@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="container">
            <form method="GET" action="{{ route('progress.index') }}">
                @csrf
                <div class="form-group row">
                    <label for="semester_program" class="col-form-label" style="color: whitesmoke; "><b>Select Semester and Program Here</b></label>
                    <div class="col-auto">
                        <select name="semester_program" id="semester_program" class="form-control custom-dropdown">
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->sem_id }}_{{ $semester->program }}">{{ $semester->semester }} - {{ $semester->program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>
            </form>

        </div>
            <br>
            <div class="container">
                    <div class="card-body">
                        @php($i=1)
                        <div class="row">
                            @foreach($subjects as $sub)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="progress-body">
                                        <div class="card-body animate__animated animate__zoomIn">
                                            <h5 class="card-title"><b>{{ $sub->sub_name }}</b></h5>
                                            <p class="card-text">
                                                <strong>Program:</strong> {{ $sub->program }}<br>
                                                <strong>Semester:</strong> {{ $sub->semesters ? $sub->semesters->semester : 'N/A' }}<br>
                                                <strong>Targeted Grade:</strong> {{ $sub->target_grade }}
                                            </p>
                                            <button class="continue-application">
                                                <div>
                                                    <div class="pencil"></div>
                                                    <div class="folder">
                                                        <div class="top">
                                                            <svg viewBox="0 0 24 27">
                                                                <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="paper"></div>
                                                    </div>
                                                </div>
                                            <a href="{{ route('progress.show', ['subjects' => $sub->sub_id]) }}">
                                                <b>View Progress</b>
                                            </a>
                                            </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="progress-body" style="color: black;"><br>
                            <h6><b>Targeted GPA: {{ $targetGPA }}</b></h6>
                            <h6><b>Current GPA: {{ $currentGPA }}</b></h6>
                            <br>
                        </div>
                    </div>
                </div>
@endsection
