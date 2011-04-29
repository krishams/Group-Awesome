$('.seemore').click(function() {
    id = $('.seemore').index($(this));
    $('tr[name^="hide"]:eq(' + id + ')').toggle('slow', function() {
        // Animation complete.
    });
});
