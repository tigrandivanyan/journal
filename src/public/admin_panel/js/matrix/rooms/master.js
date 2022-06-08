

// find id and name of room which need to be saved for active room, prepare URL for saving form and submit it
function chooseRoomFormSubmit(element) {
    console.log('action');

    var entry_value = jQuery(element).data('entry-value');
    console.log(entry_value);
    var room_id = $('.room-id[data-entry-value='+entry_value+']').html();
    var room_name = $('.room-name[data-entry-value='+entry_value+']').html();

    console.log(room_id);
    console.log(room_name);

    $('#room_id').val(room_id);
    $('#room_name').val(room_name);

    jQuery('#choose-room-id').submit();
}
