var curpwd_error=true;
var newpwd_error=true;
var conpwd_error=true;
$("#np").keyup(function(){
    pass_check();
});
$("#cnp").keyup(function(){
    con_pass_check();
});
function pass_check(){
    var pwd_val=$("#np").val();
    var regex5 = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(pwd_val.length=='')
    {
        $("#npwderr").html("*Password is empty.");
        $("#npwderr").focus();
        $("#npwderr").css("color","red");
        curpwd_error=false;
        return false;
    }
    else{
        $("#npwderr").html("");
    }
    if(!regex5.test(pwd_val))
    {
        $("#npwderr").html("*Invalid password.");
        $("#npwderr").focus();
        $("#npwderr").css("color","red");
        pwd_error=false;
        return false;
    }
    else{
        $("#npwderr").html("");
    }
}
function con_pass_check(){
    var cpwd_val=$("#cnp").val();
    var pwd_val=$("#np").val();
    // var regex6 = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(pwd_val.length=='')
    {
        $("#cnpwderr").html("*Password is empty.");
        $("#cnpwderr").focus();
        $("#cnpwderr").css("color","red");
        cpwd_error=false;
        return false;
    }
    else{
        $("#cnpwderr").html("");
    }
    if(cpwd_val!=pwd_val)
    {
        $("#cnpwderr").html("*Password not matching");
        $("#cnpwderr").focus();
        $("#cnpwderr").css("color","red");
        cpwd_error=false;
        return false;
    }
    else{
        $("#cnpwderr").html("");
    }
}	
$("#changepwd").on("click", function(e){
    e.preventDefault();
    curpwd_error=true;
    newpwd_error=true;
    conpwd_error=true;
    pass_check();
    con_pass_check();
    if(curpwd_error==true && newpwd_error==true && conpwd_error==true)
    {
    cp= $("#cp").val();
    np= $("#np").val();
    cnp= $("#cnp").val();
    
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: { "flag": "changepassword", "curpwd": cp,"newpwd": cnp},
        success: function(data) {       
            if (data == 1) {
                alert("Password changed successful...!!");
            }else {
                alert("Password does not successfully...!!");
            }
        }
    })
}
});
	
    $.ajax({
		url:"ajax.php",
		type:"POST",
		data:{"flag":"reflectuser"},
		success:function(data){
			$value=JSON.parse(data);
			$(".un").val($value.USERNAME);
			$(".em").val($value.EMAIL);
			$(".mn").val($value.MOBILENO);
			
		}
	})


$(document).on('change','.imup',function(){
    var fd=new FormData();
    var files=$('#imup')[0].files;
    
    if(files.length>0)
    {
        fd.append('file',files[0]);

    $.ajax({
        url: "upload.php",
    type: "POST",
    data: fd,
    contentType: false,
    processData:false,
    success: function(response){
        if(response!=0)
        {
            $('#imup').hide();
            // alert("uploaded.")
            // $("#pic").attr("src", response);
            $(".preview img").show(); 
        }
        else{
            alert('file not uploaded.');
        }
    },
});
    }else{
        alert("please select a file.");
    }
});  
