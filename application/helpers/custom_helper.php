<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function my_var_dump($string)
{		
	if(is_array($string) or is_object($string))
	{
		echo "<pre>";
		print_r($string);
		echo "</pre>";
	}
	elseif(is_string($string))
	{
		echo $string."<br>\n";
	}
	else
	{
		echo "<pre>";
		var_dump($string);
		echo "</pre>";
	}
}


function delete_file($path_and_filename)
{
	if(file_exists($path_and_filename))
	{
		if(is_file($path_and_filename))
		{
			if(unlink($path_and_filename))
			{
				return true;
			}
			else return false;
		}else return false;
	}else return false;
}

function isValidEmail($email)
{
	//return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email);
	
	if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) 
	{
    	//$msg = 'email is not valid';
		return false;
	}
	else
	{
		return true;
	}
}

function isValidURL($url)
{
	return preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}
function addhttp($url) 
{
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
function my_redirect($url,$target='')
{
	echo "<script>window.parent.location=\"".$url."\"</script>";
}

function display_success_message()
{
	if(isset($_SESSION['msg_success']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_success']))
		{
			foreach($_SESSION['msg_success'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string	.=	implode("<br>",$strarray);
		}
		else
		{
			$string	.=	$_SESSION['msg_success'];
		}

		unset($_SESSION['msg_success']);
		return "$string";
	}
	else
	{
		return "";
	}	
}
function display_error()
{
	if(isset($_SESSION['msg_error']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_error']))
		{
			foreach($_SESSION['msg_error'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string	.=	implode("<br>",$strarray);
		}
		else
		{
			$string	.=	$_SESSION['msg_error'];
		}

		unset($_SESSION['msg_error']);
		return "$string";
	}
	else
	{
		return "";
	}	
}

function make_table($data,$columns,$table_class = 'make_table',$tr_class = 'make_table_tr', $td_class = 'make_table_td',$default_value='&nbsp;')
{
	#################### REQUIRED INPUT ####################
	/*
	1. REQUIRED
	$data should be an array, and array key must be 
	an integer starting with 0 and must contain 
	further iteration in sequence. For example
	
	$data[0] = "any value";
	$data[1] = "any value";
	$data[2] = "any value";
	$data[3] = "any value";
	
	2. REQUIRED
	$columns must be a variable
	$columns must have integer value greater than 0
	*/
	#################### REQUIRED INPUT ####################

	$no_of_cells = count($data);
	$no_of_rows = ceil($no_of_cells/$columns);
	$no_of_total_cells = $columns*$no_of_rows;
	$extra_cells = $no_of_total_cells-$no_of_cells;
	
	#################### SUMMARY FOR DEBUGGING ####################
	#	echo "Number of columns: $columns<br>";
	#	echo "Number of rows: $no_of_rows<br>";
	#	echo "Number of data Cells: $no_of_cells<br>";
	#	echo "Number of Extra Cells: $extra_cells<br>";
	#	echo "Number of Total Cells: $no_of_total_cells<br>";
	#################### SUMMARY FOR DEBUGGING ####################
	
	$key = 0;	# THIS VARIABLE WILL BE INCREMENTED ON EARCH CELL

	$HTML = "<table class=\"$table_class\" >";
	for($i=0;$i<$no_of_rows;$i++)	# THIS LOOP WILL GENERATE TABLE ROWS
	{
		$HTML .= "<tr class=\"$tr_class\">";	# START TABLE ROW
		
		for($j=0;$j<$columns;$j++)	# THIS LOOP WILL GENERATE TABLE CELLS
		{
			if(isset($data[$key]))	# IF DATA CELL EXISTS
			{
				$HTML .= "<td class=\"$td_class\">";	# START TABLE CELL
				$HTML .= $data[$key];
				$HTML .= "</td>";	# END TABLE CELL
			}
			else
			{
				$HTML .= "<td class=\"$td_class\">";	# START TABLE CELL
				$HTML .= $default_value;	# $data[$key];
				$HTML .= "</td>";	# END TABLE CELL			
			}
			$key++;
		}
		
		$HTML .= "</tr>";	# END TABLE ROW
	}
	$HTML .= "</table>";
	
	
	#echo $HTML;
	return $HTML;
}

function handle_post_request_from_angularjs()
{
	if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
		$_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
	}
}

function resize_image2($url, $newWidth='', $newHeight='', $Base='')
{
	list($iw, $ih, $imageType) = getimagesize($url);
	$imageType = image_type_to_mime_type($imageType);
	
	switch($imageType)
	{
		case "image/gif":
			$image = imagecreatefromgif($url);
		break;
		
		case "image/pjpeg":
			$image = imagecreatefromjpeg($url);
		break;
		
		case "image/jpeg":
			$image = imagecreatefromjpeg($url);
		break;
		
		case "image/jpg":
			$image = imagecreatefromjpeg($url);
		break;
		
		case "image/png":
			$image = imagecreatefrompng($url);
		break;
		
		case "image/x-png":
			$image = imagecreatefrompng($url);
		break;
	}
	
	$orig_width = imagesx($image);
	$orig_height = imagesy($image);
	
	if($Base=='W')
	{
		$width = $newWidth;
		$height = (($orig_height * $newWidth) / $orig_width);
		$new_image = imagecreatetruecolor($newWidth, $height);
	}
	else if($Base=='H')
	{
		$width = (($orig_width * $newHeight) / $orig_height);
		$height = $newHeight;
		$new_image = imagecreatetruecolor($width, $newHeight);
	}
	
	imagecopyresized($new_image, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
	
	switch($imageType)
	{
		case "image/gif":
			imagegif($new_image, $url);
		break;
		
		case "image/pjpeg":
			imagejpeg($new_image, $url, 100);
		break;
		
		case "image/jpeg":
			imagejpeg($new_image, $url, 100);
		break;
		
		case "image/jpg":
			imagejpeg($new_image, $url, 100); 
		break;
		
		case "image/png":
			imagepng($new_image, $url);
		break;
		
		case "image/x-png":
			imagepng($new_image, $url);
		break;
	}
		
		
	
}

//You do not need to alter these functions
function get_height($image)
{
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}

//You do not need to alter these functions
function get_width($image)
{
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

function generate_password($length)
{
	$password = "";
	$possible = "0123456789abcdfghijklmnopqrstuvwxyz";
	$i = 0;
	while($i < $length)
	{
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		if (!strstr($password, $char))
		{
			$password .= $char;
			$i++;
		}
	}
	return $password;
}

function time_elapsed_string($datetime, $full = false) 
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);        $diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;        $string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}        if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function get_proper_doctor_name($docName)
{
	if($docName == '') return $docName;
	
	$substr=substr($docName, 0, 3); 
	$substr=strtolower($substr);
	if($substr == 'dr ' || $substr == 'dr.')
	{
		if($substr == 'dr.')
		{
			return ucfirst(str_replace('Dr.','Dr ',$docName));	
		}
		return ucfirst($docName);
	}
	else
	{
		return 'Dr '. $docName;
	}
}