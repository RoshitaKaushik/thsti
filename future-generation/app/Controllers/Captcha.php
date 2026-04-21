<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Captcha extends Controller
{
    public function index()
{
    helper('session');

    $image_width = 120;
    $image_height = 40;
    $characters_on_image = 6;
    $font = FCPATH . 'assets/fonts/monofont.ttf';

    $possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
    $code = '';
    for ($i = 0; $i < $characters_on_image; $i++) {
        $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1);
    }

    session()->set('captchaword', $code);

    $font_size = $image_height * 0.75;
    $image = imagecreate($image_width, $image_height);

    // Colors
    $background_color = imagecolorallocate($image, 0, 0, 0); // Black background
    $text_color = imagecolorallocate($image, 255, 255, 255); // White text
    $line_color = imagecolorallocate($image, 192, 192, 192); // Light gray for lines

    // Random noisy lines (angled, sharp)
    for ($i = 0; $i < 5; $i++) {
        imageline(
            $image,
            mt_rand(0, $image_width),
            mt_rand(0, $image_height),
            mt_rand(0, $image_width),
            mt_rand(0, $image_height),
            $line_color
        );
    }

    // Add each letter with tight spacing
    $x = 10;
    for ($i = 0; $i < strlen($code); $i++) {
        $angle = mt_rand(-10, 10); // slight angle
        $letter = $code[$i];
        $y = mt_rand(25, 35); // slight vertical variation
        imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font, $letter);
        $x += 16; // control spacing between letters
    }

    // Output
    header('Content-Type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);
    exit;
}

}
