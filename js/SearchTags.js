$(document).ready(function() {
    $("#search-tags").tagit({
        fieldName: "tags[]",
        allowSpaces: true,
        placeholderText: "Skills and Interests",
        autocomplete: {delay: 0, minLength: 2}
    });
});