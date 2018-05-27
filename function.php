<?php
function acak($char, $length = 3){
    $characters = $char;
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function create($username, $password, $email, $name, $proxy)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/accounts/web_create_ajax/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "email=".$email."&password=".$password."&username=".$username."&first_name=".$name."&seamless_login_enabled=1&tos_version=row");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
	if($proxy){
	curl_setopt($ch, CURLOPT_PROXY, $proxy); // PROXY details with port
	curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	}

	$headers = array();
	$headers[] = "Host: www.instagram.com";
	$headers[] = "Cookie: fbm_124024574287414=base_domain=.instagram.com; rur=PRN; csrftoken=JGy73sgl0eQOXErwxSnMzmI1m8s8ZAKp; mid=WwjAHgAEAAF3eSli-vALoMvAF1Kl; fbm_124024574287414=\"base_domain=.instagram.com\"; mcd=1";
	$headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.124 Safari/537.36";
	$headers[] = "Origin: https://www.instagram.com";
	$headers[] = "X-Instagram-Ajax: 8958fe1e75ab";
	$headers[] = "Content-Type: application/x-www-form-urlencoded";
	$headers[] = "Accept: */*";
	$headers[] = "X-Requested-With: XMLHttpRequest";
	$headers[] = "Save-Data: on";
	$headers[] = "X-Csrftoken: JGy73sgl0eQOXErwxSnMzmI1m8s8ZAKp";
	$headers[] = "Referer: https://www.instagram.com/";
	$headers[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close ($ch);

	return $result;
}