<?php
#echo '<b>Running fopen test</b><br>';
#$handle = fopen("https://graph.facebook.com", "r");
#if ($handle === false) {
#	echo 'fopen test failed.';
# else {
#	echo 'fopen test succeeded.';
#}

echo '<br><br><b>Running curl test</b><br>';
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL,'https://graph.facebook.com' );
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch,CURLOPT_VERBOSE,false);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$page=curl_exec($ch);
echo curl_error($ch);
if ($page === false) {
	echo 'curl test failed.';
} else {
	echo 'curl test suceeded.';
}
curl_close($ch);

echo '<br><br><b>Running gethostbyname test</b><br>';
$host = 'graph.facebook.com';
$ip = gethostbyname ($host);
if ($ip != $host) {
	echo 'gethostbyname test succeeded. IP of graph.facebook.com is ' . $ip;
} else {
	echo 'gethostbyname test Failed.';
}
echo '<br><br>';
?>
