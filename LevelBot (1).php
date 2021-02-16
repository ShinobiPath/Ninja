<?php
   header("Access-Control-Allow-Origin: *");
   header("content-type: text/plain");
   if (isset($_GET['uid']) && !empty($_GET['uid'])) {  
       $uid = $_GET['uid'];
	function getTextBetwenWords($start,$end, $content) {
		$word = explode($start,$content);
		$word = explode($end,$word[1]);
		return $word[0];
	}
	$server = 'https://www.narutoninjaway.com/';
	$botname = 'NNW Game Master';
	$botpass = 'radiJator69';
	$ch = curl_init();
	$agent = $_SERVER["HTTP_USER_AGENT"];
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_POST, 1 );
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

    //login and get token
	curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" .$botname. "&password=" .$botpass. "&autologin=1&redirect=" .$server. "/admin/index.forum&query=&login=Log in");
	curl_setopt($ch, CURLOPT_URL, $server.'/login');
	curl_exec($ch);
    $tid = explode("?tid=",curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
	$tid = $tid[1];

	//set user data
    //get rpg data
    curl_setopt($ch, CURLOPT_URL, $server.'/rpg_sheet_edit?u='.$uid.'' );	
    $postResult = curl_exec($ch);
    $userData = json_decode(getTextBetwenWords('name="field_21">','</textarea>', $postResult));
	//update points
	$xppoints = $userData->posting;
	curl_setopt($ch, CURLOPT_POSTFIELDS, "action=add_points_for_user&submit=Save&points_new_value[".$uid."]=".$xppoints."");
	curl_setopt($ch, CURLOPT_URL, $server.'/admin/index.forum?part=modules&sub=point&mode=don&extended_admin=1&tid='.$tid.'');
	curl_exec($ch);
}
?>