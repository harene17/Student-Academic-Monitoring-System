@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('success'))
            <h6 class="alert alert-success">
                {{ session('success') }}
            </h6>
        @endif

        <div class="container">
            <form method="GET" action="{{ route('subject.index') }}"> <!-- Use GET method -->
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
            <br>
            <a class="button1" href="{{ route('subject.create') }}">
                <b>Add New Subject</b>
            </a>
        </div>

            <!--<div class="container">-->
              <!--  <div class="card-body">-->
                    @php($i=1)
                    <div class="row">
                        @foreach($subjects as $sub)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="subject-body">
                                        <div class="card-body animate__animated animate__zoomIn">
                                            <h5 class="card-title" style="font-family: 'Comic Sans MS', 'Comic Sans', cursive;"><b>{{ $sub->sub_name }}</b></h5>
                                            <p class="card-text">
                                                <strong>Program:</strong> {{ $sub->program }}<br>
                                                <strong>Semester:</strong> {{ $sub->semesters ? $sub->semesters->semester : 'N/A' }}<br>
                                                <strong>Targeted Grade:</strong> {{ $sub->target_grade }}
                                            </p>
                                            <form action="{{route('subject.destroy',$sub->sub_id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="btn btn-info" href="{{route('subject.show', $sub->sub_id)}}">Details</a> &nbsp;
                                                <a class="btn btn-warning" href="{{route('subject.edit', $sub->sub_id)}}">Edit</a> &nbsp;
                                                <a class="btn btn-success" href="{{ route('assessment.create', ['subject_id' => $sub->sub_id]) }}">Add Assessment</a><br><br>
                                                <a class="btn btn-dark" href="{{route('subAssessment.create', ['subject_id' => $sub->sub_id])}}">Add Sub Assessment</a> &nbsp;
                                                <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Confirm DELETE?')">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
@endsection
