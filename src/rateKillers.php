<?php 
$killerId = $_GET["perkId"];
$rating = $_GET["rating"];

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

$ipAddress = $_SERVER['REMOTE_ADDR'];

$stmt = $db->prepare('SELECT * FROM `KillersRatings` WHERE `ipaddress` = :ipAddress');
$stmt->execute(array(':ipAddress' => $ipAddress));
$numrows = $stmt-> rowCount();

$oneStarRating = 0;
while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
	if($row[1] == 1){
		$oneStarRating = $oneStarRating + 1;
	}
}

if($oneStarRating > 5){
	echo 'Stop messing up the ratings.';
	$stmt = $db->prepare('DELETE FROM `KillersRatings` WHERE `ipaddress` = :ipAddress');
	$stmt->execute(array(':ipAddress' => $ipAddress));
	
	$stmt = $db->prepare('INSERT INTO `Strikes`(`date`, `ipaddress`) VALUES (now(),:ipAddress)');
	$stmt->execute(array(':ipAddress' => $ipAddress));
} else {
	$stmt = $db->prepare('SELECT * FROM `KillersRatings` WHERE `ipaddress` = :ipAddress AND `killerId` = :killerId');
	$stmt->execute(array(':ipAddress' => $ipAddress, ':killerId' => $killerId));

	$numrows = $stmt-> rowCount();
	if($numrows > 0){
		if($rating <= 5 && $rating >= 1){
			$stmt = $db->prepare('UPDATE `KillersRatings` SET `rating` = :rating WHERE `ipaddress` = :ipAddress AND `KillerId` = :killerId');
			$stmt->execute(array(':killerId' => $killerId, ':rating' => $rating, ':ipAddress' => $ipAddress));	
		}
	} else{
		if($rating <= 5 && $rating >= 1){
			$stmt = $db->prepare('INSERT INTO `KillersRatings`(`KillerId`, `rating`, `ipaddress`) VALUES (:killerId, :rating, :ipAddress)');
			$stmt->execute(array(':killerId' => $killerId, ':rating' => $rating, ':ipAddress' => $ipAddress));
		}
	}
	$stmt = $db->prepare('SELECT * FROM `KillersRatings` WHERE `killerId` = :killerId');
	$stmt->execute(array(':killerId' => $killerId));
	$numrows = $stmt-> rowCount();

	$rating = 0;
	$count = 0;
	while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
		$rating = $rating + $row[1];
		$count = $count + 1;
	}

	$newRating = $rating / $count;
	
	$tier = 'F';
	if($newRating >= 4){
		$tier = 'A';
	} else if($newRating >= 3){
		$tier = 'B';
	} else if($newRating >= 2.25){
		$tier = 'C';
	} else if($newRating >= 1.5){
		$tier = 'D';
	}
	
	$stmt = $db->prepare('UPDATE `Killers` SET `Rating` = :rating, `Tier` = :tier WHERE `Id` = :killerId');
	$stmt->execute(array(':killerId' => $killerId, ':rating' => $newRating, ':tier' => $tier));	
	echo $newRating;
}
?>