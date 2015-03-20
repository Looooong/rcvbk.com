<?php
	class Main extends Controller {
		private function init () {
			header("Cache-control: public");
			header("Pragma: cache");
			
			$this->view->loadHeader('main/main.css');
			$this->view->loadTemplate('script');
			
			$this->view->loadBody('main/main.php');
		}
		
		public function index () {
			$this->init();
			$data = array('page'=>'index');
			$this->view->createHTML($data);
		}
		
		public function competition () {
			$this->init();
			$data = array('page'=>'competition');		
			$this->view->createHTML($data);
		}
		
		public function letterToRCV () {
			$this->init();
			$data = array('page'=>'letterToRCV');		
			$this->view->createHTML($data);
		}
		
		public function storyRCV () {
			$this->init();
			$data = array('page'=>'storyRCV');		
			$this->view->createHTML($data);
		}
		
		public function gameRCV () {
			$this->init();
			$data = array('page'=>'gameRCV');		
			$this->view->createHTML($data);
		}
	}
?>