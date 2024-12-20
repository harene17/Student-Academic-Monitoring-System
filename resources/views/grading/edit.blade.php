@extends('layouts.app')
@section('content')
    <div class="userInput">
        <form method="POST" action="{{route('grading.update', $gradingSchemes->grade_id)}}">
            @method('PATCH')
            @csrf
            <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Edit Grading Here</b></h2>
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
                    <div class="form-group  row mb-3">
                        <label class="col-sm-2 col-form-label">Program</label>
                        <div class="col-sm-10">
                            <select name="program" class="form-control" id="program">
                                <option value="Foundation"{{ $gradingSchemes->program === 'Foundation' ? 'selected' : '' }}>Foundation</option>
                                <option value="Diploma"{{ $gradingSchemes->program === 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Degree"{{ $gradingSchemes->program === 'Degree' ? 'selected' : '' }}>Degree</option>
                                <option value="Masters"{{ $gradingSchemes->program === 'Masters' ? 'selected' : '' }}>Master's</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="startMark" class="col-sm-2 col-form-label">Start Mark</label>
                        <div class="col-sm-10">
                            <input type="text" name="startMark" class="form-control" id="startMark" value="{{ $gradingSchemes->startMark}}">
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="endMark" class="col-sm-2 col-form-label">End Mark</label>
                        <div class="col-sm-10">
                            <input type="text" name="endMark" class="form-control" id="endMark" value="{{ $gradingSchemes->endMark}}">
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                        <div class="col-sm-10">
                            <input type="text" name="grade" class="form-control" id="grade" value="{{ $gradingSchemes->grade}}">
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="gpa" class="col-sm-2 col-form-label">GPA</label>
                        <div class="col-sm-10">
                            <input type="text" name="gpa" class="form-control" id="gpa" value="{{ $gradingSchemes->gpa}}">
                        </div>
                    </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('grading.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection