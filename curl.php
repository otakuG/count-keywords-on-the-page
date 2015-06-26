<?php
	class Curl {
		private $curl;

		function __construct() {
			$this->curl = curl_init();

			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->curl,CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($this->curl,CURLOPT_SSL_VERIFYPEER,0);
		}

		function getContent($url) {
			curl_setopt($this->curl, CURLOPT_URL, $url);
			
			$html = curl_exec($this->curl);

			preg_match("~<body[^>]*>(.*?)</body>~si", $html, $output);

			return $output[0];
		}

		function __destruct() {
			curl_close($this->curl);
		}
	}
?>