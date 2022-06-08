

// find user id which need to be deleted, prepare URL for deletion form and submit it
function deleteUserFormSubmit(element) {
    var user_id = jQuery(element).parent('td').parent().find('.user_id').html();
    jQuery('#delete-user').attr( 'action','/admin-panel/user/'+user_id ).submit();
}

// find record data in table, substitute it to edit-form inputs, prepare form URL and show the form
function editUserFormDisplay(element){

    jQuery('#userEditFormWrapper').slideToggle();
    var path = jQuery(element).parent('td').parent();
    var user_name = path.find('.user_name').html();
    var user_username = path.find('.user_username').html();
    var user_operator_id = path.find('.user_operator_id').html();
    var user_chef_id = path.find('.user_chef_id').html();
    var user_id = path.find('.user_id').html();

    $('#name').val(user_name);
    $('#username').val(user_username);
    $('#operator_id').val(user_operator_id);
    $('#chef_id').val(user_chef_id);
    $('#userEditForm').attr( 'action','/user/'+user_id );

}

// find record data in table, substitute it to edit-form inputs, prepare form URL and show the form
function editUserPasswordFormDisplay(element){

    jQuery('#userChangePasswordFormWrapper').slideToggle();
    var user_id = jQuery(element).parent('td').parent().find('.user_id').html();
    $('#userChangePasswordForm').attr( 'action','/userpass/'+user_id );
}

// toggle form for adding new user
function displayAddUserForm() {
    jQuery('#user-create-form-wrapper').slideToggle();
}

