ajax = function (url) {
	try { this.request = new XMLHttpRequest(); /* e.g. Firefox */}
	catch(err) {
		try { this.request = new ActiveXObject("Msxml2.XMLHTTP"); /* some versions IE */}
		catch(err) {
			try { this.request = new ActiveXObject("Microsoft.XMLHTTP"); /* some versions IE */}
			catch(err) { this.request = false;};
		};
	};
	
	if (this.request) {
		this.url = url;
		this.request.parent = this;
		this.request.onreadystatechange = this.response;
		this.target = null;
		this.customCallback = null;
	};
};

ajax.prototype.response = function() {
	if(this.readyState == 4) {
		if(this.status == 200) {
			this.parent.target.innerHTML = this.responseText;

			var scripts = this.parent.target.getElementsByTagName("SCRIPT");
			for (var i = 0; i < scripts.length; i++)
				eval(scripts[i].innerHTML);
				
			if (typeof(this.parent.customCallback) === 'function') this.parent.customCallback();
		};
	};
};

ajax.prototype.data2query = function(element, str, deep) {
	var query = "";
	str = (typeof(str) === 'undefined') ? '' : str;
	deep = (typeof(deep) === 'undefined') ? 0 : deep;
	
	for (var i in element) {
		if (typeof(element[i]) === "object") {
			query += data2query(element[i], str + i + (deep ? ']' : '') + '[', deep + 1);
		} else {
			query += str + i + (deep ? ']' : '') + '=' + encodeURIComponent(element[i]) + '&';
		};
	};
	
	return query;
};

ajax.prototype.send = function (target, data, async) {
	this.target = (typeof(target) === 'string') ? document.getElementById(target) : 
					(typeof(target) === 'object') ? target : document.createElement("DIV");
	data = (typeof(data) !== 'object') ? {} : data;
	
	this.request.open("POST", encodeURI(this.url), (typeof(async) === 'undefined') ? true : async);
	this.request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	this.request.send(this.data2query(data).slice(0, -1));
};