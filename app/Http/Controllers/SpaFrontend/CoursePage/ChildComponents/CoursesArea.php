<?php

namespace App\Http\Controllers\SpaFrontend\CoursePage\ChildComponents;

use App\Models\Backend\Course\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CoursesArea extends Component
{
    use WithPagination;

    public function render()
    {
        return view('spa-frontend.course-page.child-components.courses-area', [
            'courses'   => Course::where([ 'status' => 1])->latest()->select('id', 'title', 'price', 'banner', 'total_class','total_video', 'total_note', 'slug', 'admission_last_date')->with(['courseCategories' => function ($courseCategories) {
                $courseCategories->select('id', 'name')->get();
            }])->paginate(9),
        ]);
    }
}
