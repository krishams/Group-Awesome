function getFavoritBars() {
	$("#search_results").load(base_url + 'ajax/loadFavoritBars');
}
$("#bars").change(function(){
	id = $("option:selected", this).attr('id');
	//alert(base_url + 'ajax/saveFavoritBars');
	$.get(base_url + 'ajax/saveFavoritBars/' + id);
	getFavoritBars();
		
	});
	
getFavoritBars();
