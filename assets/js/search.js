$('#search_bar_users').change(function(event){
    id = $("option:selected", this).attr('id');
    $('#search_results').load(base_url + 'ajax/showUsersForBar/' + id);
    $("option.kill", this).remove();
});

$('#search_user_by_name').click(function(event){
    searchString = $("input#searchString").val();
    $('#search_results').load(base_url + 'ajax/showUsersByName/' + searchString);
    return false;
});