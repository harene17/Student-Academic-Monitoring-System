@extends('layouts.app')
@section('content')
    <div class="showTable" style="max-width: 750px;">
        @if(session('success'))
            <h6 class="alert alert-success">
                {{ session('success') }}
            </h6>
        @endif
        @if($semester->isEmpty())
            <div class="alert alert-danger">
                No semester found for the selected program. Please add semester
            </div>
        @endif
                <h1 style="text-align: center">List of Semesters for {{$program}}</h1><hr>

                @php($i=1)
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Program</th>
                        <th>Semester</th>
                        <th>Total Credit Hour</th>
                        <th>Targeted GPA</th>
                        <th>Action</th>
                    </tr>

                    @foreach($semester as $sem)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$sem->program}}</td>
                            <td>{{$sem->semester}}</td>
                            <td>{{$sem->total_credit_hr}}</td>
                            <td>{{$sem->target_gpa}}</td>

                            <td>
                                <a class="btn btn-warning" href="{{route('semester.edit', $sem->sem_id)}}">Edit</a> &nbsp;
                            </td>
                        </tr>
                    @endforeach
                </table>
            <div class="text-center mt-3">
                <a class="btn btn-warning" href="{{route('semester.index')}}">Back</a>
            </div>
            <br>
    </div>
@endsection
