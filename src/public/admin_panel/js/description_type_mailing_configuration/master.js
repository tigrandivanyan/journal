
// find dascription type data in table, substitute it to form input and prepare form URL
function editButtonPress(element){

    jQuery('#descriptionTypeEditFormWrapper').slideToggle();

    var description_type_id = jQuery(element).data('type-value');
    var description_type_ru_name = $('.description_type_ru_name[data-type-value='+description_type_id+']').html();
    var description_type_eng_name = $('.description_type_eng_name[data-type-value='+description_type_id+']').html();
    var description_type_email = $('.description_type_email[data-type-value='+description_type_id+']').html();

    $('#ru_name').text(description_type_ru_name);
    $('#eng_name').text(description_type_eng_name);
    $('#typeId').val(description_type_id);


    if(description_type_email == 1){
        $('#descriptionTypeMailingStatus').prop('checked', true);
    }else{
        $('#descriptionTypeMailingStatus').prop('checked', false);
    }

}
