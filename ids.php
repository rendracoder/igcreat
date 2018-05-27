<?php
require('function.php');
@set_time_limit(0);
@clearstatcache();
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);

echo "* Kosongkan proxy jika tidak memakai proxy \n* Jumlah maksimal 10 \n\n";

$acak       = 'axegram'.acak('1234567890', '5').'';
$username   = $acak;
$password   = 'helloaxeeeee';
$email      = ''.$acak.'@theaxelab.tech';
$name       = 'Si '.$acak.'';
echo "Insert your proxy : ";
$proxy      = trim(fgets(STDIN, 1024));
// $proxy      = '159.69.2.199:80';
$date       = date("Y-m-d");
$file       = 'result.html';
echo "Count : ";
$count      = trim(fgets(STDIN, 1024));

echo "Please wait... \n\n";
for ($i=0; $i < $count; $i++) {
	$create     = create($username, $password, $email, $name, $proxy);
	$data       = json_decode($create);
	if($data->account_created == 'true'){
		$file   = fopen(''.$file.'', 'r+') or die("file not found!");;
		$get    = fgets($file);
		$catat  = fwrite($file, ''.$username.':'.$password.'<br>');
		fclose($file);
		echo "".$i." Success create ".$username.":".$password."\n";
	} else {
		echo "".$i." Failed create ".$username.":".$password."\n";
	}
	sleep(10);
}