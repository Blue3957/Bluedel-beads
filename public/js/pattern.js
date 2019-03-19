currentColor = "black";

function changeColor(x, y){
	query = ".square.x" + x + ".y" + y;
	console.log(query);
	square = document.querySelector(query);
	square.style.backgroundColor=currentColor;
}

function changeCurrentColor(color){
	currentColor = color;
	document.querySelector(".currentColor").style.backgroundColor = color;
}