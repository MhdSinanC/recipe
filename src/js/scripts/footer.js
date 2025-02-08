/*=========================================================================================
  File Name: footer.js
  Description: Template footer js.
  ----------------------------------------------------------------------------------------
  Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
  Author: Ai2Gi
  Author URL: hhttp://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

//Check to see if the window is top if not then display button
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 40) {
            $('#scroll-top').fadeIn();
        } else {
            $('#scroll-top').fadeOut();
        }
    });

    //Click event to scroll to top
    $('#scroll-top').click(function(){
        $('html, body').animate({scrollTop : 0},1000);
    });

});