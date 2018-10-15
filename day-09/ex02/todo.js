window.onload = function load() {
	if (getCookie('list'))
		var list = JSON.parse(getCookie('list'));
	else
		var list = new Array;
	list.forEach(function loop(value, index) {
		document.getElementById("ft_list").innerHTML += '<a onclick="remove(this)" id="' + index + '">' + value + '</a><br>';
	});
	document.getElementById("addbutton").addEventListener("click", addlistelem);
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function addlistelem() {
	if (getCookie('list'))
		var list = JSON.parse(getCookie('list'));
	else
		var list = new Array;
	if (document.getElementById("item").value)
		list.push(document.getElementById("item").value);
	document.cookie = 'list=' + JSON.stringify(list) + '; expires=Thu, 18 Dec 3000 12:00:00 UTC';
	location.reload();
}

function remove(bob) {
	console.log("bye");
	if (getCookie('list'))
		var list = JSON.parse(getCookie('list'));
	else
		var list = new Array;
	list.pop(bob.id);
	document.cookie = 'list=' + JSON.stringify(list) + '; expires=Thu, 18 Dec 3000 12:00:00 UTC';
	location.reload();
}