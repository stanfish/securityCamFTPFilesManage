<?php

	$dir= "/home/fishcam/files/";


	$start=$_POST['start'];
	$fileList=$_POST['fileList'];
	$fileList = explode(",", $fileList);

	echo '<a href="index.php?start='.$start.'">Back</a> <p>';

	foreach ($fileList as $value) {
		$path=$dir.$value;
		if (is_file($path))
		{
		    if (unlink($path)) { 
		        echo ("Deleted ") . $path . "<br>";
		    } else {
		        echo ("cannoot delete ") . $path . "<br>";
		    }
		}
	}



	echo '<meta http-equiv="refresh" content="1; url=index.php?start='.$start.'" />';

	echo '<p><a href="index.php?start='.$start.'">Back</a>';



	header('location: index.php?start='.$start);

?>
