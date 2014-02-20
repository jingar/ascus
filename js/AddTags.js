$(document).ready(function() {
    $("#tags").tagit({
    	beforeTagAdded: function(event, ui) {
    		$('#tagChanges ul').append("<li>" + ui.tagLabel + "</li>");
    	},
        fieldName: "tags[]",
        allowSpaces: true,
        autocomplete: {delay: 0, minLength: 2},
        tagLimit: 3
    });
});
