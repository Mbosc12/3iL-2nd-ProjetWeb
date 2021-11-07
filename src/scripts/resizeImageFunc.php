<?php
	function resizeImage ($file, $username)
	{
		$tmpName = $file['tmp_name'];
		$name = $file['name'];
		$type = pathinfo($name, PATHINFO_EXTENSION);
		$date = date("Y-m-d-H-i-s");

		list($x, $y) = getimagesize($tmpName);
		if ($x > $y) {
			$square = $y;
			$offsetX = ($x - $y) / 2;
			$offsetY = 0;
		} elseif ($y > $x) {
			$square = $x;
			$offsetX = 0;
			$offsetY = ($y - $x) / 2;
		} else {
			$square = $x;
			$offsetX = $offsetY = 0;
		}
		$endSize = 624;
		$finalImage = imagecreatetruecolor($endSize, $endSize);
		if ($type === "png") {
			header("Content-type: image/png");
			$image = imagecreatefrompng($tmpName);
			imagecopyresampled($finalImage, $image, 0, 0, $offsetX, $offsetY, $endSize, $endSize, $square, $square);
			imagepng($finalImage, '../img/user-images/' . $username . '_' . $date . '.' . $type);
		} else {
			header("Content-type: image/jpeg");
			$image = imagecreatefromjpeg($tmpName);
			imagecopyresampled($finalImage, $image, 0, 0, $offsetX, $offsetY, $endSize, $endSize, $square, $square);
			imagejpeg($finalImage, '../img/user-images/' . $username . '_' . $date . '.' . $type);
		}
		return [$date, $type];
	}
