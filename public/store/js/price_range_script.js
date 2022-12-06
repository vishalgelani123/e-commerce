$(function () {
	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 100000,
		values: [ 0, 100000 ],
		slide: function( event, ui ) {
		alert("Fsdfsf");	
		$( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
		$(document).find('#above-price').val(ui.values[ 0 ]);
		$(document).find('#below-price').val(ui.values[ 1 ]);
		min_price = $(document).find('#above-price').val();
		max_price = $(document).find('#below-price').val();
		if(min_price === ''){
			min_price = 'no';
		}
		if(max_price === ''){
			max_price = 'no';
		}
		getData(1);
		}
	});
	$( "#amount" ).val( "₹" + $( "#slider-range" ).slider( "values", 0 ) + " - ₹" + $( "#slider-range" ).slider( "values", 1 ) );

});