<?php
	require_once("main/begin.php");
?>
<div id="mainContent" data-page="<?=$args['page']?>">
<?php
	require_once("ajax/".$args['page'].".php");
?>
</div>
<script type="text/javascript">
	window.addEventListener('load', function () {
		setTimeout(function () {
			document.getElementById("mainContent").style.opacity = 1;
		}, 1000);
		
		window.history.replaceState({
			requestURL: "http://" + window.location.hostname + "/ajax/<?=$args['page']?>",
			title: "<?=$args['page']?>",
			position: 0
		}, "", window.location.href);
	}, false);
</script>
<?php
	require_once("main/end.php");
?>