<?php
	class Debuger {
		static public function inspect($object) {
			echo '<pre>';
			print_r($object);
			echo '</pre>';
		}
		
		static public function error_404 () {
			header('HTTP/1.0 404 Not Found');
			echo '<h1>404 - Page not found</h1>';
			exit;
		}
	};
?>