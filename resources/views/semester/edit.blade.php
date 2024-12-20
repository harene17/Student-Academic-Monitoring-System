@extends('layouts.app')
@section('content')
    <div class="userInput">
        <form method="POST" action="{{route('semester.update', $semester->sem_id)}}">
            @method('PATCH')
            @csrf
            <h2 style="font-family: 'Comic Sans MS', 'Comic Sans', cursive; text-align: center"><b>Edit Semester Details Here !!!</b></h2>
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
                            <option value="Foundation"{{ $semester->program === 'Foundation' ? 'selected' : '' }}>Foundation</option>
                            <option value="Diploma"{{ $semester->program === 'Diploma' ? 'selected' : '' }}>Diploma</option>
                            <option value="Degree"{{ $semester->program === 'Degree' ? 'selected' : '' }}>Degree</option>
                            <option value="Masters"{{ $semester->program === 'Masters' ? 'selected' : '' }}>Master's</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-10">
                            <input type="text" name="semester" class="form-control" id="semester" value="{{ $semester->semester}}">
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="total_credit_hr" class="col-sm-2 col-form-label">Total Credit Hour</label>
                        <div class="col-sm-10">
                            <input type="text" name="total_credit_hr" class="form-control" id="total_credit_hr" value="{{ $semester->total_credit_hr}}">
                        </div>
                    </div>
                    <div class="form-group  row mb-3">
                        <label for="target_gpa" class="col-sm-2 col-form-label">Target GPA</label>
                        <div class="col-sm-10">
                            <input type="text" name="target_gpa" class="form-control" id="target_gpa" value="{{ $semester->target_gpa}}">
                        </div>
                    </div>
            <div class="text-center">
                <a class="btn btn-warning " href="{{route('semester.index')}}">Back</a>
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </form>
    </div>
@endsection

