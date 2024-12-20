@php
    use App\Calculation;
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h1 class="text-center">{{$subjects->sub_name}}</h1>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td style="width: 500px; background-color: #e6ffff;"><strong>Subject Name</strong></td>
                            <td style="background-color:#e6ffff">{{$subjects->sub_name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Obtained Percentage:</strong></td>
                            <td>{{ $totalObtainedPercentage }} %</td>
                        </tr>
                        <tr>
                            <td style="background-color:#e6ffff"><strong>Targeted Grade</strong></td>
                            <td style="background-color:#e6ffff">{{$subjects->target_grade}}</td>
                        </tr>
                        <tr>
                            <td><strong>Achieved Grade</strong></td>
                            <td>{{ $grade }}</td>
                        </tr>
                        <tr>
                            <td style="background-color:#e6ffff"><strong>Subject GPA</strong></td>
                            <td style="background-color:#e6ffff">{{ $gpa }}</td>
                        </tr>
                        <tr>
                            <td><strong>Remaining Marks Needed</strong></td>
                            <td>{{ $remainingMarksNeeded }} %</td>
                        </tr>
                        <tr class="text-center mt-3">
                            <td colspan="2" style="background-color:#e6ffff"><strong>Tips To Achieve The Target</strong>
                                <br>{!! $studyTips !!}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="ce_ixelgen_progress_bar block">
                                    <div class="progress_bar">
                                        <div class="progress_bar_item grid-x">
                                            <div class="item_label cell auto"><strong>Progress</strong></div>
                                            @if($remainingMarksNeeded == 'Congrats, You have achieved the target')
                                                <div class="item_value cell shrink">0%</div>
                                                <div class="item_bar cell">
                                                    <div class="progress" data-progress="100"></div>
                                                </div>
                                            @else
                                                <div class="item_value cell shrink">0%</div>
                                                <div class="item_bar cell">
                                                    <div class="progress" data-progress={{ $totalObtainedPercentage }}></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background-color:#e6ffff">
                                <div class="text-center mt-3">
                                    <strong>Claim Your Reward Here!</strong><br>
                                    @if($remainingMarksNeeded == 'Congrats, You have achieved the target')
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Reveal It!!!</button>
                                    @else
                                        <button type="button" class="btn btn-danger" disabled>Oops, You haven't reached your target.</button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="card position-relative">
                                <video class="position-absolute w-100 h-100" autoplay loop muted poster="{{ asset('promo.jpg') }}">
                                    <source src="{{ asset('party.mp4') }}" type="video/mp4"> Your browser does not support the video tag.
                                </video>
                                <div class="text-right cross position-absolute">
                                    <i class="fa fa-times"></i>
                                </div>
                                <div class="card-body text-center">
                                    <div class="card-inner">
                                        <img src="https://img.icons8.com/bubbles/200/000000/trophy.png" class="img-fluid my-3 mx-auto d-block">
                                        <h4>CONGRATULATIONS!</h4>
                                        <p>You have achieved your target! <br> Here is your GRAB PROMO CODE as a token of appreciation!</p>
                                        <img src="{{ asset('promo.jpg') }}" alt="Promo Image" class="img-fluid my-3 mx-auto d-block" style="width: 30%; height: auto;">
                                        <p>Promo Code: <b>HOTDEALS50</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </table>
            </div>
        </div>
        <div class="text-center mt-3">
            <a class="btn btn-warning" href="{{route('progress.index')}}">Back</a>
        </div>
    </div>
@endsection


