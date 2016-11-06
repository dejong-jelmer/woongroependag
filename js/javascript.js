$(document).ready(function() {

    // Create a clone of the menu, right next to original.
    $('.menu').addClass('original').clone().insertAfter('.menu').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

    scrollIntervalID = setInterval(stickIt, 10);


    function stickIt() {

      var orgElementPos = $('.original').offset();
      orgElementTop = orgElementPos.top;

      if ($(window).scrollTop() >= (orgElementTop)) {
        // scrolled past the original position; now only show the cloned, sticky element.

        // Cloned element should always have same left position and width as original element.
        orgElement = $('.original');
        coordsOrgElement = orgElement.offset();
        leftOrgElement = coordsOrgElement.left;
        widthOrgElement = orgElement.css('width');
        $('.cloned').css('left',leftOrgElement+'px').css('top', 0).show();
        $('.original').css('visibility', 'hidden');
        $('.cloned>.logo').animate({'width':'35px', 'height':'35px'}, 500);
        $('.cloned>.banner').animate({'font-size':'1.2em', 'margin':'5px 88px 5px 10px'}, 500);
        $('.cloned>li>a').animate({'padding-top':'10px', 'padding-bottom':'10px'}, 500);

      } else {
        // not scrolled past the menu; only show the original menu.
        $('.cloned').hide();
        $('.original').css('visibility','visible');
      }
    }

    // creert een extra inschrijfveld op de opgeefpagina
    var index = 0;
    $('#extraPerson').click(function() {
      index++;
      $('#multiSigninField').removeClass('hidden').append($('#signinField').clone().attr('id', 'signinField'+index).fadeIn());
      $('#removeButton').removeClass('hidden');
      $('#signinField'+index+' :input').each(function() {
        $(this).val('');
        $(this).attr('name', $(this).attr('name')+index);
      });
      // maakt de bevestigingstekst meervoud
      $('#confirmTextI').text('Wij komen');
      $('#confirmTextII').text('wij komen');
    });

    $('#removeButton').click(function() {
      $('#multiSigninField>div:last-child').remove();
      index--;
      if(index == 0) {
        $('#removeButton').addClass('hidden');
        // maakt de bevestigingstekst enkelvoud
        $('#confirmTextI').text('Ik kom');
        $('#confirmTextII').text('ik kom');
      } else {
        $('#removeButton').removeClass('hidden');
      };
    });

  // voegt index van het aantal gemaakte nieuwe velde toe aan POST om in php loop te gebruiken.
    $('#submit').click(function(){
        $('#index').attr('value', index);
    });

    //creert extra formuliervelden als checkbox aangevinkt wordt
    $('#organisatie').click(function(){
      $("#organisatieVelden").toggle();
    });

    $('#nav_menu_icon').click(function() {
      var windowWitdh = $(window).width();
      var documentWidth = $(document).width();
      if (windowWitdh < '950' || documentWidth < '950') {
          $('.menu').slideToggle();
        $('.section').click(function(){
          $('.menu').slideUp();
        });
      }
    });


    // laat het mail bevestigingsscherm langzaam verdwijnen.
    $('.mail_conf').fadeOut(7000);
    // sluit het mail bevestigingsscherm.
    $('#windowClose').click(function(){
      $('.mail_conf').hide();
    });


});

// googlemaps locatie script
function initialize() {

  var mapProp = {
    center:new google.maps.LatLng(51.8652750,5.877600),
    zoom:17,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

  var marker=new google.maps.Marker({
    position:new google.maps.LatLng(51.8652750,5.877600),

  });
  marker.setMap(map);
}
