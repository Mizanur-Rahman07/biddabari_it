<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <!-- ============================ Page Title Start================================== -->
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="breadcrumbs-wrap">
                        <h1 class="breadcrumb-title">Free Courses</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 bg-white">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" wire:navigate>Home</a></li>
                                <li class="breadcrumb-item active theme-cl" aria-current="page">Free Courses</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="courses-area-two section-bg py-5">
        <div class="container">
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-md-4 col-sm-6 px-0 border shadow">
                        <div class="card card-body ">
                            <a href="{{ route('course.details', ['id' => $course->id, 'slug' => $course->slug]) }}" wire:navigate >
                                <img src="{{ file_exists($course->banner) ? asset($course->banner) : asset('frontend/logo/biddabari-card-logo.jpg') }}" alt="Courses" class="w-100" style="height: 230px"/>

                                <div class="content">
                                    <h3>{{ $course->title }}</h3>
                                    <div class="bottom-content ">
                                        <button type="button" class="btn btn-warning">বিস্তারিত দেখুন</button>
                                        <div class="rating float-right">
                                            <button type="button" class="btn btn-warning">Free</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card card-body">
                            <h2 class="text-center">No Courses Available yet.</h2>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
