

// find description type id which need to be deleted, prepare URL for deletion form and submit it
function deleteFormSubmit(element) {
    var description_type_id = jQuery(element).data('type-value');
    $('#typeIdForDelete').val(description_type_id);
    jQuery('#delete-description-type').submit();
}

// find dascription type data in table, substitute it to form input and prepare form URL
function editFormDisplay(element){
    jQuery('#descriptionTypeEditFormWrapper').slideToggle();

    var description_type_id = jQuery(element).data('type-value');
    var description_type_ru_name = $('.description_type_ru_name[data-type-value='+description_type_id+']').html();
    var description_type_eng_name = $('.description_type_eng_name[data-type-value='+description_type_id+']').html();
    var description_type_allow_to_edit = $('.description_type_allow_to_edit[data-type-value='+description_type_id+']').html();

    $('#ru_name').val(description_type_ru_name);
    $('#eng_name').val(description_type_eng_name);
    $('#typeId').val(description_type_id);
    if(description_type_allow_to_edit == 1){
        $('#allow_to_edit_edit').prop('checked', true);
    }else{
        $('#allow_to_edit_edit').prop('checked', false);
    }

}

// toggle form for adding new description type
function dislayAddDescriptionTypeForm() {
    jQuery('#description-type-create-form-wrapper').slideToggle();
}