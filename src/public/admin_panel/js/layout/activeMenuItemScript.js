$(document).ready(function(){
    var pathname = window.location.pathname;
    console.log(pathname);
    $( 'a[href*="'+pathname+'"]' ).parent().addClass('active');
});