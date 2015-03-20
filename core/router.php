<?php
	class Router {
		static private $instance;
		private $uri,
			$class = 'Main',
			$method = 'index',
			$args = array();
		
		private function __construct () {
			$this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['HTTP_X_REWRITE_URL'];
			$temp = explode('/', $this->uri);
			
			for ($i = 1; $i < count($temp); $i++) {
				switch ($i) {
					case (1):
						$this->class = empty($temp[$i]) ? $this->class : $temp[$i];
						break;
					case (2):
						$this->method = empty($temp[$i]) ? $this->method : $temp[$i];
						break;
					default:
						$this->args[] = $temp[$i];
				};
			};
			
			$this->route();
		}
		
		static public function getInstance () {
			if (empty(self::$instance))
				self::$instance = new self();
				
			return self::$instance;
		}
		
		private function route () {
			if (file_exists(CONTROLLER_PATH.$this->class.'.php')) {
				require_once(CONTROLLER_PATH.$this->class.'.php');
				
				if (is_subclass_of($this->class, 'Controller')) {
					$controller = new $this->class();
					$method = $this->method;
					if (method_exists($controller, $method)) {
						call_user_func_array(array($controller, $method), $this->args);
					} else
						Debuger::error_404();
				} else
					Debuger::error_404();
			} else
				Debuger::error_404();
		}
	}
?>