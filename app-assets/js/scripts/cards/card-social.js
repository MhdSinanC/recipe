/*=========================================================================================
    File Name: advance-cards.js
    Description: intialize advance cards
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: hhttp://www.themeforest.net/user/Ai2Gi
==========================================================================================*/
(function(window, document, $) {
    'use strict';

    /************************************************************
    *               Social Cards Content Slider                 *
    ************************************************************/
    // RTL Support
    var rtl = false;
    if($('html').data('textdirection') == 'rtl'){
        rtl = true;
    }
    if(rtl === true){
        $(".tweet-slider").attr('dir', 'rtl');
        $(".fb-post-slider").attr('dir', 'rtl');
        $(".linkedin-post-slider").attr('dir', 'rtl');
    }

})(window, document, jQuery);