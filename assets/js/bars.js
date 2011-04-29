function getFavoritBars() {
	$("#search_results").load(base_url + 'ajax/loadFavoritBars');
	
}

$("#bars").submit(function(){
	id = $("option:selected", this).attr('id');
	$.get(base_url + 'ajax/saveFavoritBars/' + id);
	getFavoritBars();
	return false;
		
});
	
$("#addbarshowhide").click(function(){
	$('#addbar').toggle('slow', function() {});
	$('#addbarshowhide').toggle('slow', function() {});
    	
});
	
$('#addbarform').submit(function() {
	barname = $("#barname").val();
 	$.get(base_url + 'ajax/saveBar/' + barname);
 	$('#addbar').toggle('slow', function() {});
 	$('#addbarshowhide').toggle('slow', function() {});
});
	
function removefavorite(){
	$("#favoritebarlist li img").click(function() {
        id = $(this).attr('id');
		$.get(base_url + 'ajax/removeFavoritBar/' + id);
		$(this).parent().remove();
		});	
    }
	
getFavoritBars();
