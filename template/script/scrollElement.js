window.addEventListener('load', function () {
	var ss, sss, id = null, start, min = 10;
	
	window['scrollElement'] = function (e, pos) {
		if (id) {
			clearInterval(id);
			id = null;
		};

		e = typeof(e) === 'string' ? document.getElementById(e) : e;
		s = pos - e.scrollTop;
		
		if (Math.abs(s) < min)
			e.scrollTop = pos;
		else {
			sss = s > 0 ? -200 : 200;
			ss = s - sss/2;
			s = e.scrollTop;
			
			start = Date.now();
			id = setInterval(function () {
				var DeltaTime = Date.now() - start;
				e.scrollTop = s + ss*DeltaTime/1000 + sss*DeltaTime/1000*DeltaTime/1000/2;
				if (DeltaTime > 1000) {
					clearInterval(id);
					id = null;
					e.scrollTop = pos;
				};
			}, 20);
		};
	};
}, false);