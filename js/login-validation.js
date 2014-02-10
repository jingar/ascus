/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $("#login").click(function() {
        $("#login_form").validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: "Please specify your username"
                },
                password: {
                    required: "Please must specify a password"
                }
            }
        });
    });
});



