var total;

function getRandom(){return Math.ceil(Math.random()* 20);}
function createSum1(){
		var randomNum1 = getRandom(),
			randomNum2 = getRandom();
	total =randomNum1 + randomNum2;
  $( "#question1" ).text("Enter Captcha: " + randomNum1 + " + " + randomNum2 + "=" );  
  $("#ans1").val('');
  checkInput();
}

function checkInput(){
		var input = $("#ans1").val(), 
    	slideSpeed = 200,
      hasInput = !!input, 
      valid = hasInput && input == total;
    $('#message').toggle(!hasInput);
    $('.captcha').prop('disabled', !valid); 
    $('#success').toggle(valid);
    $('#fail').toggle(hasInput && !valid);
}

$(document).ready(function(){
	//create initial sum
	createSum1();
	// On "reset button" click, generate new random sum
	$('.reset1').click(createSum1);
	// On user input, check value
	$( "#ans1" ).keyup(checkInput);
});