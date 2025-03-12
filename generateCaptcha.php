<?php
session_start();

// Generate a random CAPTCHA value (4-digit number)
$captchaValue = rand(1000, 9999);

// Store the CAPTCHA value in the session
$_SESSION['captchaValue'] = $captchaValue;

// Create a blank image with a white background
$image = imagecreatetruecolor(120, 40);
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $backgroundColor);

// Set the text color to black
$textColor = imagecolorallocate($image, 0, 0, 0);

// Add the CAPTCHA value to the image
imagettftext($image, 20, 0, 10, 30, $textColor, 'arial.ttf', $captchaValue);

// Set the content type to PNG image
header('Content-Type: image/png');

// Output the image as PNG
imagepng($image);

// Clean up resources
imagedestroy($image);
?>
