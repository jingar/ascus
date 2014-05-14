
$(document).ready(function() {
	var tags;
	$.ajax({
		url: "/getsearchtags.php",
		dataType: "json",
		async: false,
		success: function(data)
		{
			console.log(data);
			tags = data;
		}
	}); 
    $("#search-tags").tagit({
        fieldName: "tags[]",
        allowSpaces: true,
        availableTags: tags,
        placeholderText: "Skills and Interests",
        autocomplete: {delay: 0, minLength: 2}
    });
});