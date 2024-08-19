<?php

namespace App\Http\Controllers\SpaFrontend\FreeCourses\ParentPage;

use App\Models\Backend\BatchExamManagement\BatchExam;
use App\Models\Backend\Course\Course;
use Livewire\Component;

class FreeCoursePage extends Component
{
    protected $courses = [];
    public function render()
    {
        $this->courses = Course::where('is_paid', 0)->whereStatus(1)->latest()->select('id','title','banner','slug')->get();

        return view('spa-frontend.free-courses.parent-page.free-course-page', ['courses'   => $this->courses]);
    }
}
