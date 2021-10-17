<?php
//Laddar upp filen till mappen uploads
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

//Sätts till 0 om ett fel inträffar
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
header('Content-type: text/plain');

// Ser till så man kan endast ladda upp filen om den inte redan finns
if (file_exists($target_file)) {
    echo "Filen finns redan \n";
    $uploadOk = 0;
}

// Sätter största storleken på filen
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Filen är för stor \n";
    $uploadOk = 0;
}

// Om filen inte är för stor eller ej finns på servern kontrolleras mime-typen
if ($uploadOk == 0) {
    echo "Filen laddades ej upp \n";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		//Om filen är jpg eller png visas bilden. Om filen är txt skrivs texten ut. Annars visas data om filen
		$mime = mime_content_type($target_file);
		switch($mime){
			case 'image/jpeg':
				$im = imagecreatefromjpeg($target_file);
				header('Content-Type: image/jpeg');
				imagejpeg($im);
				imagedestroy($im);
			break;
			case 'image/png':
				$im = imagecreatefrompng($target_file);
				header('Content-Type: image/png');
				imagepng($im);
				imagedestroy($im);
			break;
			case 'text/plain':
				header('Content-type: text/plain');
				readfile($target_file);
			break;
			default:
				
				echo $_FILES["fileToUpload"]["name"] . "\n";
				echo $_FILES["fileToUpload"]["size"] . "\n";
				echo $mime;
		}
	} else {
        echo "Det inträffade ett fel vid inladdning av filen";
    }
}



?>