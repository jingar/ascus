$(document).ready(function() {
    $("#search-tags").tagit({
        fieldName: "tags[]",
        allowSpaces: true,
        placeholderText: "Search for skills and interests",
        autocomplete: {delay: 0, minLength: 2}
    });
});