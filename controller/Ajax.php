<?php
	class Ajax extends Controller {
		public function index () {
			include("ajax/index.php");	
		}
		
		public function competition () {
			include("ajax/competition.php");	
		}
		
		public function eventMap () {
			include("ajax/eventMap.php");
		}
		
		public function letterToRCV () {
			include("ajax/letterToRCV.php");	
		}
		
		public function storyRCV () {
			include("ajax/storyRCV.php");	
		}
		
		public function gameRCV () {
			include("ajax/gameRCV.php");	
		}
	};
?>