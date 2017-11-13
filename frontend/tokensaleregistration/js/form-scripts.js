$(document).ready(function(){

var isrequest=1;

$('#contactForm').validate({
     rules: {
		email: {
		  required: true,
		  email: true
		}
	},
	submitHandler: function(form) {
		$("#form-loader").show();
		if(isrequest == 1){
			isrequest = 0;
			$.ajax({
				type: "POST",
				url: "https://nucleus.vision/nucleus-mail-program.php",
				data: $(form).serialize(),
				success : function(response){
					$("#form-loader").hide();
					$('#getNotifyPopup').modal('hide');
					$('#contactForm')[0].reset();
					if (response == "success"){
						swal({
							title:" ",
							text: "<h1 class='blue'>Congrats!</h1><h4>You have successfully signed up for the Nucleus token ICO sale!</h4><p>We will keep you informed about important dates and details for participating in the ICO.</p>",
							type: "success",
							animation: false,
							html: "true"
						});
					}else{
						swal({
							title: "NUCLEUS TOKEN SALE!",
							text: "Error While Submitting. Please Try Again.",
							type: "error",
							animation: false,
							html: "true"
						});
					}
					isrequest = 1;
				}
			});
		}
    }
});


var v1 = $('#subscribeForm').validate({
     rules: {
		email: {
		  required: true,
		  email: true
		}
	},
	submitHandler: function(form) {
		if(isrequest == 1){
			isrequest = 0;
			$.ajax({
				type: "POST",
				url: "https://nucleus.vision/nucleus-mail-program.php",
				data: $(form).serialize(),
				success : function(response){
					if (response == "success"){
						swal({
							title:" ",
							text: "<h1 class='blue'>Congrats!</h1><h4>You have successfully signed up for the Nucleus token ICO sale!</h4><p>We will keep you informed about important dates and details for participating in the ICO.</p>",
							type: "success",
							animation: false,
							html: "true"
						});
						v1.resetForm();
						form.reset();
					}else{
						swal({
							title: "NUCLEUS TOKEN SALE!",
							text: "Error While Submitting. Please Try Again.",
							type: "error",
							animation: false,
							html: "true"
						});
					}
					isrequest = 1;
				}
			});
		}
    }
});


var v2 = $('#subscribeForm1').validate({
     rules: {
		email: {
		  required: true,
		  email: true
		}
	},
	submitHandler: function(form) {
		if(isrequest == 1){
			isrequest = 0;
			$.ajax({
				type: "POST",
				url: "https://nucleus.vision/nucleus-mail-program.php",
				data: $(form).serialize(),
				success : function(response){
					if (response == "success"){
						swal({
							title:" ",
							text: "<h1 class='blue'>Congrats!</h1><h4>You have successfully signed up for the Nucleus token ICO sale!</h4><p>We will keep you informed about important dates and details for participating in the ICO.</p>",
							type: "success",
							animation: false,
							html: "true"
						});
						v2.resetForm();
						form.reset();
					}else{
						swal({
							title: "NUCLEUS TOKEN SALE!",
							text: "Error While Submitting. Please Try Again.",
							type: "error",
							animation: false,
							html: "true"
						});
					}
					isrequest = 1;
				}
			});
		}
    }
});


});