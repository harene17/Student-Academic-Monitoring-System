@extends('layouts.app')
@section('content')
   <div class="userInput">
        <form method="POST" action="{{route('grading.store')}}">
            @csrf
                <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Add New Grade</b></h2>
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
                        <label class="col-sm-2 col-form-label">Program</label>
                        <div class="col-sm-10">
                            <select name="program" class="form-control" id="program" required>
                                <option value="Foundation">Foundation</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Degree">Degree</option>
                                <option value="Masters">Master's</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="startMark" class="col-sm-2 col-form-label">Start Mark</label>
                        <div class="col-sm-10">
                            <input type="text" name="startMark" class="form-control" id="startMark" placeholder="80" required>
                            @if ($errors->has('startMark'))
                                <span class="text-danger">{{ $errors->first('startMark') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="endMark" class="col-sm-2 col-form-label">End Mark</label>
                        <div class="col-sm-10">
                            <input type="text" name="endMark" class="form-control" id="endMark" placeholder="100" required>
                            @if ($errors->has('endMark'))
                                <span class="text-danger">{{ $errors->first('endMark') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                        <div class="col-sm-10">
                            <input type="text" name="grade" class="form-control" id="grade" placeholder="A+" required>
                            @if ($errors->has('grade'))
                                <span class="text-danger">{{ $errors->first('grade') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="gpa" class="col-sm-2 col-form-label">GPA</label>
                        <div class="col-sm-10">
                            <input type="text" name="gpa" class="form-control" id="gpa" placeholder="4.00" required>
                            @if ($errors->has('gpa'))
                                <span class="text-danger">{{ $errors->first('gpa') }}</span>
                            @endif
                        </div>
                    </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('grading.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection

