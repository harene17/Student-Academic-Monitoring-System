@extends('layouts.app')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Hey, {{ Auth::user()->name }} &#128075;</h2><br>
                    <h2 class="animate__animated animate__fadeInDown">Welcome to <br>Student Academic Monitoring System</h2>
                    <p class="animate__animated animate__fadeInUp">Keep Track Your Progress and Succeed In Academic !!!
                        <br> All The Best !!! </p>

                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Grading Scheme</h2>
                    <p class="animate__animated animate__fadeInUp"><p>
                        Before start to track your progress,
                        <br><br>Step 1<br>
                        Let's set a grading scheme based on your university.
                        <br><br><b>Enter start mark, end mark, grade and gpa here.</b>
                    </p>
                    <a href="{{route('grading.index')}}" class="btn-get-started animate__animated animate__fadeInUp">Grading Scheme</a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Semester</h2>
                    <p class="animate__animated animate__fadeInUp"><p>
                        Step 2<br>
                        It's time to complete your semester details.
                        <br>Click the button below or click 'Semesters' from the menu.
                    </p>
                    <a href="{{route('semester.index')}}" class="btn-get-started animate__animated animate__fadeInUp">Semester</a>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Subject</h2>
                    <p class="animate__animated animate__fadeInUp"><p>
                        Step 3<br>
                        Here is the place to enter your subject info along with assessment and sub assessments
                    </p>
                    <a href="{{route('subject.index')}}" class="btn-get-started animate__animated animate__fadeInUp">Subjects</a>
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="carousel-item">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">Progress</h2>
                    <p class="animate__animated animate__fadeInUp"><p>
                        Step 4<br>
                        Now let's monitor your progress :)<br>
                        It's time to achieve your target !!!
                    </p>
                    <a href="{{route('progress.index')}}" class="btn-get-started animate__animated animate__fadeInUp">Progress</a>
                </div>
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
            </a>
        </div>
    </section><!-- End Hero -->
@endsection
