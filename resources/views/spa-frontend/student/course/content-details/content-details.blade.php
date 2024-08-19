<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="f-s-22">{{ $content->title ?? 'title' }}</p>
                </div>
                <div class="card-body p-0" id="contentShowParentDiv" data-content-type="{{ $content->content_type }}" data-video-vendor="{{ $contentType == 'video' ? $content->video_vendor : '' }}" data-video-link="{{ $contentType == 'video' ? $content->video_link : '' }}" data-pdf-link="{{ $content->content_type == 'pdf' ? ($content->pdf_link != null ? $content->pdf_link : $content->pdf_file) : '' }}" data-pdf-download="{{ $content->content_type == 'pdf' ? $content->can_download_pdf  : 0 }}">
                    @if($contentType == 'videos')
                        @if($content->video_vendor == 'private')
                        <div class="private ">
                            <video class="w-100 video" height="500" controls="controls" controlist="nodownload">
                                <source id="privatVid" src="//samplelib.com/lib/preview/mp4/sample-5s.mp4" type="video/mp4">
                            </video>
                        </div>
                        @elseif($content->video_vendor == 'youtube')
                        <div class="youtube " data-yt-link="{{ $content->yt_vid_link ?? '' }}" >
                            <div class="video-container video_mobile_res" >
                                <div class="video-foreground">

                                    <div id="video"></div>

{{--                                    <video class="w-100 video" height="500" controls="controls" controlist="nodownload">--}}
{{--                                        <source id="" src="//samplelib.com/lib/preview/mp4/sample-5s.mp4" type="video/mp4">--}}
{{--                                    </video>--}}

                                </div>
                            </div>


                        </div>
                        @elseif($content->video_vendor == 'vimeo')
                        <div class="vimeo ">
                            <div style="padding:56.25% 0 0 0;position:relative;">
                                <iframe id="vimeoPlayer" src="" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        @else
                        <div class="mt-4">
                            <div id="videoCommentDiv">

                            </div>
                        </div>
                        @endif
                    @elseif($contentType = 'notes')
                        <div class="px-3 pb-5">
                            {!! $content->note_content !!}
                        </div>
                    @elseif($contentType == 'pdfs')
                        <div>
                            <div class=" p-0" id="pdfContentPrintDiv">
                                <div class="row">
                                    <div class="col-12">
                                        <p>
                                            <a href="" class="float-end" download id="pdfDownloadLink"></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="my-box px-3 mx-auto mt-5" >
                                    <div id="pdf-container"></div>
                                </div>
                            </div>
                        </div>
                    @elseif($contentType == 'assignments')
                        <div>
                            <div class="mt-3">
                                <p>Done Your assignment? Submit Your Answers Now</p>
                                <form action="{{ route('front.student.upload-assignment-files') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_content_id" value="{{ $content->id }}">
                                    <div class="row">
                                        <label for="">Upload Files</label>
                                        <input type="file" name="files[]" class="float-start" multiple accept="image/*" />
                                    </div>
                                    <input type="submit" class="btn btn-success float-start mt-3 btn-sm" value="Upload"/>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


