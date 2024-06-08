<?php
    function generateCaptchaCode($length = 6) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $captchaCode = '';
        $maxIndex = strlen($characters) - 1;
    
        for ($i = 0; $i < $length; $i++) {
            $captchaCode .= $characters[rand(0, $maxIndex)];

            if ($i < $length - 1) {
                $captchaCode .= '   ';
            }
        }

        $_SESSION['captcha'] = $captchaCode;
        return $captchaCode;
        
    }
    $rand = generateCaptchaCode();
?>