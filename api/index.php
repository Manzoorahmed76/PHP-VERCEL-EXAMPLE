<?php
function xnxxDownload($url) {
    $html = file_get_contents($url);
    if (!$html) {
        return [
            'status' => false,
            'message' => 'Failed to load video page.'
        ];
    }

    // Extract metadata using regex
    preg_match("/html5player.setVideoUrlLow\\('(.*?)'\\);/", $html, $low);
    preg_match("/html5player.setVideoUrlHigh\\('(.*?)'\\);/", $html, $high);
    preg_match("/html5player.setThumbUrl\\('(.*?)'\\);/", $html, $thumb);
    preg_match("/html5player.setThumbUrl169\\('(.*?)'\\);/", $html, $thumb69);
    preg_match("/html5player.setThumbSlide\\('(.*?)'\\);/", $html, $thumbSlide);
    preg_match("/html5player.setThumbSlideBig\\('(.*?)'\\);/", $html, $thumbSlideBig);

    preg_match('/property="og:title" content="(.*?)"/', $html, $title);
    preg_match('/property="og:image" content="(.*?)"/', $html, $image);
    preg_match('/property="og:duration" content="(.*?)"/', $html, $duration);

    return [
        'status' => true,
        'title' => $title[1] ?? '',
        'duration' => $duration[1] ?? '',
        'thumbnail' => $image[1] ?? '',
        'download_links' => [
            'low_quality' => $low[1] ?? '',
            'high_quality' => $high[1] ?? '',
        ],
        'thumbnails' => [
            'default' => $thumb[1] ?? '',
            'wide' => $thumb69[1] ?? '',
            'slide' => $thumbSlide[1] ?? '',
            'slide_hd' => $thumbSlideBig[1] ?? '',
        ]
    ];
}

// Output the result
if (isset($_GET['url'])) {
    $videoUrl = $_GET['url'];
    $result = xnxxDownload($videoUrl);
    header('Content-Type: application/json');
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
    echo json_encode([
        'status' => false,
        'message' => 'Please provide a video URL using ?url=https://www.xnxx.com/video...'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
?>
