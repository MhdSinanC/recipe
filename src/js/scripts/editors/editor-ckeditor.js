/*=========================================================================================
    File Name: editor-ckeditor.js
    Description: CKEditor js
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/
(function(window, document, $) {
  "use strict";

  // Classic Editor
  CKEDITOR.ClassicEditor
		.create( document.querySelector( '#classic-editor' ) )
		.catch( err => {
			console.error( err.stack );
		} );

  // Inline Editor
  CKEDITOR.InlineEditor
		.create( document.querySelector( '#ckeditor-inline' ) )
		.catch( err => {
			console.error( err.stack );
    } );

  // Balloon Editor
  CKEDITOR.BalloonEditor
		.create( document.querySelector( '#balloon-editor' ) )
		.catch( err => {
			console.error( err.stack );
    } );

})(window, document, jQuery);
