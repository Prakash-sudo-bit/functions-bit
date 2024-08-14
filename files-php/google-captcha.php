<!-- Form -->
<div class="captchasec">
    <div class="g-recaptcha" data-sitekey="6Lfve-8pAAAAALafxh1nbs-H3hxbd9aR_UtHY09d" data-callback="verifyCaptcha"></div>
    <div id="g-recaptcha-error"></div>	
</div>


<!-- Link -->
<script src="https://www.google.com/recaptcha/api.js" defer></script>


<!-- Script -->
<script>
function submitUserForm() {
    var response = grecaptcha.getResponse();
    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
    return true;
}
 
function verifyCaptcha() {
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>