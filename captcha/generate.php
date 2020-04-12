<?php 

function random_string($length_of_string) 
{ 
  
    // String of all alphanumeric character 
    $permitted_char = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
    // Shuffle the $permitted_char and returns substring of specified length 
    return substr(str_shuffle($permitted_char), 0, $length_of_string); 
} 

// Generate CAPTCHA string
$captcha = random_string(4);

// Create the size of image or blank image 
$image = imagecreate(280, 100); 
  
// Set the background color of image 
$background_color = imagecolorallocate($image, 224, 224, 224); 
  
// Set the text color of image 
$text_color = imagecolorallocate($image, 0, 0, 0); 

# use below font for increased difficulty
$font = __DIR__ . '/Typewriter-Alternate.ttf';
  
// Write text to image
imagettftext($image, 55, 0, 55, 70, $text_color, $font, $captcha);  
  
header("Content-Type: image/png"); 

// Save image to directory
imagepng($image, "/opt/lampp/htdocs/captcha/images/$captcha.png");

// Destroy image
imagedestroy($image);

// Open image in browser
$img_file = "http://localhost:8080/captcha/images/$captcha.png";
header("Location: $img_file");

?>