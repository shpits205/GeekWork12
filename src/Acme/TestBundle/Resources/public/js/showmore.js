$('.record_action').append('<li><a href="#" class="add_tag_link">Add a tag</a></li>');
function addTagForm() {
    // Get the div that holds the collection of tags
    var collectionHolder = $('#task_tags');
    // Get the data-prototype we explained earlier
    var prototype = collectionHolder.attr('data-prototype');
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on the current collection's length.
    form = prototype.replace(/\$\$name\$\$/g, collectionHolder.children().length);
    // Display the form in the page
    collectionHolder.append(form);
}
// Add the link to add tags
$('.record_action').append('<li><a href="#" class="add_tag_link">Add a tag</a></li>');
// When the link is clicked we add the field to input another tag
$('a.jslink').click(function(event){
    addTagForm();
});