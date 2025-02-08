/*=========================================================================================
    File Name: datatables-colvis.js
    Description: ColVis Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

$(document).ready(function() {

/************************************
*       Basic initialisation        *
************************************/

$('.dataex-colvis-basic').DataTable( {
    dom: 'C<"clear">lfrtip'
} );

/**********************************
*       Custom button text        *
**********************************/

$('.dataex-colvis-custom').DataTable( {
    "dom": 'C<"clear">lfrtip',
    "colVis": {
        "buttonText": "Change columns"
    }
} );

/*****************************************
*       Exclude columns from list        *
*****************************************/

$('.dataex-colvis-exclude').DataTable( {
    dom: 'C<"clear">lfrtip',
    colVis: {
        exclude: [ 0 ]
    }
} );

/************************************
*       Mouseover activation        *
************************************/

$('.dataex-colvis-mouseover').DataTable( {
    dom: 'C<"clear">lfrtip',
    colVis: {
        activate: "mouseover"
    }
} );

/********************************************
*       Mouseover Restore / show all        *
********************************************/

$('.dataex-colvis-restore').DataTable( {
    dom: 'C<"clear">lfrtip',
    columnDefs: [
        { visible: false, targets: 2 }
    ],
    colVis: {
        restore: "Restore",
        showAll: "Show all",
        showNone: "Show none"
    }
} );


} );