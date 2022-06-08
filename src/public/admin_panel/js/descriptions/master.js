

// find description type id which need to be deleted, prepare URL for deletion form and submit it
function deleteFormSubmit(element) {
    var element_type_id =  jQuery(element).data('description-id');
    $('#delete-description').find('form').attr('action',' /admin-panel/description/'+element_type_id).submit();
}

// find dascription type data in table, substitute it to form input and prepare form URL
function editFormDisplay(element){

    var element_type_id =  jQuery(element).data('description-id');
    var element_type_studio_id =  jQuery(element).data('description-studio-id');

    jQuery('#edit-'+element_type_studio_id).slideToggle();

    var description_text = $('.description_text[data-description-id='+element_type_id+'][data-description-studio-id='+element_type_studio_id+']').html();
    var description_type_id = $('.description_type_id[data-description-id='+element_type_id+'][data-description-studio-id='+element_type_studio_id+']').html();
    var description_frequency = $('.description_frequency[data-description-id='+element_type_id+'][data-description-studio-id='+element_type_studio_id+']').html();

    $('#form-edit-frequency-'+element_type_studio_id).val(description_frequency);
    $('#form-edit-text-'+element_type_studio_id).val(description_text);
    $('#edit-'+element_type_studio_id).find('form').attr('action',' /admin-panel/description/'+element_type_id);

    $('#description-type-'+element_type_studio_id).find('.for-searching-id').each(function(){

        console.log($(this).val().toString() + description_type_id.toString());
        if($(this).val().toString() == description_type_id.toString()){
            $(this).attr('selected', true);
        }else{
            $(this).attr('selected', false);
        }
    });




}

// toggle form for adding new description type
function dislayAddDescriptionTypeForm() {
    jQuery('#description-type-create-form-wrapper').slideToggle();
}