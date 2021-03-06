<?php

require_once 'v2/www/include/JCryption.php';

$keyLength = 1024;
$jCryption = new jCryption();

$numberOfPairs = 100;
$arrKeyPairs = array();

for ($i=0; $i < $numberOfPairs; $i++) {
	$arrKeyPairs[] = $jCryption->generateKeypair($keyLength);
}

$file = array();
$file[] = '<?php';
$file[] = '$arrKeys = ';
$file[] = var_export($arrKeyPairs, true);
$file[] = ';';

if (!file_exists("rsa")) mkdir("rsa");

file_put_contents("rsa/" . $numberOfPairs . "_". $keyLength . "_keys.inc.php", implode("\n", $file));
