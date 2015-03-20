// JavaScript Document
function offset(e1, e2) {
	e1 = (typeof(e1) === 'string') ? document.getElementById(e1) : e1;
	e2 = (typeof(e2) === 'undefined') ? document.body : e2;
	e2 = (typeof(e2) === 'string') ? document.getElementById(e2) : e2;
	return e1.offsetTop - e2.offsetTop;
};