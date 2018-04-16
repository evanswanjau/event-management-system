$(document).ready(function(){
$(".mover > img").click(function() {

    $('html, body').animate({

        scrollTop: $(".about").offset().top

    }, 1000, 'easeInOutCirc');

});
$('.ignite').hide();
$('.the_request').click(function(){
  $('.ignite').show('slide', {direction:'down', easing: 'easeOutSine'}, 500);
});
$('.car').click(function(){
  $('.ignite').show('slide', {direction:'down', easing: 'easeOutSine'}, 500);
});
$('.hotel').click(function(){
  $('.ignite').show('slide', {direction:'down', easing: 'easeOutSine'}, 500);
});
$('.exit').click(function(){
  $('.ignite').hide('slide', {direction:'down', easing: 'easeOutSine'}, 500);
});

$('.title').hide();
$(".title").show('slide', {direction:'down', easing: 'easeInOutCirc'}, 1000);

$('.quote > p').hide();
$(".quote > p").fadeIn(1500);

//Button for menu category:services
$('.serve_on_menu').hide();
$('.button_serve_on_menu').click(function(){
  $('.serve_on_menu').slideToggle(500);
});

$('.serve_on_menu').mouseleave(function(){
  $('.serve_on_menu').slideToggle(500);
});
//END
//Beggining of sliding code tours and travel
$('#tanzania').hide();
$('#uganda').hide();
$('#rwanda').hide();
$('#zanzibar').hide();

$('.totanzania').click(function(){
  $('#tanzania').show('slide', {direction:'right', easing: 'easeInOutCirc'}, 100, function(){
    $('#kenya').fadeOut(800);
  });
});
/*END*/
/*information on tours and travel*/

/*Beginning of car hire slide in code*/
$('.t1').hide();
$(".t1").show('slide', {direction:'right', easing: 'easeInOutCirc'}, 800);
$('.t2').hide();
$(".t2").show('slide', {direction:'right', easing: 'easeInOutCirc'}, 1000);
/*END*/
/*content code*/
$('.content').hide();
$(".hotel", this).mouseover(function(){
  $(".hotel_imagery", this).animate('slide', {width:'toggle', easing: 'easeInOutCirc'}, 1000);
  $(".content", this).animate('slide', {width:'toggle', easing: 'easeInOutCirc'}, 1000);
});

$(".hotel", this).mouseleave(function(){
  $(".content", this).hide('slide', {direction:'right', easing: 'easeInOutCirc'}, 1000);
  $(".hotel_imagery", this).show('slide', {direction:'left', easing: 'easeInOutCirc'}, 1000);
});
});
