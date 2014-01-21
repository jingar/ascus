/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#add_skill').click(function() {
        $('#skill_form').append(
                "<div class=\"form-group\">" +
                "<label class=\"col-md-2 control-label\"></label>" +
                "<div class =\"col-md-4\">" +
                "<input name =\"skill\" type=\"text\" class=\"form-control\" placeholder=\"Skill\">" +
                "</div>" +
                "<button name=\"remove_button\" type=\"button\" class=\"col-md-1\">remove</button>" +
                "</div>"
                );
    });
    $("div").on('click', 'button[name=remove_button]', function() {
        $(this).parent().remove();
    });
});