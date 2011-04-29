function getFavoritBars() {
	$("#search_results").load(base_url + 'ajax/loadFavoritBars');
}
	$("#bars").submit(function(){
	id = $("option:selected", this).attr('id');
	//alert(base_url + 'ajax/saveFavoritBars');
	$.get(base_url + 'ajax/saveFavoritBars/' + id);
	getFavoritBars();
		
	});
	
	$("#addbarshowhide").click(function(){
		
  		$('#addbar').toggle('slow', function() {});
    	
	});
	
	$('#addbarform').submit(function() {
		barname = $("#barname").val();
  		$.get(base_url + 'ajax/saveBar/' + barname);
	});
getFavoritBars();
