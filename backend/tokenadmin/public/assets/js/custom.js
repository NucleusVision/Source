$(document).ready(function(){

    $('.date').datetimepicker({ ignoreReadonly: true, format: 'MM-DD-YYYY' }); 

    $("#item_type_s").hide();

    $("#item_type").change(function () {
        var val = $("#item_type option:selected").val();
        if(val == "S"){
          $("#item_type_s").show();
        }else{
          $("#item_type_s").hide(); 
        }
    });
	
});

$('body')
    .on('click', '.date', function() {
        $(this).datetimepicker({ ignoreReadonly: true, format: 'MM-DD-YYYY' }); 
    })
    .on('focus', '.date', function() {
        $(this).datetimepicker({ ignoreReadonly: true, format: 'MM-DD-YYYY' }); 
    });
