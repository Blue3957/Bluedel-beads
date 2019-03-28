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

lineTool = false;

function toggleLineTool(){
	button = document.querySelector('#lineButton');
	if(lineTool === true){
		lineTool = false;
		console.log('deactivating!')
		button.classList.remove('btn-primary');
		button.classList.add('btn-outline-primary');
	}
	else{
		lineTool = true;
		console.log('activating!')
		button.classList.remove('btn-outline-primary');
		button.classList.add('btn-primary');
	}
}

lineStart = [];

function beginLine(x, y){
	if(lineTool === false) return;
	lineStart = [x, y];
}

function endLine(x, y){
	if(lineTool === false) return;
	if(x == lineStart[0]){
		console.log('same x');
		yStart = Math.min(lineStart[1], y);
		yEnd = Math.max(lineStart[1], y);
		for(var i = yStart ; i <= yEnd ; i++){
			changeColor(x, i);
		}
	}
	if(y == lineStart[1]){
		console.log('same y');
		xStart = Math.min(lineStart[0], x);
		xEnd = Math.max(lineStart[0], x);
		for(var i = xStart ; i <= xEnd ; i++){
			changeColor(i, y);
		}
	}
	lineStart = [];
	console.log(lineStart);
}

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