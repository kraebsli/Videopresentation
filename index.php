<?php /*Copyright (c) 2018 Kathrin Braungardt

This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

    Dieses Programm ist Freie Software: Sie können es unter den Bedingungen
   	der GNU General Public License, wie von der Free Software Foundation,
	Version 3 der Lizenz oder (nach Ihrer Wahl) jeder neueren
	veröffentlichten Version, weiterverbreiten und/oder modifizieren.

	Dieses Programm wird in der Hoffnung, dass es nützlich sein wird, aber
	OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
	Gewährleistung der MARKTFäHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
	Siehe die GNU General Public License für weitere Details.

    Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
    Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.


 */

if($_GET['open'])
{
	$open=$_GET['open'];
}
else {
	$open="true";
}
if($_GET['id'])
{
$id=$_GET['id'];
}
else 
{
$id=0;
}

if($id>0)
{
$id1=$id -1;
}
else 
{
	$id1=$id;
}

$xml_feed_url = "viewer.xml";
$daten = simplexml_load_file($xml_feed_url);
$title=$daten->presentationTitle;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"/> 
<title><?php echo $title;?></title>
<link rel="stylesheet" href="style.css"/>
<link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/5.19/video.min.js"></script>
<script>var open;</script>
<?php 

if(isset($open)){
	echo "<script>";
	echo "open=\"". $open . "\";";
	
}
else 
{
	echo "<script>";

	echo "open=\"true\";";
}
echo "</script>";
?>

<script>
function doOpen()
{
if(open=="true")
{
	 document.getElementById("mySidenav").style.width = "250px";
	    document.getElementById("main").style.marginLeft = "250px";
	    //Sdocument.getElementById("headline").style.marginLeft = "250px";
}
else if(open=="false")
{
	
	  document.getElementById("mySidenav").style.width = "0";
	    document.getElementById("main").style.marginLeft = "0";
	    document.getElementById("headline").style.marginLeft = "100px";
	    document.getElementById("headline").style.marginTop = "0";
}
else
{

	open="true";
}
}
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
   // document.getElementById("headline").style.marginLeft = "250px";
   open="true";

}
/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0px";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("headline").style.marginLeft = "100px";
    document.getElementById("headline").style.marginTop = "0";
    open="false";
}
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
</script>
</head>
<body onload="doOpen()">
<?php 
include 'slide.php';
$itemarray=array();
$n=0;
$i=0;
$t=0;
foreach ($daten->slides->slide as $item) {
	if($i>1)
	{
$videourl=$item->video['url'];
$videourl=str_replace(".flv", ".mp4", $videourl);
$slideurl="Slide" . $t .".PNG";
$t++;


$slidetitle=$item->slideTitle;

//echo "<br>";


$slideItem= new slide($n, $videourl, $slideurl, $slidetitle);
$itemarray[]=$slideItem;
$n++;
	}
$i++;
}
array_pop($itemarray);
$zahlItems=count($itemarray)-1;
if($id==$zahlItems)
{
	$id2=$id;
}
else 
{
$id2=$id +1;
}

?>
<div id="open"><span style="font-size:30px;cursor:pointer; width:10%;" onclick="loadpage_onclicks(<?php echo $id?>,'true')">&#9776; open</span></div>
<div id="main" style="margin-left: 0">
<?php /* if($open=="false")
{
	echo "style=\"marginLeft:0;\"";
}
	*/?>
	


<div id="title">
<div id="headline"> <?php echo $title; ?></div>
<h3><?php echo $itemarray[$id]->getTitle(); ?></h3>
<?php 
if($id!=="")
{
	$aktuellesvideo=$itemarray[$id]->getVideo();
	
	$aktuellesslide=$itemarray[$id]->getSlide();
	
}
?>
</div>
<div id="vidall">
<div id="video">
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
</div>
<div id="navsmall"><a href="javascript:void(0)"><img src="back.png" width="40px"; onclick="loadpage_onclick(<?php echo $id1?>)"></a><a href="javascript:void(0)"><img src="go.png" width="40px"; onclick="loadpage_onclick(<?php echo $id2?>)"></a></div>
</div>
<div id="slide">
<img src=<?php echo "\"slides/" . $aktuellesslide . "\""; ?>width="480px">
</div>
</div>



<?php 
if($open=="true")
{
echo "<div id=\"mySidenav\" class=\"sidenav\">";

 echo "<a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>";

	
  

if(count($itemarray)>0)
{
for($i=0; $i<count($itemarray); $i++)
{
	echo "<div id=\"sp2\">";
if($i==$id){
	echo "<span class=\"sp\">";
}
else 
{
echo "<a href=\"index.php?id=" . $i .  "\">";
}
$test=$itemarray[$i]->getTitle();
echo $i . " "; 
echo $test;
if($i==$id){
echo "</span>";
}
else 
{
	echo "</a>";
}
}
echo "</div>";
}//for
}//if
else {
	
	//echo "<a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"openNav()\">&times;</a>";
}
?>
</div>

<script type="text/javascript">
var player = videojs('my-player');
var options = {};

var player = videojs('my-player', options, function onPlayerReady() {
  videojs.log('Your player is ready!');

  // In this context, `this` is the player that was created by Video.js.
  this.play();

  // How about an event listener?
  this.on('ended', function() {
    videojs.log('Awww...over so soon?!');

    loadpage_onclick(<?php echo $id2?>);
  });
});
</script>
</body>
</html>