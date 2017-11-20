<?php
header("content-type: text/html; charset=UTF-8");  
echo '<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<!--[if IE 7]><html lang="en" class="ie7"><![endif]-->
	<!--[if IE 8]><html lang="en" class="ie8"><![endif]-->
	<!--[if IE 9]><html lang="en" class="ie9"><![endif]-->
	<!--[if (gt IE 9)|!(IE)]><html lang="en"><![endif]-->
	<!--[if !IE]><html lang="en-US"><![endif]-->
    <title>Dead by Daylight - Tier list - Killers</title>
	<link rel="stylesheet" type="text/css" href="dbd.css">
	<link rel="icon" type="image/png" sizes="64x64" href="favicon.png">
	<meta name="description" content="Website of Dennis Reep. Playground for trying out pieces of code.">
	<meta name="author" content="Dennis Reep">
  </head>';

echo '<body>';

echo '<script>
function ratePerk(perkId, ratingInp) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "https://dennisreep.nl/dbd/rateKillers.php?rating=" + ratingInp + "&perkId=" + perkId, true);
	
    xhttp.send();
	xhttp.onreadystatechange = function() {
	  if (xhttp.readyState == 4 && xhttp.status == 200) {
		  var response = xhttp.responseText;
		  if(isNaN(response)){
			  alert(response);
		  } else {
			var rating = response;
			var ratingLow = Math.floor(rating);
			var ratingRest = rating - ratingLow;
			
			console.log(rating);
			console.log(ratingLow);
			console.log(ratingRest);
		
			var id = "star-" + perkId + "-" + rating;
			console.log(id);
			for(i=0;i<ratingLow;i++){
				var id = "star-" + perkId + "-" + (i + 1);
				document.getElementById(id).src="https://dennisreep.nl/dbd/stars/star1.png";
			}
			if(ratingRest > 0){
				var id = "star-" + perkId + "-" + (ratingLow + 1);
				document.getElementById(id).src="https://dennisreep.nl/dbd/stars/star0.5.png";
			}
			for(i = (ratingLow + Math.ceil(ratingRest)); i < 5;i++){
				var id = "star-" + perkId + "-" + (i + 1);
				document.getElementById(id).src="https://dennisreep.nl/dbd/stars/star0.png";
			}
			alert("Thanks for the rating!\r\nYou rated: " + ratingInp + "\r\nPerk rating: " + Math.round(rating * 100) / 100);
		  }
	  }
	}
}
</script>';

include 'db.php';

try {
    //create PDO connection
    $db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    //show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

$stmt = $db->prepare('SELECT * FROM `Killers` WHERE 1 ORDER BY `Rating` DESC');
$stmt->execute();

echo '<div id="centerDiv"><div id="tableL"><table style="border: 1px solid black;">
  <tr>
    <th>Icon</th>
    <th>Name</th>
    <th>Tier</th>
    <th>Rate</th>
  </tr>';
$count = 0;
while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
	$trStart = '<tr>';
	if(strcmp($row[3], 'A') == 0){
		$trStart = '<tr class="trA">';
	} else if(strcmp($row[3], 'B') == 0){
		$trStart = '<tr class="trB">';
	} else if(strcmp($row[3], 'C') == 0){
		$trStart = '<tr class="trC">';
	} else if(strcmp($row[3], 'D') == 0){
		$trStart = '<tr class="trD">';
	}
	
	$ratingStars = '<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star0" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star0" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star0" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star0" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star0" />';
	
	$rating = $row[4];
	
	$ratingLow = floor($rating);
	$ratingRest = $rating - $ratingLow;
	
	$ratingStars = '';
	for ($i = 1; $i <= $ratingLow; $i++) {
		$ratingStars = $ratingStars . '<img src="https://dennisreep.nl/dbd/stars/star1.png" style="cursor: pointer;" id="star-' . $row[0] . '-' . $i . '" width="32" height="32" alt="star1" onclick="ratePerk(' . $row[0] . ',' . $i .')"/>';
	}
	if($ratingRest > 0){
		$ratingStars = $ratingStars . '<img src="https://dennisreep.nl/dbd/stars/star0.5.png" style="cursor: pointer;" id="star-' . $row[0] . '-' . ($ratingLow + 1) . '" width="32" height="32" alt="star0.5" onclick="ratePerk(' . $row[0] . ',' . $i .')"/>';
		for($j = ($ratingLow + 1); $j < 5; $j++){
			$ratingStars = $ratingStars . '<img src="https://dennisreep.nl/dbd/stars/star0.png" style="cursor: pointer;" id="star-' . $row[0] . '-' . ($j + 1) . '" width="32" height="32" alt="star0" onclick="ratePerk(' . $row[0] . ',' . ($j + 1) .')"/>';
		}
	} else {
		for($j = ($ratingLow); $j < 5; $j++){
			$ratingStars = $ratingStars . '<img src="https://dennisreep.nl/dbd/stars/star0.png" style="cursor: pointer;" id="star-' . $row[0] . '-' . ($j + 1) . '" width="32" height="32" alt="star0" onclick="ratePerk(' . $row[0] . ',' . ($j + 1) .')"/>';
		}
	}
	$ratingStars = $ratingStars . '<h1>' . round($row[4], 2) . '</h1>';
	
	$charUrlString = 'https://deadbydaylight.gamepedia.com/' . str_replace(" ", "_", trim($row[2]));
	
	echo utf8_encode (
	$trStart . 
	'<td>' . '<img src="https://dennisreep.nl/dbd/Killers/' . $row[1] . '" alt="'. $row[1] .'"/></td>
	<td width="120"><h1><a href="' . $charUrlString . '">' . $row[2] . '</a></h1></td>

	<td><h3>' . $row[3] . '</h3></td>
	<td width="200"><br style="margin:6px;"/><br/>'  
	. $ratingStars . 
	'</td></tr>');
	$count = $count + 1;
	if($count == 5){
		echo '</table></div><div id="tableR"><table style="border: 1px solid black;">';
	}
}
echo '</table></div></div>';

echo '</body></html>';
?>