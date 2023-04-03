<?php
function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    echo $str;
    return $str;
}

$pass = random_str(12);
echo $pass;
//$pass = array();
//function randomPassword() {
//    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
//     //remember to declare $pass as an array
//    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
//    for ($i = 0; $i < 8; $i++) {
//        $n = rand(0, $alphaLength);
//        $pass[] = $alphabet[$n];
//    }
//    return implode($pass); //turn the array into a string
//}
//
//echo $pass;
//
//$bytes = openssl_random_pseudo_bytes(2);
//
//$pwd = bin2hex($bytes);

//$pwd = bin2hex(openssl_random_pseudo_bytes(4));
//****************                                      werkt
//echo $pwd;

//function getRandomBytes($nbBytes = 32)
//{
//    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
//    if (false !== $bytes && true === $strong) {
//        return $bytes;
//    }
//    else {
//        throw new \Exception("Unable to generate secure token from OpenSSL.");
//    }
//}///[^a-zA-Z0-9]/
//function generatePassword($length){
//    return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
//}
//
//$newpassword = generatePassword(12);
//
//echo $newpassword;
?>