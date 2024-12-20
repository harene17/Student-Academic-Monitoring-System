@extends('layouts.app')
@section('content')
    <div class="userInput">
        <form method="POST" action="{{ route('assessment.update', $assessments->assessment_id) }}">
            @method('PATCH')
            @csrf
            <input type="hidden" name="assessment_id" value="{{ $assessments->assessment_id }}">
            <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Update Assessment</b></h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Subject Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="sub_name" name="sub_name" value="{{ $subjects->sub_name }}" style="color: black;" size="53">
                            <input type="hidden" name="subject_id" value="{{ $subjects->sub_id }}">
                        </div>
                    </div>
                <div class="form-group  row mb-3">
                    <label for="assessmentName" class="col-sm-2 col-form-label">Assessment Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="assessmentName" class="form-control" id="assessmentName" value="{{ $assessments->assessmentName}}">
                    </div>
                </div>
                <div class="form-group  row mb-3">
                    <label for="total_percentage" class="col-sm-2 col-form-label">Total Percentage</label>
                    <div class="col-sm-10">
                        <input type="text" name="total_percentage" class="form-control" id="total_percentage" value="{{ $assessments->total_percentage}}">
                    </div>
                </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('subject.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection

