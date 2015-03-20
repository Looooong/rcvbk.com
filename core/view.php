<?php
	class View {
		private $title = TITLE,
			$icon = ICON_PATH,
			$charset = 'utf-8',
			$header = array(),
			$body = array();
		
		public function loadHeader ($path) {
			if (file_exists($path))
				$this->header[] = $path;
		}
		
		public function loadBody ($path) {
			if (file_exists($path))
				$this->body[] = $path;
		}
		
		public function loadTemplate ($name) {
			$path = TEMPLATE_PATH.$name.'/';
			if (is_dir($path)) {
				$dir = scandir(TEMPLATE_PATH.$name);
				
				if ($dir) {
					for ($i = 0; $i < count($dir); $i++) {
						$ext = pathinfo($path.$dir[$i], PATHINFO_EXTENSION);
						
						if (!empty($ext)) {
							switch ($ext) {
								case ('php'):
								case ('html'):
									$this->loadBody($path.$dir[$i]);
									break;
								case ('js'):
								case ('css'):
									$this->loadHeader($path.$dir[$i]);
									break;
							};
						};
					};
				};
			};
		}
		
		private function createHeader () {
			echo '<head>';
			echo '<meta charset="'.$this->charset.'">';
			echo '<title>'.$this->title.'</title>';
			echo '<link rel="icon shortcut" href="'.$this->icon.'" type="image/x-icon" />';
			
			$cssHeader = "";
			$jsHeader = "";
			$customHeader = "";
			
			foreach ($this->header as $data) {
				$ext = pathinfo($data, PATHINFO_EXTENSION);
				
				if (!empty($ext)) {
					switch ($ext) {
						case ("css"):
							$cssHeader .= '<link rel="stylesheet" type="text/css" href="/'.$data.'">';
							break;
						case ("js"):
							$jsHeader .= '<script type="text/javascript" src="/'.$data.'"></script>';
							break;
						case ("php"):
						case ("html"):
							$customHeader .= file_get_contents($data);
					};
				};
			};
			
			echo $cssHeader;
			echo $jsHeader;
			echo $customHeader;
			
			echo '</head>';
		}
		
		private function createBody (&$args) {
			echo '<body>';
			
			foreach ($this->body as $data) {
				$ext = pathinfo($data, PATHINFO_EXTENSION);
				
				if (!empty($ext)) {
					switch ($ext) {
						case ("php"):
						case ("html"):
							include($data);
							break;
						case ("js"):
							echo '<script type="text/javascript">';
							echo file_get_contents($data);
							echo '</script>';
							break;
						case ("css"):
							echo '<style type="text/css">';
							echo file_get_contents($data);
							echo '</style>';
							break;
					};
				};
			};
			echo '</body>';
		}
		
		public function createHTML (&$data = array()) {
			echo '<!doctype html>';
			echo '<html>';
			$this->createHeader();
			$this->createBody($data);
			echo '</html>';
		}
	}
?>