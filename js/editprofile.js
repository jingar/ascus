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
    if($('input[value="No Collaboration"]').prop("checked"))
        {
            $('[name=collaboration-time]').removeAttr('name');
            $('#collaboration-time').hide('slow');
        }
        else
        {
            $('select').attr('name','collaboration-time');
            $('#collaboration-time').show('slow');
        }

    $('input[value="No Collaboration"]').click(function(event) {
        if($(this).prop("checked"))
        {
            $('[name=collaboration-time]').removeAttr('name');
            $('#collaboration-time').hide('slow');
        }
        else
        {
            $('select').attr('name','collaboration-time');
            $('#collaboration-time').show('slow');
        }
    });

});

