$(document).ready(function(){

function get_sensors_info()
{

        $.ajax({
				url: "tracker.php", 
				type:'GET',
				contentType: "application/json",
				dataType: 'json',
				success: function(result){

				$(".imei_count").html(result[0].imei_count);
				$(".sensors_count").html(result[0].sensors_count);
				$(".authorizations").html(result[0].authorizations);
				$(".recommendations").html(result[0].recommendations);
				$(".benefits_availed").html(result[0].benefits_availed);
        }		
		});

	
}

get_sensors_info();
setInterval(get_sensors_info, 5000);


function get_capital_info()
{
    $.ajax({
        url: "tracker.php", 
        type:'GET',
        contentType: "application/json",
        dataType: 'json',
        success: function(result){
            $(".soft-cap-txt").html(result[0].temp1+"K ETH");
            
            cap = parseInt(result[0].temp1);
            
            perc = Math.round((cap/200)*100);
            cap_pos = perc-0.1;
            //perc = (cap/200)*100;
            
            //console.log(perc);
            //console.log(cap_pos);
            
            $(".token-cap-slider-completed").css('width', perc+'%');
            //$(".token-cap-slider-completed").css('width', '10%');
            
            $(".token-cap-slider-item.soft").css('left', cap_pos+'%');
            //alert($(".token-cap-slider-item.soft").html());
            //console.log(perc+'%');
            //$(".token-cap-slider-item.soft").css('left', '9.9%');
        }		
    });	
}

get_capital_info();
setInterval(get_capital_info, 5000);

});
