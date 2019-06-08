digits = [
				"zero",
				"one",
				"two",
				"three",
				"four",
				"five",
				"six",
				"seven",
				"eight",
				"nine"
			];

teens = [
				"ten",
				"eleven",
				"twelve",
				"thirteen",
				"fourteen",
				"fifteen",
				"sixteen",
				"seventeen",
				"eighteen",
				"nineteen"
			];

tens = [
				"twenty",
				"thirty",
				"fourty",
				"fifty",
				"sixty",
				"seventy",
				"eighty",
				"ninety"
			];

function toLetters(number){
	var result = "";
	number = number.toString();
	if( number.length < 2 ){
		result = digits[number];
	}
	else if(number.length == 2){
		if(number < 20){
			result = teens[(number - 10)];
		}
		else{
			result = tens[(number[0] - 2)];
			if(number[1] != 0){
				result += " " + digits[number[1]];
				}
			}
	}
	console.log(result);
}