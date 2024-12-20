@extends('layouts.app')
@section('content')
    <div class="userInput">
        <form method="POST" action="{{route('subject.store')}}">
            @csrf
            <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Add New Subject</b></h2>
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
                        <label class="col-sm-2 col-form-label">Semester and Program</label>
                        <div class="col-sm-10">
                            <select name="semester_program" id="semester_program" class="form-control">
                                @foreach($sem as $semester)
                                    <option value="{{ $semester->sem_id }}_{{ $semester->program }}">{{ $semester->semester }} - {{ $semester->program }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="sub_name" class="col-sm-2 col-form-label">Subject Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="sub_name" class="form-control" id="sub_name" placeholder="Statistics" required>
                            @if ($errors->has('sub_name'))
                                <span class="text-danger">{{ $errors->first('sub_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="total_credit_hr" class="col-sm-2 col-form-label">Total Credit Hour</label>
                        <div class="col-sm-10">
                            <input type="text" name="total_credit_hr" class="form-control" id="total_credit_hr" placeholder="4" required>
                            @if ($errors->has('total_credit_hr'))
                                <span class="text-danger">{{ $errors->first('total_credit_hr') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="target_grade" class="col-sm-2 col-form-label">Target Grade</label>
                        <div class="col-sm-10">
                            <input type="text" name="target_grade" class="form-control" id="target_grade" placeholder="A+" required>
                            @if ($errors->has('target_grade'))
                                <span class="text-danger">{{ $errors->first('target_grade') }}</span>
                            @endif
                        </div>
                    </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('subject.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection

