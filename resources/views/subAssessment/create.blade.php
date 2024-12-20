@extends('layouts.app')
@section('content')
    <div class="userInput">
        <form method="POST" action="{{ route('subAssessment.store', ['subject_id' => $subject->sub_id]) }}">
            @csrf
            <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Add New Sub Assessment</b></h2>
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
                            <input type="text" id="sub_name" name="sub_name" value="{{ $subject->sub_name }}" readonly size="53" style="color: black">
                            <input type="hidden" name="subject_id" value="{{ $subject->sub_id }}">
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="assessment_id" class="col-sm-2 col-form-label">Assessment Name</label>
                        <div class="col-sm-10">
                            <select name="assessment_id" class="form-control" id="assessment_id" required>
                                @foreach($assessments as $a)
                                    <option value="{{ $a->assessment_id}}">{{ $a->assessmentName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="subAssessmentName" class="col-sm-2 col-form-label">Sub Assessment Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="subAssessmentName" class="form-control" id="subAssessmentName" placeholder="Quiz 1" required>
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="total_mark" class="col-sm-2 col-form-label">Total Mark</label>
                        <div class="col-sm-10">
                            <input type="text" name="total_mark" class="form-control" id="total_mark" placeholder="20" required>
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="obtained_mark" class="col-sm-2 col-form-label">Obtained Mark</label>
                        <div class="col-sm-10">
                            <input type="text" name="obtained_mark" class="form-control" id="obtained_mark" placeholder="15" required>
                        </div>
                    </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('subject.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection

