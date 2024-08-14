<div class="form-size fwidth">
    <textarea name="message" id="message" placeholder="Message*" class="form-control" rows="3" maxlength="50" required oninput="updateCharCount()"></textarea>
    <div class="char-count" id="charCount">50 characters remaining</div>
</div>

<script>
    function updateCharCount() {
        var textarea = document.getElementById('message');
        var charCount = document.getElementById('charCount');
        var remaining = 50 - textarea.value.length;
        charCount.textContent = remaining + " characters remaining";
    }
</script>