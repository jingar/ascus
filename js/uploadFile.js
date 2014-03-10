$(document).ready(function(){
    $(':file').change(function(event) {
        var fileName = $(':file').val().split('\\').pop();
        $('#fileName').text(fileName);
    });

});
