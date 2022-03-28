<?php 
    $simple_string = "112244";
    $ciphering = "AES-256-CTR";
    $option = 0;
    $encryption_iv = '1122334455667788';
    $encryption_key ="aaaaaaaaaaaaaaaa";
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key,  $option, $encryption_iv);
    echo $encryption . "<br>";

    $simple_string2 = "emptTyoM";
    $ciphering = "AES-256-CTR";
    $option = 0;
    $encryption_iv = '1122334455667788';
    $encryption_key = "aaaaaaaa";
    $decryption = openssl_decrypt($simple_string2, $ciphering, $encryption_key,$option,$encryption_iv);
    echo $decryption;

    // ham ran
    function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for( $i = 0; $i < $length; $i++ ) {
    $str = $str . $chars[rand(0, $size - 1 )];
    }
    return $str;
    }

    $a = rand_string(5);
    echo $a;
 ?>