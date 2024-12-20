@extends('layouts.app')
@section('content')
    <div class="userInput">
        <form method="POST" action="{{route('subAssessment.update', $subAssessments->SubAssessment_id)}}">
            @method('PATCH')
            @csrf
            <input type="hidden" name="SubAssessment_id" value="{{ $subAssessments->SubAssessment_id }}">
                <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Update Sub Assessment</b></h2>
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
                            <input type="text" id="sub_name" name="sub_name" value="{{ $subjects->sub_name }}" readonly size="53" style="color: black">
                            <input type="hidden" name="subject_id" value="{{ $subjects->sub_id }}">
                        </div>
                    </div>
                <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Assessment Name</label>
                        <div class="col-sm-10">
                            <input type="text" id="assessmentName" name="assessmentName" value="{{ $assessments->assessmentName }}" readonly size="53" style="color: black">
                            <input type="hidden" name="assessmentName" value="{{ $assessments->assessment_id }}">
                        </div>
                </div>
                <div class="form-group  row mb-3">
                    <label for="subAssessmentName" class="col-sm-2 col-form-label">Sub Assessment Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="subAssessmentName" class="form-control" id="subAssessmentName" value="{{ $subAssessments->subAssessmentName}}">
                    </div>
                </div>
                <div class="form-group  row mb-3">
                    <label for="total_mark" class="col-sm-2 col-form-label">Total Mark</label>
                    <div class="col-sm-10">
                        <input type="text" name="total_mark" class="form-control" id="total_mark" value="{{ $subAssessments->total_mark}}">
                    </div>
                </div>
                <div class="form-group  row mb-3">
                    <label for="obtained_mark" class="col-sm-2 col-form-label">Obtained Mark</label>
                    <div class="col-sm-10">
                        <input type="text" name="obtained_mark" class="form-control" id="obtained_mark" value="{{ $subAssessments->obtained_mark}}">
                    </div>
                </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('subject.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection

