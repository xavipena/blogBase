<?
/* ***********************************************************************************************
*  FUNCIONS.PHP
*
*  Aquest fitxer s'ha de cridar SEMPRE amb 'require_once'
*
*  Aquest fitxer conté les definicions de valors globals, i alguns paràmetres del sistema. 
*
*  Les funcions són d'ús general a l'aplicació, i només per a aquesta aplicació.
*
*********************************************************************************************** */

$dirInstalaciones = "../images";

function checkForFileCover($p1)
{
	$baseDir ="/covers/";
	$len 	 =strlen($p1);

	$folder =opendir($baseDir);
	while ($arxiu=readdir($folder)) 
	{
		if (substr($arxiu,0,$len) ==$p1) 
		{
			$img ="../../covers/".$arxiu;
			closedir($folder);
			return $img;
		}
	}
	closedir($folder);
}

function checkForCover($p1)
{
    $img ="../../covers/".$p1.".jpg";
    if (!file_exists($img))
    {
        $img ="../../covers/".$p1.".png";
        if (!file_exists($img))
        {
            $img ="../covers/".$p1.".gif";
            if (!file_exists($img))
            {
                return "";
            }
            else return $img;
        }
        else return $img;
    }
    else return $img;
}

// --- FUNCTIONS ---
//IMAGE RESIZE FUNCTION FOLLOW ABOVE DIRECTIONS
function makeimage($filename,$newfilename,$path,$newwidth,$newheight) {

	//CREATES THE NAME OF THE SAVED FILE
	$file = $newfilename . $filename;
	
	//CREATES THE PATH TO THE SAVED FILE
	$fullpath = $path . "/" . $file;
	if (file_exists($fullpath)) 
	{
		return $fullpath;
	}

	$path = $path."/";
	$dirActual = getcwd();
	chdir($path);
	//SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
	$image_type = strstr($filename, '.');
	$image_type= strtolower($image_type);

	//SWITCHES THE IMAGE CREATE FUNCTION BASED ON FILE EXTENSION
		switch($image_type) {
			case '.jpg':
				$source = imagecreatefromjpeg($filename);
				break;
			case '.png':
				$source = imagecreatefrompng($filename);
				break;
			case '.gif':
				$source = imagecreatefromgif($filename);
				break;
			default:
				echo("Error Invalid Image Type");
				die;
				break;
			}
	
	//FINDS SIZE OF THE OLD FILE
	list($width, $height) = getimagesize($filename);

	//CREATES IMAGE WITH NEW SIZES
	$thumb = imagecreatetruecolor($newwidth, $newheight);

	//RESIZES OLD IMAGE TO NEW SIZES
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	//SAVES IMAGE AND SETS QUALITY || NUMERICAL VALUE = QUALITY ON SCALE OF 1-100
	chdir($dirActual);
	imagejpeg($thumb, $fullpath, 60);

	//CREATING FILENAME TO WRITE TO DATABSE
	$filepath = $fullpath;
	
	//RETURNS FULL FILEPATH OF IMAGE ENDS FUNCTION
	return $filepath;

}

function readDirectory($dir)
{
  $dir = OpenDir($dir); // open script (.) directory
  $directories = Array(); // initializing directories array
  $files = Array(); // initializing files array
  while ($file = ReadDir($dir)) // loading all files in the script directory
  {
    if (!Is_Dir($file)) // testing if file(founded object) is directory
    {
      $path_parts = pathinfo($file); // file recognize process
      $extension=$path_parts["extension"];
      $extension = strtolower($extension);
      if ($extension=="jpg" or $extension=="jpeg" or $extension=="png" or $extension=="gif")
      {
		if (!strstr($file,"thumbnail_"))
		{
	        $files[] = $file; // add file into array
		}
      }
      elseif($extension=="")
      {      
      	$directories[] = $file; // add directory into array
      }
    }
    elseif($file!="." and $file!="..")
    { // object is directory and we dont want show thumbnail, . or .. directories
      $directories[] = $file; // add directory into array
    }  

  }
    CloseDir($dir); // closing directory
  $output['directories'] = $directories;
  $output['files'] = $files;
  return $output;
}




/****************************************************************
* No utilitzades???????
****************************************************************/
function GravarIdioma($language) {
echo "$language";
	setcookie( "Idioma", $language, time()+3600*24*180, '/' );
}

function GravarNom($NomRemitent) {
	setcookie( "Nom", $NomRemitent, time()+3600*24*180, '/' );
}

function getNom() {
//	if (isset($Nom)) : return $Nom; else : return ""; endif;
	if (isset($Nom)) {
		return $Nom;
	} else {
		return '';
	}
}

function GravarCorreu($MailRemitent) {
	setcookie( "Correu", $MailRemitent, time()+3600*24*180, '/' );
}

function getCorreu() {
	if (isset($Correu)) {
		return $Correu;
	} else {
		return '';
	}
}

function num_errors_form() {
	session_start();
	if (isset($_SESSION["camps_error"])) {
		$p_camps_error=& $_SESSION["camps_error"];
		return count($p_camps_error);
	} else {
		return 0;
	}
}

function LetraNIF($dni) {
	/* Obté la lletra del NIF a partir del número de DNI */
	$valor= (int) ($dni / 23);
	$valor *= 23;
	$valor= $dni - $valor;
	$letras= "TRWAGMYFPDXBNJZSQVHLCKEO";
	$letraNif= substr ($letras, $valor, 1);
	return $letraNif;
}

/**
* Create a squared thumbnail from an existing image.
* 
* @param	string		$file		Location and name where the file is stored .
* @return	
* @access	public
* @author	Christian Machmeier
*/
function createThumb($thisImagePath, $thisThumbnailPath)
{
	// Get information about the installed GD.
	$gdVersion = getGDversion();	
	if ($gdVersion == false) {
		return false;
	}
	
	$file = $thisImagePath;
	$fileDest = $thisThumbnailPath;
	
	// Get the image dimensions.
	$dimensions = @getimagesize($file);
	$width		= $dimensions[0];
	$height		= $dimensions[1];	
	
	$outputX  = 100;
	$outputY  = 100;
	$quality  = 85;
	
	// The image is of vertical shape.
	if ($width < $height) {
		$deltaX   = 0;
		$deltaY   = ($height - $width) / 2;
		$portionX = $width;
		$portionY = $width;
		
	// The image is of horizontal shape.
	} else if ($width > $height) {
		$deltaX   = ($width - $height) / 2;
		$deltaY   = 0;
		$portionX = $height;
		$portionY = $height;
		
	// The image is of squared shape.
	} else {
		$deltaX   = 0;
		$deltaY   = 0;
		$portionX = $width;
		$portionY = $height;
	}
	
	$imageSrc  = @imagecreatefromjpeg($file);
	
	// The thumbnail creation with GD1.x functions does the job.
	if ($gdVersion < 2) {
		
		// Create an empty thumbnail image.
		$imageDest = @imagecreate($outputX, $outputY);
		
		// Try to create the thumbnail from the source image.
		if (@imagecopyresized($imageDest, $imageSrc, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY)) {
			
			// save the thumbnail image into a file.
			@imagejpeg($imageDest, $fileDest, $quality);
			
			// Delete both image resources.
			@imagedestroy($imageSrc);
			@imagedestroy($imageDest);
		}
		
	} else {	
		// The recommended approach is the usage of the GD2.x functions.
		
		// Create an empty thumbnail image.
		$imageDest = @imagecreatetruecolor($outputX, $outputY);
		
		// Try to create the thumbnail from the source image.
		if (@imagecopyresampled($imageDest, $imageSrc, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY)) {
			
			// save the thumbnail image into a file.
			@imagejpeg($imageDest, $fileDest, $quality);
			
			// Delete both image resources.
			@imagedestroy($imageSrc);
			@imagedestroy($imageDest);
		}		
	}
	
	return "ERROR<br>";
}

function getGDversion() {
   static $gd_version_number = null;
   if ($gd_version_number === null) {

       // Use output buffering to get results from phpinfo() without disturbing the page we're in.  Output
       // buffering is "stackable" so we don't even have to	worry about previous or encompassing buffering.

       ob_start();
       phpinfo(8);
       $module_info = ob_get_contents();
       ob_end_clean();
       if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i",
               $module_info,$matches)) {
           $gd_version_number = $matches[1];
       } else {
           $gd_version_number = 0;
       }
   }
   return $gd_version_number;
} 

?>
