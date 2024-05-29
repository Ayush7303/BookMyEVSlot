function loadbookingTB(page){
	$.ajax({
		url:"ajax.php",
		type:"POST",
		data:{"flag":"displaybooking",page_no:page},
		success:function(data){
			$("#bookingdata").html(data);
		}	
	})
}
$(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id=$(this).attr("id");
    loadbookingTB(page_id);
})




$(document).on("click",".deletebooking",function(e){
	e.preventDefault();
	id=$(this).attr("id");
	$.ajax({
		url:"ajax.php",
		type:"POST",
		data:{"flag":"deletebooking","bid":id},
		success:function(data)
		{
			if(data==1)
			{
				loadbookingTB();
				alert("canceled successfully.");			
			}
		}
	})
})
$(document).on("click",".printbooking",function(){
	// e.preventDefault();
	id=$(this).attr("id");

	// $.ajax({
	// 	url:"bookingsummary.php",
	// 	type:"POST",
	// 	data:{"bid":id},
	// 	success:function(data)
	// 	{

	// 		window.print(data);
	// // 		var printUrl = 'bookingsummary.php';

	// // var printWindow = window.open(printUrl, '_blank');
    // //   printWindow.addEventListener('load', function() {
    // //     printWindow.print();
	// //   });
	// 	}
	// })

	
	var printUrl = 'bookingsummary.php?bid='+id;

	var printWindow = window.open(printUrl, '_blank');
      printWindow.addEventListener('load', function() {
        printWindow.print();
	  });
	
})
loadbookingTB();

function showrecentbookingTB(page){
	$.ajax({
		url:"ajax.php",
		type:"POST",
		data:{"flag":"displayrecentbooking",page_no:page},
		success:function(data){
			$("#recentbookingdata").html(data);
		}
	})
}
$(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id=$(this).attr("id");
    showrecentbookingTB(page_id);
})
showrecentbookingTB();