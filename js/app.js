import $ from "../node_modules/jquery";
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});