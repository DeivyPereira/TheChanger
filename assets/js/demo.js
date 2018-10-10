$('#settingsBtn').on('click', function(){
  $('#addAnimado').toggleClass('animado');
  $('.settings-box').toggleClass('show-settings-box');
});



$('[data-color-position="principal"]').on('click', function(){
  $('[data-color-position="principal"]').each(function(){
    $(this).removeClass('activo');
  });
  $(this).addClass('activo')
  
  Cookies.remove('newColor1');
  Cookies.remove('newColor2');
  Cookies.remove('newText');
  Cookies.remove('logoChange');
  Cookies.remove('titleColor');

  var newColor1 = $( this ).attr('data-color-pick-1'),
      newColor2 = $( this ).attr('data-color-pick-2'),
      newText = $( this ).attr('data-color-text'),
      logoChange = $( this ).attr('data-sidebar-logo');
      titleColor = $( this ).attr('data-title-color');

  $('[data-color-choice="principal"]').css('background', '-webkit-linear-gradient( to right, ' + newColor1 + ', ' + newColor2 + ' )' );
  $('[data-color-choice="principal"]').css('background', 'linear-gradient( to right, ' + newColor1 + ', ' + newColor2 + ' )' );
  $('[data-logo-change="principal"]').attr( 'src', logoChange );
  $('[set-color-text="principal"]').css('color', newText );
  $('[data-title-choice="principal"]').css( 'color', titleColor );
  $('#extraStyle').html('.btn.active{background: linear-gradient( to right, ' + newColor1 + ', ' + newColor2 + ' ); color: ' + newText + '}');

  Cookies.set('newColor1',newColor1, { expires: 1 });
  Cookies.set('newColor2',newColor2, { expires: 1 });
  Cookies.set('newText',newText, { expires: 1 });
  Cookies.set('logoChange',logoChange, { expires: 1 });
  Cookies.set('titleColor',titleColor, { expires: 1 });

});

  $('[data-color-choice="principal"]').css('background', 'linear-gradient( to right, ' + Cookies.get('newColor1') + ', ' + Cookies.get('newColor2') + ' )' );
  $('[data-color-choice="principal"]').css('background', '-webkit-linear-gradient( to right, ' + Cookies.get('newColor1') + ', ' + Cookies.get('newColor2') + ' )' );
  $('[data-logo-change="principal"]').attr( 'src', Cookies.get('logoChange') );
  $('[set-color-text="principal"]').css('color', Cookies.get('newText') );
  $('[data-title-choice="principal"]').css( 'color', Cookies.get('titleColor') );

  $('#extraStyle').html('.btn.active{background: linear-gradient( to right, ' + Cookies.get('newColor1') + ', ' + Cookies.get('newColor2') + ' ); color: ' + Cookies.get('newText') + '}');
