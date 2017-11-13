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

});
