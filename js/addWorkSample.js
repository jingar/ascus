$(document).ready(function() {
    $.validator.addMethod('filesize', function(value, element, param) {
    // param = size (en bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
});
     $("#addworksample").click(function() {
        $("#worksample_form").validate({
            rules: {
                file: {
                    required: true,
                    extension: "png|jpg|jpeg|gif"
                },
                title: {
                    required: true,
                    maxlength: 50
                },
                description: {
                    required: true,
                    maxlength: 500
                }
            },
            messages: {
                file: {
                    required: "You must choose a file",
                    extension: "Only png,jpg,jpeg and gif file types are allowed",
                    filesize: "File size must be less than 500kb"
                },
                title:{
                    required: "You must specify a title",
                    maxlength: "Title must be less than 50 characters"
                },
                description:{
                    required: "You must specify a short description",
                    maxlength: "The description must be less than 500 characters"
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('error');
                if (element.attr("id") == "file") {
                    label.appendTo("#file_error");
              } else {
                label.insertAfter(element);
            }
        }
    });
});
});

