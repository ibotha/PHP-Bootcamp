$(document).ready (function load() {
	$("#addbutton").click(addlistelem);
});

function addlistelem() {
	var item = $("#item").val();
	if (item)
		console.log(item);
}