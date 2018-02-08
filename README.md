# Videopresentation-Converter-Adobe-Presenter-to-HTML5
Flash based Adobe presenter audio or video presentations can be converted to an HTML 5 interface


1) modify path in index.php
function loadpage_onclick(i) 
{

    window.location.href = ".../index.php?id="+i+"&open="+open;
}
function loadpage_onclicks(i,o) 
{

    window.location.href = ".../index.php?id="+i+"&open="+o;
}
function gobackpage_onclick(i) 
{

    window.location.href = ".../index.php?id="-i;
}

2) modify slideurl and videourl/audiourl if necessary

$videourl=str_replace(".flv", ".mp4", $videourl);
or $videourl=$item->audios->media['url'];
$slideurl="Slide" . $t .".PNG";

3) modify counters if necessary
$i=0;
$t=0;

4) modify videojs source (https://videojs.com/) if necessary
<link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/5.19/video.min.js"></script>

5) create two folders
- slides
- videos

6) put xml source file in the main directory

7) modify audio/video javascript code

audio:
<video
width="320"
    id="my-player"
    class="video-js"
    controls
    preload="auto"
    poster="//vjs.zencdn.net/v/oceans.png"
    data-setup='{}'>
 
 <source src=<?php echo "\"videos/" . $aktuellesvideo . "\""; ?> type='audio/mp3' />
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
    <a href="http://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video
    </a>
  </p>
</video>

video:
<video
width="320"
    id="my-player"
    class="video-js"
    controls
    preload="auto"
    poster="//vjs.zencdn.net/v/oceans.png"
    data-setup='{}'>
 
 <source src=<?php echo "\"videos/" . $aktuellesvideo . "\""; ?> type='video/mp4' />
  <p class="vjs-no-js">
    To view this video please enable JavaScript, and consider upgrading to a
    web browser that
    <a href="http://videojs.com/html5-video-support/" target="_blank">
      supports HTML5 video
    </a>
  </p>
</video>

8) convert flv files to mp4 files

9) convert .swf files to .png files
