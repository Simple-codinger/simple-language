<?php
	require_once('class.cookie.manager.php');
	/*Author Gierisch Vincent*/
	/* http://www.uebersetzungen.in/sprachkuerzel-nach-iso_639-1/ */
	class systemLanguage{
		private $mLanguage = 'en'; //this is the default Language, if you want to take the browser language you have to let it empty
		private $mLanguageFile = 'http://localhost/simple/simplelanguage/core/lan.xml'; //Path to language file

		public $mXmlFile;
		private $mDefaultLanguage;
		private $mCookieName = 'language';
		
		public function __construct(){
			/*if DefaultLanguage is not set then get BrowserLanguage*/
			$this->mDefaultLanguage = $this->mLanguage == "" ? $this->getBrowserLang() : $this->mLanguage;
			//if cookie is set, than get the "cookie language"
			$this->getCookieLang();
			$this->mXmlFile = simplexml_load_file($this->mLanguageFile);
			if(!$this->mXmlFile){die("Could not read xml file");};
		}
		
		private function getBrowserLang(){
			return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		}
		
		private function getCookieLang(){
			global $sCookie;
			if($sCookie->existsCookie($this->mCookieName)){
				$this->mDefaultLanguage = $_COOKIE[$this->mCookieName];
			}
		}
		
		public function getString($key, $lan="conf"){
			//if you want this string in a specific language, you can make that with the second param.
			if($lan=="conf"){$lan=$this->mDefaultLanguage;}
			foreach($this->mXmlFile->xpath('language[@lan="'.$lan.'"]/lanString[@key="'.$key.'"]') as $lanString){
				return $lanString;
			}
		}
		
		public function getLanguages(){
			$languageArray = array();
			for($i = 0; $i < count($this->mXmlFile->language); $i++)
			{
				$lan = (string)($this->mXmlFile->language[$i]->attributes()->lan);
				$languageArray[$lan] =  (string)($this->mXmlFile->language[$i]->attributes()->name);
			}
			return $languageArray;
		}
	}
	global $sLanguage;
	$sLanguage = new systemLanguage();
?>
