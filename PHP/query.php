<?php
if (sizeof($_GET) > 0) {
	$data = $_GET['choice1'] . "|" . $_GET['choice2'] . "|" . $_GET['choice3'] . "|" . $_GET['choice4'] . "|" . $_GET['choice5'];
	$open = fopen("groups/" . $_GET['id'] . ".txt", "a+");
  	$contains = false;
  	foreach (new SplFileObject("groups/" . $_GET['id'] . ".txt") as $line) {
    	if ($line == $data){
      		$contains = true;
      		break;
    	}
	}
  	if (!$contains) {
    	fwrite($open, $data);
    	echo "SUBMITTED";
 	}
	fclose($open);
} 
?>
