$('#settingsBtn').on('click', function(){
  $('#addAnimado').toggleClass('animado');
  $('.settings-box').toggleClass('show-settings-box');
});

$('[data-color-position="principal"]').on('click', function(){
  $('[data-color-position="principal"]').each(function(){
    $(this).removeClass('activo');
  });
  $(this).addClass('activo');

  var newColor1 = $( this ).attr('data-color-pick-1'),
      newColor2 = $( this ).attr('data-color-pick-2'),
      newText = $( this ).attr('data-color-text'),
      logoChange = $( this ).attr('data-sidebar-logo');

  $('[data-color-choice="principal"]').css('background', 'linear-gradient( to right, ' + newColor1 + ', ' + newColor2 + ' )' );
  $('[data-color-choice="principal"]').css('background', '-webkit-linear-gradient( to right, ' + newColor1 + ', ' + newColor2 + ' )' );
  $('[data-logo-change="principal"]').attr( 'src', logoChange );
  $('[set-color-text="principal"]').css('color', newText );
});