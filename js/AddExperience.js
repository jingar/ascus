$(document).ready(function() {
    var counter = $('#experience_form div:first-of-type').attr('id');
    $("#add_experience").click(function() {
        $("#experience_form").append(
            "<div class=\"form-group\">" +
            "  <input name=\"experience["+ counter +"][work_project]\" type=\"text\" class=\"form-control experience-input\" placeholder=\"Work Place/ Project Name\">" + 
            "  <input name=\"experience["+ counter +"][link]\" type=\"text\" class=\"form-control experience-input\" placeholder=\"Link to your work place or project\">" +
            "  <button name=\"remove_button\" type=\"button\" class=\"btn btn-danger\">remove</button>" +
            "</div>"
            );
counter++;
});   

$('#editprofile_form').on('submit',function(event){
    $('input[name^=experience').each(function() {
     $(this).rules("add",{
        required: true
    });
});
});
$("div").on("click", "button[name=remove_button]", function() {
    $(this).parent().remove();
});


});