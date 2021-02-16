<?php
   header("Access-Control-Allow-Origin: *");
   header("content-type: text/plain");   
   if (isset($_GET['uid']) && !empty($_GET['uid'])) {
       $uid = $_GET['uid'];
       function getTextBetwenWords($start, $content, $end) {
          $word = explode($start, $content);
          $word = explode($end, $word[1]);
          return $word[0];
       }
       $server = 'https://yourshinobipath.forumotion.me/';
       $botName = 'Game Master';
       $botPass = 'radiJator69';
       $ch = curl_init();
       $agent = $_SERVER["HTTP_USER_AGENT"];
       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_COOKIESESSION, true);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
       curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
       curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
       
       /* GET LOGIN AND TID */     
       $loginData = [
           "username" => $botName,
           "password" => $botPass,
           "autologin" => "1",
           "redirect" => $server."/admin/index.forum",
           "query" => "",
           "login" => "Log In" 
       ]; 
       curl_setopt($ch, CURLOPT_POSTFIELDS, $loginData);
	   curl_setopt($ch, CURLOPT_URL, $server.'/login');
	   curl_exec($ch);
       $tid = explode("?tid=",curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
	   $tid = $tid[1]; 
	   
   }
?>