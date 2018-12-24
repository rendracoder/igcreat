<?php
require('function.php');
@set_time_limit(0);
@clearstatcache();
@ini_set('max_execution_time', 0);
@ini_set('output_buffering', 0);

echo banner()."\n";

while (true) {
    $ua         = 'Mozilla/5.0 (Linux; Android 5.1.1; Redmi Note 3 Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36';
    $proses     = proccessmail('https://10minutemail.net/m/?lang=id', $ua);
    preg_match_all('%Set-Cookie: (.*?);%', $proses[0], $d);
    $cookie     = '';
    for ($o = 0; $o < count($d[0]); $o++)
        $cookie .= $d[1][$o] . ";";
    $sesi       = explode('PHPSESSID=', $cookie);
    $sesi       = explode(';', $sesi[1]);
    $sesi       = $sesi[0];
    $time       = strtotime(date('Y-m-d H:i:sP'));
    ////----////----////----////----////----////
    $getlist    = proccessmail('https://10minutemail.net/address.api.php?sessionid=' . $sesi . '&_=' . $time, $ua, $cookie);
    $getlist    = json_decode($getlist[1], true);
    $data       = json_decode(file_get_contents('https://randomuser.me/api/'), true);
    $username   = $data['results'][0]['login']['username'];
    $password   = $data['results'][0]['login']['password'].''.$data['results'][0]['name']['first'];
    $email      = $getlist['mail_get_mail'];
    $name       = ucfirst($data['results'][0]['name']['first']);
    //echo "Insert your proxy : ";
    //$proxy      = trim(fgets(STDIN, 1024));
    $proxy      = '';
    $proxypwd   = '';
    $date       = date("Y-m-d");
    $file       = 'result.txt';
    $create     = create($username, $password, $email, $name, $proxy, $proxypwd);
    $data       = json_decode($create, true);
    if($data['account_created'] == true){
        $file  = fopen($file, 'r+') or die("file not found!");
        $get   = fgets($file);
        $catat = fwrite($file, "".$username.":".$password.":".$email."\n");
        fclose($file);
        echo "[Success create][".$username."][".$password."][".$email."]\n";
    } else if($data['errors']['ip']){
        echo $data['errors']['ip'][0]."\n";
    } else if($data['errors']['username']){
        echo $data['errors']['username'][0]['message']."\n";
    } else {
        echo "Unknown error\n";
    }
    sleep(100);
}
?>
