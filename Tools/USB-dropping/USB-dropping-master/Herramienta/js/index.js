$(document).on('click', '.custom_checkbox', function(){
  $(this).toggleClass('active');
  $("#check-hidden").prop('checked', $(this).is(':checked'));
});