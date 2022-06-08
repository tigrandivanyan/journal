

// find message id which need to be deleted, prepare URL for deletion form and submit it
function deleteFormSubmit(element) {
    var element_type_id =  jQuery(element).data('msg-id');
    var r = confirm('Подтвердите удаление!');
    if (r == true) {
        $('#delete-texh-msg').find('form').attr('action', ' /admin/tech-support/' + element_type_id).submit();
    }

}

// find message data in table, substitute it to form input and prepare form URL
function editFormDisplay(element){

    var msg_id =  jQuery(element).data('msg-id');
    var msg_studio_id =  jQuery(element).data('msg-studio-id');

    jQuery('#edit-'+msg_studio_id).slideToggle();

    var tech_message_order = $('.tech_message_order[data-msg-id='+msg_id+'][data-msg-studio-id='+msg_studio_id+']').html();
    var tech_message_name_ru = $('.tech_message_name_ru[data-msg-id='+msg_id+'][data-msg-studio-id='+msg_studio_id+']').html();
    var tech_message_name_eng = $('.tech_message_name_eng[data-msg-id='+msg_id+'][data-msg-studio-id='+msg_studio_id+']').html();

    $('#form-edit-order-'+msg_studio_id).val(tech_message_order);
    $('#form-edit-name-eng-'+msg_studio_id).val(tech_message_name_ru);
    $('#form-edit-name-ru-'+msg_studio_id).val(tech_message_name_eng);

    $('#edit-'+msg_studio_id).find('form').attr('action',' /admin/tech-support/'+msg_id);






}

// toggle form for adding new description type
function dislayAddDescriptionTypeForm() {
    jQuery('#description-type-create-form-wrapper').slideToggle();
}