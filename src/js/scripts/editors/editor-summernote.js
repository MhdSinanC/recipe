/*=========================================================================================
    File Name: editor-summernote.js
    Description: Summernote frontend editor js
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/
(function(window, document, $) {
  'use strict';

  // EDIT & SAVE
  var edit = function() {
    $('.summernote-edit').summernote({focus: true});
  };

  var save = function() {
    var makrup = $('.summernote-edit').summernote('code');
    $('.summernote-edit').summernote('destroy');
  };

  document.getElementById('edit').onclick=function(){ edit(); };
  document.getElementById('save').onclick=function(){ save(); };

  // Basic Summernote
  $('.summernote').summernote();

  // Air Mode
  $('.summernote-air').summernote({
    airMode: true
  });


  $('.summernote-code').summernote({
    height: 350,   //set editable area's height
    codemirror: { // codemirror options
      theme: 'monokai'
    }
  });
})(window, document, jQuery);