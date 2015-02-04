<?php
	class systemCookie{
		
		public function existsCookie($mKey) {
			return (isset($_COOKIE[$mKey]));
		}
		
		public function createCookie($mKey, $mValue, $mExpireDate, $mPath) {
				setcookie($mKey, $mValue, $mExpireDate, $mPath);
		}
		
		public function unsetCookie($mKey){
			setcookie($mKey, time()-1);
		}
	}
	
	global $sCookie;
	$sCookie = new systemCookie();
?>
