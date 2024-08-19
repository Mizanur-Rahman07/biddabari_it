<?php

namespace App\Http\Controllers\SpaFrontend\NoticePage\ParentPage;

use App\Models\Backend\NoticeManagement\Notice;
use Livewire\Component;

class NoticePage extends Component
{
    protected $notices = [], $data = [];
    public function render()
    {
        $this->notices = Notice::whereStatus(1)->whereType('normal')->latest()->select('id', 'notice_category_id','title', 'image', 'type', 'body')->take(6)->get();
        foreach ($this->notices as $notice)
        {
            $notice->image = asset($notice->image);
        }
        $this->data = [
            'notices'    => $this->notices,
//            'singleNotice'  => isset($_GET['notice-id']) ? Notice::find($_GET['notice-id']) : ''
        ];
        return view('spa-frontend.notice-page.parent-page.notice-page', $this->data);
    }
}
