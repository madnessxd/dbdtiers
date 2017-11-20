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
    <title>Dead by Daylight - Tier list</title>
	<link rel="stylesheet" href="dbd.css">
	<link rel="icon" type="image/png" sizes="64x64" href="favicon.png">
	<meta name="description" content="Website of Dennis Reep. Playground for trying out pieces of code.">
	<meta name="author" content="Dennis Reep">
  </head>';

	$ratingStars = '<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star1" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star1.png" width="32" height="32" alt="star1" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star0.5.png" width="32" height="32" alt="star0.5" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star0.png" width="32" height="32" alt="star0" />' . 
	'<img src="https://dennisreep.nl/dbd/stars/star0.png" width="32" height="32" alt="star0" />';  
  
echo '<body><div class="bodyDiv">';
echo '<a href="killer.php" class="homePageLinks">KILLER PERKS</a><br/>';
echo '<a href="survivor.php" class="homePageLinks">SURVIVOR PERKS</a><br/>';
echo '<a href="killers.php" class="homePageLinks">KILLERS</a><br/>';
echo '<h1>(You can rate perks/killers by clicking on the stars behind them. ' . $ratingStars . ')</h1><br/><br/>';
echo '<h1>Donations for buying a .com domain name and paying for my bandwidth.<br/> I only need about $5 a month max.</h1>';
echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
</form>
';
echo '</div></body></html>';
?>