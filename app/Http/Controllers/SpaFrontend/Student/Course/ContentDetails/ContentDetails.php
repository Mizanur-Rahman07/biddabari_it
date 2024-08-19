<?php

namespace App\Http\Controllers\SpaFrontend\Student\Course\ContentDetails;

use App\Models\Backend\Course\CourseSectionContent;
use GuzzleHttp\Client;
use Livewire\Component;

class ContentDetails extends Component
{
    public $contentType, $contentId, $slug = null, $content;

    public function mount($contentType, $contentId, $slug = null)
    {
        $this->contentType  = $contentType;
        $this->contentId  = $contentId;
        $this->slug = $slug;
    }

    public function render()
    {
        $this->content  = CourseSectionContent::query()->where('id', $this->contentId);
        if ($this->contentType == 'videos')
        {
            $this->content = $this->content->select('course_section_contents.id', 'course_section_id', 'parent_id', 'course_section_contents.title', 'content_type', 'video_link', 'video_vendor')->get();
        } elseif ($this->contentType == 'pdfs')
        {
            $this->content = $this->content->select('course_section_contents.id', 'course_section_id', 'parent_id', 'course_section_contents.title', 'content_type', 'pdf_link', 'pdf_file')->get();
        } elseif ($this->contentType == 'notes')
        {
            $this->content = $this->content->select('course_section_contents.id', 'course_section_id', 'parent_id', 'course_section_contents.title', 'content_type', 'note_content')->get();
        } elseif ($this->contentType == 'assignments')
        {
            $this->content = $this->content->select('course_section_contents.id', 'course_section_id', 'parent_id', 'course_section_contents.title', 'content_type', 'assignment_question', 'assignment_instruction', 'assignment_total_mark', 'assignment_pass_mark', 'assignment_start_time', 'assignment_start_time_timestamp', 'assignment_end_time', 'assignment_end_time_timestamp', 'assignment_result_publish_time', 'assignment_result_publish_time_timestamp')->get();
        }
        $this->content = $this->content->first();
//        return $this->content;
        if ($this->contentType == 'videos')
        {
            if ($this->content)
            {
                if ($this->content->content_type == 'video')
                {
                    if ($this->content->video_vendor == 'youtube')
                    {
                        $videoLink = $this->content->video_vendor == 'youtube' ? explode('https://www.youtube.com/watch?v=', $this->content->video_link)[1] : $this->content->video_link;
//                        $client = new Client(['verify' => 'C:\Users\Mainul Islam\Downloads\cacert.pem']);
                        $client = new Client(['verify' => false]);

                        $body = $client->request('GET', 'https://ytstream-download-youtube-videos.p.rapidapi.com/dl?id='.$videoLink, [
                            'headers'   => [
                                'x-rapidapi-host' => env('X_RAPIDAPI_HOST'),
                                'x-rapidapi-key' => env('X_RAPIDAPI_KEY'),
                            ]
                        ]);
                         $getBody    = json_decode($body->getBody()->getContents());

                        if ($getBody->status == "OK" && $getBody->id == $videoLink)
                        {
                            foreach ($getBody->formats as $key => $format) {
                                if ($format->itag == "22")
                                {
                                    $this->content['yt_vid_link']  = $format->url;

                                }
                            }
                        }

                    }
                }
            }
        }
        return view('spa-frontend.student.course.content-details.content-details', [
            'contentType'   => $this->contentType,
            'content'       => $this->content
        ])->layout('spa-frontend.student-master');
    }
}
