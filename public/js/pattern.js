

////////////////////////////
///// GLOBAL VARIABLES /////
////////////////////////////


currentColor = "black";
lineTool = false;
rectangleTool = false;


////////////////////////////
//////// FUNCTIONS /////////
////////////////////////////


/**
* Changes the color of the square at the given coordinates
* @param int x value
* @param int y value
*/
function changeColor(x, y){
	var query = ".square.x" + x + ".y" + y;
	var square = document.querySelector(query);
	square.style.backgroundColor=currentColor;
}

/**
* Changes the current color global variable and indicator on screen
* @param string css valid color
*/
function changeCurrentColor(color){
	currentColor = color;
	document.querySelector(".currentColor").style.backgroundColor = color;
}

/**
* Changes the opacity of a given layer
* @param string layer
* @param int percentage to change the opacity to
*/
function changeOpacity(layer, value){
	if(layer === 'background'){
		document.querySelector('#image').style.opacity = value * 0.01;
	}
	else if(layer === 'foreground'){
		var squares = document.querySelectorAll('.square')
		squares.forEach( function(square, index) {
			square.style.opacity = value * 0.01;
		});
	}
}

function moveHorizontally(value){
	var image = document.querySelector('#image');
	var margin = image.style.marginLeft.substring(0, image.style.marginLeft.length-2);
	margin = parseInt(margin) + value;
	image.style.marginLeft = margin + "px";
}

function moveVertically(value){
	var image = document.querySelector('#image');
	var margin = image.style.marginTop.substring(0, image.style.marginTop.length-2);
	margin = parseInt(margin) + value;
	image.style.marginTop = margin + "px";
}

function zoom(value){
	document.querySelector('#image').style.height = (value * 8) + "px";
}


////////////////////////////
////////// TOOLS ///////////
////////////////////////////


/**
* Toggles the line tool on or off
*/
function toggleLineTool(){
	var button = document.querySelector('#lineButton');
	var squares = document.querySelectorAll('.square');
	if(lineTool === true){
		lineTool = false;
		console.log('deactivating!')
		button.classList.remove('btn-primary');
		button.classList.add('btn-outline-primary');
		squares.forEach( function(square, index) {
			square.removeEventListener("mousedown", beginLine);
			square.removeEventListener("mouseup", endLine);
		});
	}
	else{
		if(rectangleTool === true) toggleRectangleTool();
		lineTool = true;
		console.log('activating!')
		button.classList.remove('btn-outline-primary');
		button.classList.add('btn-primary');
		squares.forEach( function(square, index) {
			var x = square.classList[1].slice(1);
			var y = square.classList[2].slice(1);
			square.addEventListener("mousedown", function(){beginLine(x, y)});
			square.addEventListener("mouseup", function(){endLine(x, y)});
		});
	}
}

/**
* Toggles the rectangle tool on or off
*/
function toggleRectangleTool(){
	var button = document.querySelector('#rectangleButton');
	var squares = document.querySelectorAll('.square');
	if(rectangleTool === true){
		rectangleTool = false;
		console.log('deactivating!')
		button.classList.remove('btn-primary');
		button.classList.add('btn-outline-primary');
		squares.forEach( function(square, index) {
			square.removeEventListener("mousedown", beginRectangle);
			square.removeEventListener("mouseup", endRectangle);
		});
	}
	else{
		if(lineTool === true) toggleLineTool();
		rectangleTool = true;
		console.log('activating!')
		button.classList.remove('btn-outline-primary');
		button.classList.add('btn-primary');
		squares.forEach( function(square, index) {
			var x = square.classList[1].slice(1);
			var y = square.classList[2].slice(1);
			square.addEventListener("mousedown", function(){beginRectangle(x, y)});
			square.addEventListener("mouseup", function(){endRectangle(x, y)});
		});
	}
}

/**
* @var array Contains the coordinates of the start of a line if one is currently being traced
*/
lineStart = [];

/**
* Stocks the coordinates of the starting square of a new line
* @param int x value
* @param int y value
*/
function beginLine(x, y){
	lineStart = [x, y];
}

/**
* Finishes a started line
* @param int x value
* @param int y value
*/
function endLine(x, y){
	if(x == lineStart[0]){
		var yStart = Math.min(lineStart[1], y);
		var yEnd = Math.max(lineStart[1], y);
		for(var i = yStart ; i <= yEnd ; i++){
			changeColor(x, i);
		}
	}
	if(y == lineStart[1]){
		var xStart = Math.min(lineStart[0], x);
		var xEnd = Math.max(lineStart[0], x);
		for(var i = xStart ; i <= xEnd ; i++){
			changeColor(i, y);
		}
	}
	lineStart = [];
	console.log(lineStart);
}

/**
* @var array contains the coordinates of the start of a rectangle if one is currently being traced
*/
rectangleStart = [];

/**
* Stocks the coordinates of the starting square of a new rectangle
* @param int x value
* @param int y value
*/
function beginRectangle(x, y){
	rectangleStart = [x, y];
}

/**
* Finishes a started rectangle
* @param int x value
* @param int y value
*/
function endRectangle(x, y){
	var xStart = Math.min(rectangleStart[0], x);
	var xEnd = Math.max(rectangleStart[0], x);
	for(var i = xStart ; i <= xEnd ; i++){
		beginLine(i, rectangleStart[1]);
		endLine(i, y);
	}
	rectangleStart = [];
}
