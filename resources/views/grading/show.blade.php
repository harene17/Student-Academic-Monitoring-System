@extends('layouts.app')
@section('content')
    <div class="showTable">
        @if(session('success'))
            <h6 class="alert alert-success">
                {{ session('success') }}
            </h6>
        @endif
        @if($gradingSchemes->isEmpty())
            <div class="alert alert-danger">
                No grading scheme found for the selected program. Please add grading scheme.
            </div>
        @endif

                <h1 style="text-align: center">{{$program}}</h1><hr>
                @php($i=1)
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Start Mark</th>
                        <th>End Mark</th>
                        <th>Grade</th>
                        <th>GPA</th>
                        <th style="padding-left: 40px;">Action</th>
                    </tr>
                    @foreach($gradingSchemes as $grading)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$grading->startMark}}</td>
                            <td>{{$grading->endMark}}</td>
                            <td>{{$grading->grade}}</td>
                            <td>{{$grading->gpa}}</td>

                            <td>
                                <form action="{{route('grading.destroy',$grading->grade_id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-warning" href="{{route('grading.edit', $grading->grade_id)}}">Edit</a> &nbsp;
                                    <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Confirm DELETE?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            <div class="text-center mt-3">
                <a class="btn btn-warning" href="{{route('grading.index')}}">Back</a>
            </div>
            <br>
    </div>
@endsection
