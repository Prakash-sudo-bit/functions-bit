$(document).on("click", ".btn2", function () {
    var myPId = $(this).data('id');  // Retrieves the data-id attribute of the clicked button
    $(".modal-body #downid").val(myPId);  // Sets this value in the modal body input field with id 'downid'
});