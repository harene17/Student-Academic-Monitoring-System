@php
use App\Calculation;
@endphp
@extends('layouts.app')
@section('content')
      <div class="container">
          <div class="card">
              <div class="card-header"><h1>{{$subjects->sub_name}}</h1></div>
              <div class="card-body">
                  <table class ='table table-striped'>
                      <tr>
                          <td>Program</td>
                          <td>{{$subjects->program }}</td>
                      </tr>
                      <tr>
                          <td>Semester</td>
                          <td>{{$subjects->semesters ? $subjects->semesters->semester : 'N/A' }}</td>
                      </tr>
                      <tr>
                          <td>Subject Name</td>
                          <td>{{$subjects->sub_name}}</td>
                      </tr>
                      <tr>
                          <td>Total Credit Hour</td>
                          <td>{{$subjects->total_credit_hr}}</td>
                      </tr>
                      <tr>
                          <td>Targeted Grade</td>
                          <td>{{$subjects->target_grade}}</td>
                      </tr>
                      <tr>
                          <td>Assessments</td>
                          <td>
                              <table class="table table-bordered">
                                @foreach($assessments as $assessment)
                                    <tr>
                                        <th colspan="4"><b style="color: darkblue; font-size: 20px;" >{{$assessment->assessmentName}} </b>&nbsp; <a style="font-size: 20px;" href="{{route('assessment.edit', ['assessment' => $assessment->assessment_id, 'subject_id' => $subjects->sub_id])}}">&#128393;</a>
                                            <br>Total Percentage: {{$assessment->total_percentage}} %
                                            <br>Obtained percentage: {{ Calculation::calculateObtainedPercentage($assessment->assessment_id, $assessment->subject_id) }} % <br>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Sub Assessment</th>
                                        <th>Total Mark</th>
                                        <th>Obtained Mark</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($assessment->subAssessments ?? [] as $subAssessment)
                                        <tr>
                                            <td>{{$subAssessment->subAssessmentName}}</td>
                                            <td>{{$subAssessment->total_mark}}</td>
                                            <td>{{$subAssessment->obtained_mark}}</td>
                                            <td>
                                                <form action="{{ route('subAssessment.destroy', ['subAssessment' => $subAssessment->SubAssessment_id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-info" href="{{route('subAssessment.edit', ['subAssessment' => $subAssessment->SubAssessment_id])}}">Edit</a> &nbsp;
                                                    <input class="btn btn-danger" type="submit" value="Delete" onclick="return confirm('Confirm DELETE?')">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center mt-3">
            <a class="btn btn-warning" href="{{route('subject.index')}}">Back</a>
        </div>
    </div>
@endsection
