


	  <script>
	  
	$(document).ready(function(){

	$("#symbol").autocomplete({
		source: function (request, response) {
			
			// faking the presence of the YAHOO library bc the callback will only work with
			// "callback=YAHOO.Finance.SymbolSuggest.ssCallback"
			var YAHOO = window.YAHOO = {Finance: {SymbolSuggest: {}}};
			
			YAHOO.Finance.SymbolSuggest.ssCallback = function (data) {
				var mapped = $.map(data.ResultSet.Result, function (e, i) {
					return {
						label: e.symbol + ' (' + e.name + ')',
						value: e.symbol
					};
				});
				response(mapped);
			};
			
			var url = [
				"http://d.yimg.com/autoc.finance.yahoo.com/autoc?",
				"query=" + request.term,
				"&callback=YAHOO.Finance.SymbolSuggest.ssCallback"];

			$.getScript(url.join(""));
		},
		minLength: 2
	});


	}); // end ready function
</script>
	  		
<div class="form-group navbar-form">			
<form action='quote.php' class="edit" method='GET' >				
<div class="ui-widget">
  <label for="symbol">Search: </label>
  <input id="symbol" name="symbol" placeholder="e.g. Google" class="form-control">
  <input type="submit" value="search" class="btn btn-default" style="display: inline;">
</div>
</form>
</div>
				
	
