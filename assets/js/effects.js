$(document).ready(function(){


    $(window).on('scroll', function () {
    
    var elmt   = $('.from-left, .from-right, .from-bottom, .from-center');
    var topImg = $('.from-left, .from-right, .from-bottom, .from-center').offset().top;
    var scroll = $(window).scrollTop();
    
        $(elmt).each(function() {
            
            var topImg = $(this).offset().top - 400;
            
                if ( topImg < scroll ) {
                
                $(this).css("transform", "translate(0,0)");
                $(this).css("opacity", "1");
                
                };
        });

    });

    
});


// Animation acceuil

$(function() {
    var text= new Array();
    text.push("Bienvenue !");
    text.push("Je m'appelle Matthieu Le Verger");
    text.push("Je fais du developpement web");
    text.push("Découvrez mon profil !");
    


    var i=0;
    interval = setInterval(function(){
      $('#welcome').text(text[i]);
      //get a list of letters from the welcome text
    var $wordList = $('#welcome').text().split("");
    //clear the welcome text msg
    $('#welcome').text("");
    //loop through the letters in the $wordList array
    $.each($wordList, function(idx, elem) {
      //create a span for the letter and set opacity to 0
      var newEL = $("<span/>").text(elem).css({
        opacity: 0
      });
      //append it to the welcome message
      newEL.appendTo('#welcome');
      //set the delay on the animation for this element
      newEL.delay(idx * 35);
      //animate the opacity back to full 1
      newEL.animate({
        opacity: 1
      }, 1100);
      
    });
    i++;
    if(i>text.length-1)
    {
      clearInterval(interval);
    }
    }, 4000)  
  });

  function changeText() {
    var text= new Array();
    text.push("Bienvenuexxxx !");
    text.push("Je m'appelle Matthieu Le Verger");
    text.push("Et je fais du developpement web");
    document.getElementById("welcome").src = text[index];

    var index = 0;
    if(index < text.length - 1){
      index++;
    }
    else
    {
      index = 0;
    }
};



// Animation scroll navbar


window.onscroll = function() {myFunction()};

function myFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("navbar").className = "navbar navbar-expand-lg sticky-top np-element";
  } else {
    document.getElementById("navbar").className = "navbar navbar-expand-lg sticky-top";
  }
}

