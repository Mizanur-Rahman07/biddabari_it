// check content types in show content pages
$(function () {
    var contentParentSelectorDiv = $('#contentShowParentDiv');
    var contentType = contentParentSelectorDiv.attr('data-content-type');

    if (contentType == 'video')
    {
        var videoVendor = contentParentSelectorDiv.attr('data-video-vendor');
        var videoLink = contentParentSelectorDiv.attr('data-video-link');
        if (videoVendor == 'youtube')
        {
            var videoUrl = $('.youtube').attr('data-yt-link');
            $("#video").empty().aksVideoPlayer({
                file: [
                    {
                        file: videoUrl,
                        label: "1080p"
                    },
                    {
                        file: videoUrl,
                        label: "720p"
                    },
                    {
                        file: videoUrl,
                        label: "540p"
                    },
                    {
                        file: videoUrl,
                        label: "360p"
                    },
                    {
                        file: videoUrl,
                        label: "240p"
                    }
                ],
                // width: $(this).parent().height(),
                height: $(this).parent().width(),
                poster: "",
            });
        } else if (videoVendor == 'vimeo')
        {
            $('#vimeoPlayer').attr('src', 'https://player.vimeo.com/video/'+videoLink+'?h=627084a88d&autoplay=0&loop=1&title=0&byline=0&portrait=0');
        } else if (videoVendor == 'private')
        {
            $('#privatVid').attr('src', videoLink);
        }
    } else if (contentType == 'pdf')
    {
        var pdfLink = BASE_URL+contentParentSelectorDiv.attr('data-pdf-link');
        var pdfDownload = contentParentSelectorDiv.attr('data-pdf-download');
        console.log('pdflink- '+pdfLink);
        console.log('pdfdownload- '+pdfDownload);
        $('#pdf-container').empty().pdfViewer(pdfLink);
        if (pdfDownload == "1")
        {
            $('#pdfDownloadLink').attr('href', pdflink).html('Download Now').attr('class', 'btn btn-success btn-sm float-end me-4 mt-2');
        } else {
            $('#pdfDownloadLink').attr('href', '').html('').attr('class', '');
        }
    }
})
