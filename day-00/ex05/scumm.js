var action;

function action_func(tom)
{
	action = tom.title;
}

function go_away(tom)
{
	document.getElementById("speak").style.display = "block";
	if (action == "Advance")
		document.getElementById("speak").innerText = "GO AWAY!";
	if (action == "Look")
		document.getElementById("speak").innerText = "Ummm do you need something?!";
	if (action == "Take")
		document.getElementById("speak").innerText = "Hey! That's my wallet!";
	if (action == "Use")
		document.getElementById("speak").innerText = "I ain't for free!";
	if (action == "Speak")
		document.getElementById("speak").innerText = "Hey, how are you?";
}

function hide(tom)
{
	tom.style.display = "none";
}