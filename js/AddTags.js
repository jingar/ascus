$(document).ready(function() {
    $("#tags").tagit({
        fieldName: "tags[]",
        allowSpaces: true,
        availableTags: ["C++","Python","Java"],
        autocomplete: {delay: 0, minLength: 2},
        tagLimit: 20
    });
});
