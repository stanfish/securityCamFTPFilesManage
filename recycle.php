<?php

	$dir= "/home/fishcam/files/";
	$newDir= "/home/fishcam/backfiles/";


	$start=$_POST['start'];
	$fileList=$_POST['fileList'];
	$fileList = explode(",", $fileList);

	echo '<a href="index.php?start='.$start.'">Back</a> <p>';

	foreach ($fileList as $value) {
		$path=$dir.$value;
		$newPath=$newDir.$value;
		if (is_file($path))
		{
			if (rename($path, $newPath)){
		        echo ("Moved ") . $path . "<br>";
		    } else {
		        echo ("cannoot move ") . $path . "<br>";
		    }
		}
	}

	echo '<p><a href="index.php?start='.$start.'">Back</a>';

	header('location: index.php?start='.$start);

?>
