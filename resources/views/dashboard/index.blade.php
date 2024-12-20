@php
    use App\Calculation;
@endphp
@extends('layouts.app')

@section('content')
    <div class="containerDashboard">
        <div class="card mb-3" style="background-color: #e6ffff; border: black 4px solid; box-shadow: 0 4px 8px rgba(255, 0, 0, 0.8); transition: box-shadow 0.8s ease-in-out, border-color 0.8s ease-in-out;">
        <div class="card-body">
        <form method="GET" action="{{ route('dashboard.index') }}">
            @csrf
                <div class="card-header" style="text-align: center">Welcome to Your Dashboard !!! </div><br>
                <!--<div class="card-body">-->
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label" style="font-size: 18px;"><b>Semester and Program</b></label>
                        <div class="col-sm-10">
                            <select name="semester_program" id="semester_program" class="form-control">
                                @foreach($semesters as $semester)
                                    <option value="{{ $semester->sem_id }}_{{ $semester->program }}" {{ (isset($selectedSemesterId) && $selectedSemesterId == $semester->sem_id) && (isset($selectedProgram) && $selectedProgram == $semester->program) ? 'selected' : '' }}>
                                        {{ $semester->semester }} - {{ $semester->program }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
        </form>

       <!-- <div class="card-body">
            <div class="form-group row mb-3">-->

            @if(!empty($subjects))
               <!-- <div class="container">-->
                    <div class="chart">
                        @foreach($subjects as $subject)
                            <div>
                                <h3 class="animate__animated animate__zoomIn" style="animation-delay: 0.4s; color:#900C3F ; font-family: 'Comic Sans MS', 'Comic Sans', cursive;"><b>{{ $subject->sub_name }}</b></h3>
                                <canvas id="chart-{{ $subject->sub_id }}"></canvas>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            @foreach($subjects as $subject)
            var ctx = document.getElementById('chart-{{ $subject->sub_id }}').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($subject->assessments->pluck('assessmentName')),
                    datasets: [{
                        label: 'Total Percentage',
                        data: @json($subject->assessments->pluck('total_percentage')),
                        backgroundColor: 'red'
                    }, {
                        label: 'Obtained Percentage',
                        data: [
                            @foreach($subject->assessments as $assessment)
                                {{ Calculation::calculateObtainedPercentage($assessment->assessment_id, $assessment->subject_id) }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(255, 153, 0, 1)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Percentage'
                            },
                            grid: {
                                display: false // Hide the x-axis grid lines
                            }
                        },
                        x: {
                            grid: {
                                display: false // Hide the x-axis grid lines
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                afterTitle: function(context) {
                                    return 'Subject: {{ $subject->sub_name }}';
                                }
                            }
                        }
                    }
                }
            });
            @endforeach
        });
    </script>
@endsection

