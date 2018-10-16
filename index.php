<!DOCTYPE html> 
<html>
<head>
<meta name=viewport content="width=device-width, initial-scale=1">
<title>Photos</title>
<?php
function variable_check($input_check){
	if(isset($input_check)){
		if (ctype_alnum(str_replace("/","",$input_check))){
			return $input_check;
		}else{
			header('location: /?p=pages/404');
		}
	}else{
		return NULL;
	}
}

$images_find = array();
$count = 0;
foreach (glob("photos/*.jpg") as $filename) {
	$images_find[] = $filename;
	$count++;
}
$index = $count;

$index_num = variable_check($_GET['index']);

if (isset($index_num)){
	if ($index_num > $count){
	} else { 
		$index = $index_num;
	}
}else{
	$index = $count;
}
?>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="wrapper">
	<div id="content">
<div id="header">
<div class="headerleft">
	<span class="instamike">photos-title</span>
</div>
<div class="headerright">
<?php

if ($index > 20){
$next = $index - 5;
}else{
$next = 5;
}

if ($index < $count){
	$prev = $index + 5;
}else if($index >= $count){
	$prev = $count;
}

$menu = $index;

if ($menu < $count){
	echo "<span class='pages'><a href='index.php?index=" . $prev . "'>Prev</a></span>";
	echo "<span class='pages'><a href='index.php?index=" . $count . "'>Home</a></span>";
} else{
	echo "<span class='pagesnot'>Prev</span>";
	echo "<span class='pagesnot'>Home</span>";
}
if ($menu > 5){
	echo "<span class='pages'><a href='index.php?index=" . $next . "'>Next</a></span>";
}else{
	echo "<span class='pagesnot'>Next</span>";
}
?>
</div>
<div class="clearshit"></div>
</div>
<?php
if (file_exists("nav.txt") == 1){
	echo '<div id="nav">';
	include 'nav.txt';
	echo '</div>';
}
?>
</div>
<?php

$total = $index - 5; #must bring down total so index can drop to the same number as total, counting down
if ($index > 0){
	while ($index > $total){
		if (file_exists("photos/" . $index . ".jpg") == "True") {
			$exif_data = exif_read_data("photos/" . $index . ".jpg");
			$edate = date("Y-m-d", strtotime($exif_data['DateTimeOriginal']));
			echo "<div class='images'><img src='photos/" . $index . ".jpg' alt='" . $index ."'> <h2><span>" . $edate . '  <a href="photos/' . $index . '.jpg"> #' . $index ."</a> </span></h2></div>";
		}
	$index--;
}
}
?>
<div class="pagnation">
<span class="subtitle">All images copyright photos.yakamo.org, 2016.</span>

<?php
if ($menu < $count){
	echo "<span class='pages'><a href='index.php?index=" . $prev . "'>Prev</a></span>";
	echo "<span class='pages'><a href='index.php?index=" . $count . "'>Home</a></span>";
} else{
	echo "<span class='pagesnot'>Prev</span>";
	echo "<span class='pagesnot'>Home</span>";	
}
if ($menu > 10){
	echo "<span class='pages'><a href='index.php?index=" . $next . "'>Next</a></span>";
}else{
	echo "<span class='pagesnot'>Next</span>";
}
?>

</div>
	</div>
</div>
</body>
</html>
