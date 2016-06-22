<?php
$filename = "groups/" . $_GET["id"] . ".txt";
$file = fopen($filename, "r");
$bool = false;
$keys = "";
if (! $file == false) {
	$data = fread($file,filesize($filename)); 
	$total = array();
	foreach (new SplFileObject($filename) as $line) {
		$str = str_replace("\n", '', $line);
		$array = explode("|", $str);
	  	foreach ($array as $ind){
	  		if ($ind != "") {
			    	if (isset($total[$ind])) {
			    		$total[$ind]++; 
			    	} else {
			    		$total[$ind] = 1;
			    	}
	  		}
	  	}
	}
  	fclose($file);
	$high = 0; 
	foreach ($total as $key => $value) {
	  	if ($value > $high) {
	    	$high = $value; 
	    	$keys = $key;
	  	}
	}
  	$bool = true;
	}	else{
 			echo "Group does not exist"; 
	}
if ($bool) {
  $client_id = "MZBXZQHK3HDVZXRJQN3GLZQ3FI5W2XNRUEYMUZIFYKQWUVN0"; 
  $client_secret = "3HPKD4GEX3O0H4QFDBK5M4THJSKDZFI24KKXHOKWE1PQAQYY";
  $json = file_get_contents("https://api.foursquare.com/v2/venues/explore?client_id=" . $client_id . "&client_secret=" . $client_secret . "&v=20160301&ll=40.7286679,-73.9956593&query=" . $keys);
  $js = json_decode($json,true);
  $query = $js['response']['groups'][0]['items'][0]['venue'];
  $resp = $query['name'] . "|" . $query['location']['formattedAddress'][0] . $query['location']['formattedAddress'][1];
  $fp = fopen("groups/" . $_GET['id'] . ".response",  "w"); 
  fwrite($fp, $resp);
  echo "COMPUTED";
  fclose($fp); 
}
?>
