/*=========================================================================================
    File Name: datatables-autofill.js
    Description: Auto Fill Extensions Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: hhttp://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

$(document).ready(function() {

/******************************************************
*       js of Search API (regular expressions)        *
******************************************************/

$('.auto-fill').DataTable( {
    autoFill: true
} );

/******************************************
*       js of KeyTable integration        *
******************************************/

$('.keytable-integration').DataTable( {
    keys: true,
    autoFill: true
} );

/*******************************************
*       js of Always confirm action        *
*******************************************/

$('.confirm-action').DataTable( {
    autoFill: {
        alwaysAsk: true
    }
} );

/*************************************
*       js of Column selector        *
*************************************/

$('.column-selector').DataTable( {
    columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets:   0
    } ],
    select: {
        style:    'os',
        selector: 'td:first-child'
    },
    order: [[ 1, 'asc' ]],
    autoFill: {
        columns: ':not(:first-child)'
    }
} );

/*****************************************
*       js of Scrolling DataTable        *
*****************************************/

var scrollingDataTable = $('.scrolling-dataTable').dataTable( {
    scrollY: 400,
    scrollX: true,
    scrollCollapse: true,
    paging: false,
    autoFill: true
} );



} );