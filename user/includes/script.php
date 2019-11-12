<script type="text/javascript">
   $(document).ready(function(){
    $('.checkec').on('click',function() {
       var userid = $(this).data('id');
       $clicked = $(this).parent();
       var action = "markec";
       swal({
             title: "Are you sure you want to mark this user as Ec?",
              text: "Mark as Ec",
              type: "success",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Confirm",
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if(isConfirm) {
       $.ajax({
       		url : "markec.php",
       		method : "POST",
       		dataType : "json",
       		data : {userid:userid, action:action},
       		success: function(data){
       			 if(data.code == '100') {
       			 	location.reload();
       		     }
       		}
       });
       }else{
       	swal("Cancelled", "You clicked Cancel!", "error");
       }
   });
    });
   });
</script>
<script type="text/javascript">
	$(document).ready(function(){
		  $('.remove').on('click',function() {
    	var userid = $(this).data('id');
    	$clicked = $(this).parent();
        var action = "removeec";
        swal({
             title: "Are you sure you want to stop this user from being Ec?",
              text: "Stop being Ec",
              type: "success",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Confirm",
              cancelButtonText: "Cancel",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if(isConfirm) {
        $.ajax({
       		url : "removeec.php",
       		method : "POST",
       		dataType : "json",
       		data : {userid:userid, action:action},
       		success: function(data){
       			 if(data.code == '101') {
       		       location.reload();
       		  }
       		}
       });
       }else{
       	swal("Cancelled", "You clicked Cancel!", "error");
       }
   });
    });
	});
</script>