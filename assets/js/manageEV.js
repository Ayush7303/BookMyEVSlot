
$('.inputbox').hide();
$("#imghome").on("click",function(){
    header("location:index.php");
});
$("#exit").on("click", function(){
        $('.inputbox').hide();
// background-image: linear-gradient(rgba(0, 149, 121, 0.5),rgba(0, 149, 121, 0.5)),url(images/b4.jpg);
});

function display_form()
{
    $('.inputbox').show();
}
function loadEVbox(){
    $.ajax({
		url:"ajax.php",
		type:"POST",
		data:{"flag":"displayEV"},
		success:function(data){
            $(".dblock").html(data);
		}
	})
}
loadEVbox();
function insert_vehicle(){
    // e.preventDefault();
    EVname=$(".vname").val();
    EVno=$(".vnumber").val();
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: { "flag": "addEV","EVNAME":EVname,"EVNUMBER":EVno},
        success: function(data) {
            if(data==1)
            {
                // alert("Inserted!!")
    $('.inputbox').hide();
                loadEVbox();
            }
        }
        })
}
$(document).on("click",".bdelete",function(e){

	e.preventDefault();
	id=$(this).attr("id");
	$.ajax({
		url:"ajax.php",
		type:"POST",
		data:{"flag":"delEV","VID":id},
		success:function(data)
		{
			if(data==1)
			{
				// alert("deleted successfully.");			
                loadEVbox();
			}
		}
	})
})

$(document).on("click", ".bupdate", function (){
    id = $(this).attr("id");

    $.ajax({
        url : "ajax.php",
        type : "POST",
        data : {"flag":"getEV", "VID":id},
        success:function(data){
            let bid = "#b"+id;
            $(bid).html("");
            $(bid).html(data);
        }
    })
})

$(document).on("click", ".updatevehicle", function (){
    id = $(this).attr("id");
    vname = $("#uvname").val();
    vnum = $("#uvnumber").val();
    $.ajax({
        url : "ajax.php",
        type : "POST",
        data : {"flag" : "updateEV", "VID" : id, "vname" : vname, "vnum" : vnum},
        success:function(data){
            if(data==1)
            {
				// alert("updated successfully.");			
                loadEVbox();                
            }
            else
            {
				alert("not updated");			
            }
        }
    })
})
$(".add_txt").on("click", function(){
    $('.inputbox').show();
// background-image: linear-gradient(rgba(0, 149, 121, 0.5),rgba(0, 149, 121, 0.5)),url(images/b4.jpg);
});
