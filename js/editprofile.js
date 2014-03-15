$(document).ready(function() {
    $("#editprofile").click(function() {
        $("#editprofile_form").validate({
            rules: {
                name: {
                    required: true,
                    number: false
                },
                bio:{
                    maxlength: 700
                }
            },
            messages: {
                name: {
                    required: "You must specify your name",
                    number: "The name must not contain numbers"
                },
                bio:{
                    maxlength: "The bio must me less than 700 characters"
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('error');
                label.insertAfter(element);
            }
        });
    });
});

