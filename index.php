<?php
	require_once('core/class.language.php');
	var_dump($sLanguage->getLanguages());
	echo $sLanguage->getString('language');
	echo $sLanguage->getString('language', 'de');
?>
