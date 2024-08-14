var input = document.querySelector("#phone");  

  window.intlTelInput(input, {
    separateDialCode: true,
	 initialCountry: "IN",
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
  });

  var iti = window.intlTelInputGlobals.getInstance(input);

  input.addEventListener('input', function() {
    var fullNumber = iti.getNumber();
    document.getElementById('fullNumber').value = fullNumber;
    
    var isValidForRegion = iti.isValidNumber();
    
    if (isValidForRegion) {
      document.getElementById('error-msg').classList.add('hide');
      document.getElementById('valid-msg').classList.remove('hide');
    } else {
      document.getElementById('error-msg').classList.remove('hide');
      document.getElementById('valid-msg').classList.add('hide');
    }
  });
  
  
  

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

 	return true;
}