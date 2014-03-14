$(document).bind("ready", function(){

	fifatickets_main();

})

function fifatickets_main()
{
	$("button[type=clean]").attr("type", "button").bind("click", function(){ 
		cleanMe(); 
	});
}

function cleanMe()
{
	$(".form-control").val("");
	$("select.form-control").val(0);
}