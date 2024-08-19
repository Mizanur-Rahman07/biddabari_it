<div class="col-md-4 col-sm-6 px-1">
    <div class="courses-item">
        <a href="{{ route('front.course-details', ['slug' => $course->slug, 'id' => $course->id]) }}">
            <img src="{{ asset(file_exists($course->banner) ? $course->banner : 'frontend/logo/biddabari-card-logo.jpg') }}"
                alt="Courses" class="w-100" style="height: 230px" />
        </a>
        <div class="content">
            <h3><a href="{{ route('front.course-details', ['slug' => $course->slug, 'id' => $course->id]) }}">{{ $course->title ?? 'Course Title' }}</a></h3>
            <ul class="course-list">
                {{-- <li><i class="ri-time-fill"></i> 06 hr</li>--}}
                <li><i class="ri-vidicon-fill"></i> {{ $course->total_note ?? 0 }} lectures</li>
                <li><i class="ri-file-pdf-line"></i> {{ $course->total_pdf ?? 0 }} PDF</li>
                <li><i class="ri-a-b"></i> {{ $course->total_exam ?? 0 }} Exam</li>
                <li><i class="ri-store-3-line"></i>{{ $course->total_live ?? 0 }} live class</li>
                <div class="dis-course-price">
                    @if($course->discount_type == 1 || $course->discount_type == 2)
                    <span class="course-price"> ৳ <del>{{ $course->price ?? 0 }} </del> </span>
                    <!--<span class="dis-course-amount">৳ {{ $course->discount_type == 1 ? $course->price - $course->discount_amount : ($course->price - ($course->price * $course->discount_amount)/100) }}</span>-->
                    <span class="dis-course-amount">৳ {{ $course->price-$course->discount_amount }}</span>
                    @else
                    <span class="dis-course-amount"> ৳ {{ $course->price ?? 0 }} </span>
                    @endif
                </div>
            </ul>


            <div class="custome_dis_course_price">
                @if($course->discount_type == 1 || $course->discount_type == 2)
                <span class="course-price"> ৳ <del>{{ $course->price ?? 0 }} </del> </span>
                <span class="dis-course-amount">৳ {{ $course->price-$course->discount_amount }}</span>
                @else
                <span class="dis-course-amount"> ৳ {{ $course->price ?? 0 }} </span>
                @endif
            </div>

            <div class="bottom-content">
                @if($course->order_status != 'true')
                <a href="{{ route('front.course-details', ['id' => $course->id, 'slug' => $course->slug]) }}"
                    class="btn btn-warning">বিস্তারিত দেখুন</a>
                @endif
                <div class="rating ">
                    @php
                        $date = date('Y-m-d H:i')
                    @endphp
                    @if($course->order_status == 'false')
                        @if($course->admission_last_date > $date)
                            <a href="{{ route('front.checkout', ['id' => $course->id, 'slug' => $course->slug]) }}"
                               class="btn btn-warning">কোর্সটি কিনুন</a>
                        @else
                            <a class="btn btn-warning">ভর্তির সময় শেষ</a>
                        @endif
                    @elseif($course->order_status == 'pending')
                    <a href="javascript:void(0)" class="text-warning">Pending</a>
                    @elseif($course->order_status == 'true')
                    <a href="javascript:void(0)" class="">Active</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
