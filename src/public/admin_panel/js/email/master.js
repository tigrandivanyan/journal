

// find email id which need to be deleted, prepare URL for deletion form and submit it
function deleteFormSubmit(element) {
    var email_id = jQuery(element).parent('td').parent().find('.email_id').html();
    jQuery('#delete-email').attr( 'action','/admin/email/'+email_id ).submit();
}

// find record data in table, substitute it to form input and prepare form URL
function editFormDisplay(element){
    jQuery('#emailEditFormWrapper').slideToggle();

    var email_id = jQuery(element).parent('td').parent().find('.email_id').html();
    var email_name = jQuery(element).parent('td').parent().find('.email_name').html();
    var email_address = jQuery(element).parent('td').parent().find('.email_address').html();
    var email_status = jQuery(element).parent('td').parent().find('.email_status').html();

    $('#name').val(email_name);
    $('#email').val(email_address);
    if(email_status == 1){
        console.log('its one');
        $('#status').prop('checked', true);
    }else{
        $('#status').prop('checked', false);
    }

    $('#emailEditForm').attr( 'action','/admin/email/'+email_id );
}

// toggle form for adding new description type
function dislayAddEmailForm() {
    jQuery('#email-create-form-wrapper').slideToggle();
}