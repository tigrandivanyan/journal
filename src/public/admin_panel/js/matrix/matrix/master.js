// show form for logging in entry user and display all the available rooms for that user
function toggleLoginForm(element) {
    var entry_id = jQuery(element).data('entry-id');
    var username = $('.entry-username[data-entry-id='+entry_id+']').html();
    var purpose = $('.entry-purpose[data-entry-id='+entry_id+']').html();

    $('#username').val(username);
    $('#purpose').val(purpose);
    $('#entry_id').val(entry_id);
    jQuery('#login-form-wrapper').slideToggle();
}

// display the form for adding new matrix user
function dislayAddNewUserForm() {
    jQuery('#newUserFormWrapper').slideToggle();
}
//delete record of matrix room and binded user
function deleteEntry(element) {
    var entry_id = jQuery(element).data('entry-id');
    $('#room_record_id').val(entry_id);
    $('#delete-entry').submit();
}