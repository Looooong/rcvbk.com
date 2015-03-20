<ul id="navigator">
	<li>
		<a data-title="index" data-article="header" id="mainIndexLink" href="/main/index">Trang Chủ</a>
		<ul>
			<li><a data-title="index" data-article="ThisYear" href="/main/index#ThisYear">Rung Chuông Vàng 2014</a></li>
			<li><a data-title="index" data-article="Introduction" href="/main/index#Introduction">Lời Giới Thiệu</a></li>
		</ul>
	</li>
	<li>
		<a data-title="competition" data-article="" href="/main/competition">Cuộc Thi</a>
		<ul>
        	<li><a data-title="competition" data-article="Instruction" href="/main/competition#Instruction">Hướng Dẫn Tham Gia</a></li>
			<li><a data-title="competition" data-article="Rule" href="/main/competition#Rule">Luật Thi</a></li>
            <li><a data-title="competition" data-article="Awards" href="/main/competition#Awards">Giải Thưởng</a></li>
			<li><a data-title="competition" data-article="Research" href="/main/competition#Research">Nghiên Cứu</a></li>
		</ul>
	</li>
    <li>
    	<a>Góc Bí Ẩn</a>
        <ul>
        	<li><a data-title="letterToRCV" data-article="LetterToRCV" href="/main/letterToRCV#LetterToRCV">Thư Gửi Rung Chuông Vàng</a></li>
            <li><a data-title="gameRCV" data-article="GameRCV" href="/main/gameRCV#GameRCV">Trò Chơi Rung Chuông Vàng</a></li>
            <li><a data-title="storyRCV" data-article="StoryRCV" href="/main/storyRCV#StoryRCV">Câu Truyện Rung Chuông Vàng</a></li>
        </ul>
    </li>
</ul>
<script type="text/javascript">
	window.addEventListener('load', function () {
		var a = document.getElementById("navigator").getElementsByTagName("a");
		var b = document.getElementById("mainContent");
		
		var requestID = null;
		var scrollID = null;
		
		var c = function (e) {
			var title = e.getAttribute("data-title");
			var request = new ajax("http://" + window.location.hostname + "/ajax/" + title);
			
			return function () {
				if (b.getAttribute("data-page") !== title) {
					if (requestID) {
						clearTimeout(requestID);
						requestID = null;
					};
					
					b.style.opacity = 0;
					
					request.customCallback = function () {
						if (scrollID) {
							clearTimeout(scrollID);
							scrollID = null;
						};
						
						b.style.opacity = 1;
						b.setAttribute("data-page", title);
						
						window.history.pushState({
							requestURL: request.url,
							title: title,
							position: e.getAttribute("data-article") ? offset(e.getAttribute("data-article")) : 0
						}, "", "http://" + window.location.hostname + "/main/" + title + (e.getAttribute("data-article") ? "#" + e.getAttribute("data-article") : ''));
						
						if (e.getAttribute("data-article"))
							scrollID = setTimeout(function () {
								scrollElement(document.body, offset(e.getAttribute("data-article")));
							}, 1000);
					};
					
					requestID = setTimeout(function () {
						request.send("mainContent", {}, false);
					}, 1000);
				} else {
					window.history.replaceState({
						requestURL: request.url,
						title: title,
						position: e.getAttribute("data-article") ? offset(e.getAttribute("data-article")) : 0
					}, "", "http://" + window.location.hostname + "/main/" + title + (e.getAttribute("data-article") ? "#" + e.getAttribute("data-article") : ''));
					
					if (e.getAttribute("data-article"))
						scrollElement(document.body, offset(e.getAttribute("data-article")));
				};
				
				return false;
			};
		};
		
		for (var i = 0; i < a.length; i++) {
			if (a[i].getAttribute("data-title"))
				a[i].onclick = c(a[i]);
		};
		
		window.addEventListener('popstate', function (e) {
			if (e.state) {
				if (b.getAttribute("data-page") !== e.state.title) {
					if (requestID) {
						clearTimeout(requestID);
						requestID = null;
					};
					
					b.style.opacity = 0;
					var request = new ajax(e.state.requestURL);
					
					request.customCallback = function () {
						if (scrollID) {
							clearTimeout(scrollID);
							scrollID = null;
						};
						
						b.style.opacity = 1;
						b.setAttribute("data-page", e.state.title);
						
						if (e.state.position)
							scrollID = setTimeout(function () {
								scrollElement(document.body, e.state.position);
							}, 1000);
					};
					
					requestID = setTimeout(function () {
						request.send("mainContent", {}, false);
					}, 1000);
				};
			};
		}, false);
	}, false);
</script>