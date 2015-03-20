<?php
	$registationDay = mktime(18, 0, 0, 5, 6, 2014);
	$diff = $registationDay - time();
	
	if ($diff > 0) {
	?>
		<div id="countDownClock" class="clock">
		</div>
		<script>
			(function () {
				var ID = null;
				var now, diff, end = new Date(<?=$registationDay*1000?>);
				var a = document.getElementById("countDownClock");
						
				const day    = 1000*60*60*24;
				const hour   = 1000*60*60;
				const minute = 1000*60;
				const second = 1000;
						
				function fill(value) {
					return parseInt(value) > 9 ? value : '0' + value;
				};
						
				ID = setInterval(function () {
					now = new Date();
					diff = end.getTime() - now.getTime();
					if (diff > 0)
						a.innerHTML = (diff/day|0) + ' '
									+ fill((diff%day)/hour|0) + ':'
									+ fill((diff%hour)/minute|0) + ':'
									+ fill((diff%minute)/second|0);
					else {
						clearInterval(ID);
						ID = null;
									
						var eventMap = new ajax("http://" + window.location.hostname + "/ajax/eventMap");
						eventMap.send("eventMap");
					};
				}, second);
			})();
		</script>
<?php
} else {
?>
	<a class="strong" href="https://docs.google.com/forms/d/1TQ8W0GguKtfQCAwNKGzyEb0NziqHHxXBT_nzq8MgDT0/viewform" target="register">Tham Gia Ngay</a>
<?php
};
?>