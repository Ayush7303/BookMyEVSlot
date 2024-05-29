var  sn_error=true;
var  loc_error=true;
var  area_error=true;
var  zone_error=true;
var  city_error=true;
var  lon_error=true;
var  lat_error=true;
var  ava_error=true;
$("#stname").keyup(function(){
    sn_check();
});
$("#stloc").keyup(function(){
    loc_check();
})
$("#starea").keyup(function(){
    area_check();
});
$("#stzone").keyup(function(){
    zone_check();
})
$("#stcity").keyup(function(){
    city_check();
});
$("#stlat").keyup(function(){
    lat_check();
});
$("#stlon").keyup(function(){
    lon_check();
});
$("#stava").keyup(function(){
    ava_check();
});

function sn_check(){
    var sn_val=$("#stname").val();
    var regex = /^ST\d+/;
    if(sn_val.length=='')
    {
        $("#snerr").html("*Station Name is empty.");
        $("#snerr").focus();
        $("#snerr").css("color","black");
        sn_error=false;
        return false;
    }
    else{
        $("#snerr").html("");
    }
    if(!regex.test(sn_val))
    {
        $("#snerr").html("*Enter valid Station Name(ST00).");
        $("#snerr").focus();
        $("#snerr").css("color","black");
        sn_error=false;
        return false;
    }
    else{
        $("#snerr").html("");
    }
}
function loc_check(){
    var loc_val=$("#stloc").val();
    // var regex1 = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(loc_val.length=='')
    {
        $("#locerr").html("*Location is empty.");
        $("#locerr").focus();
        $("#locerr").css("color","black");
        loc_error=false;
        return false;
    }
    else{
        $("#locerr").html("");
    }
    // if(!regex1.test(pwd_val))
    // {
    //     $("#pwderr").html("*Password must contain at least 1 capital letter,1 small letter, 1 number and 1 special character and maximum 8 letters.");
    //     $("#pwderr").focus();
    //     $("#pwderr").css("color","black");
    //     pwd_error=false;
    //     return false;
    // }
    // else{
    //     $("#pwderr").html("");
    // }
}
function area_check()
{
    var area_val=$("#starea").val();
    // var regex3 = /^[a-z0-9_-]{4,15}$/;
    if(area_val.length=='')
    {
        $("#areaerr").html("*Area is empty.");
        $("#areaerr").focus();
        $("#areaerr").css("color","black");
        area_error=false;
        return false;
    }
    else{
        $("#areaerr").html("");
    }
    // if(!regex3.test(un_val))
    // {
    //     $("#unerr").html("*Enter valid username.");
    //     $("#unerr").focus();
    //     $("#unerr").css("color","black");
    //     reg_un_error=false;
    //     return false;
    // }
    // else{
    //     $("#unerr").html("");
    // }
}
function zone_check()
{
    var zone_val=$("#stzone").val();
    // var regex4 = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(zone_val.length=='')
    {
        $("#zoneerr").html("*Zone is empty.");
        $("#zoneerr").focus();
        $("#zoneerr").css("color","black");
        zone_error=false;
        return false;
    }
    else{
        $("#zoneerr").html("");
    }
    // if(!regex4.test(reg_email_val))
    // {
    //     $("#remailerr").html("*Enter valid E-mail.");
    //     $("#remailerr").focus();
    //     $("#remailerr").css("color","black");
    //     reg_em_error=false;
    //     return false;
    // }
    // else{
    //     $("#remailerr").html("");
    // }
}
function city_check(){
    var city_val=$("#stcity").val();
    var regex2 = /^[A-Za-z]+$/;
    if(city_val.length=='')
    {
        $("#cityerr").html("*City is empty.");
        $("#cityerr").focus();
        $("#cityerr").css("color","black");
        city_error=false;
        return false;
    }
    else{
        $("#cityerr").html("");
    }
    if(!regex2.test(city_val))
    {
        $("#cityerr").html("*Invalid city");
        $("#cityerr").focus();
        $("#cityerr").css("color","black");
        city_error=false;
        return false;
    }
    else{
        $("#cityerr").html("");
    }
}
function lat_check(){
    var lat_val=$("#stlat").val();
    // var reg_pwd_val=$("#registerpwd").val();
    var regex3 = /^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$/;
    if(lat_val.length=='')
    {
        $("#laterr").html("*Latitude is empty.");
        $("#laterr").focus();
        $("#laterr").css("color","black");
        lat_error=false;
        return false;
    }
    else{
        $("#laterr").html("");
    }
	if(!regex3.test(lat_val))
    {
        $("#laterr").html("*Invalid latitude");
        $("#laterr").focus();
        $("#laterr").css("color","black");
        lat_error=false;
        return false;
    }
    else{
        $("#laterr").html("");
    }
}
function lon_check(){
    var lon_val=$("#stlon").val();
    // var reg_pwd_val=$("#registerpwd").val();
    var regex4 = /^[-+]?((1[0-7]|[0-9])?\d(\.\d+)?|180(\.0+)?)$/;
    if(lon_val.length=='')
    {
        $("#lonerr").html("*Longitude is empty.");
        $("#lonerr").focus();
        $("#lonerr").css("color","black");
        lon_error=false;
        return false;
    }
    else{
        $("#lonerr").html("");
    }
	if(!regex4.test(lon_val))
    {
        $("#lonerr").html("*Invalid longitude");
        $("#lonerr").focus();
        $("#lonerr").css("color","black");
        lon_error=false;
        return false;
    }
    else{
        $("#lonerr").html("");
    }
}
function ava_check()
{
    var ava_val=$("#stava").val();
    var regex5 = /^[01]$/;
    if(ava_val.length=='')
    {
        $("#avaerr").html("*Available is empty.");
        $("#avaerr").focus();
        $("#avaerr").css("color","black");
        ava_error=false;
        return false;
    }
    else{
        $("#avaerr").html("");
    }
    if(!regex5.test(ava_val))
    {
        $("#avaerr").html("*Only 1(available) or 0(unavailable).");
        $("#avaerr").focus();
        $("#avaerr").css("color","black");
        ava_error=false;
        return false;
    }
    else{
        $("#avaerr").html("");
    }
}
$(".insert").on("click",function(e){

	e.preventDefault();
    var  sn_error=true;
	var  loc_error=true;
	var  area_error=true;
	var  zone_error=true;
	var  city_error=true;
	var  lon_error=true;
	var  lat_error=true;
	var  ava_error=true;
    sn_check();
    loc_check();
	area_check();
	zone_check();
	city_check();
	lon_check();
	lat_check();
	ava_check();

    if(sn_error==true && loc_error==true && area_error==true && zone_error==true && city_error==true && lon_error==true &&lat_error==true && ava_error==true)
    {
		// alert("no");
	sname=$(".stname").val();
	sloc=$(".stloc").val();
	sarea=$(".starea").val();
	szone=$(".stzone").val();
	scity=$(".stcity").val();
	slat=$(".stlat").val();
	slon=$(".stlon").val();
	sava=$(".stava").val();
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"insertstation","stname":sname,"stloc":sloc,"starea":sarea,"stzone":szone,"stcity":scity,"stlat":slat,"stlon":slon,"stava":sava},
		success:function(data){
			if(data==1)
			{
				alert("data inserted successfully.");
				loadstTB();
				resetform();
			}
		}
	})
	}
})
//load station in combobox
function loadstationcombo(){
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"displaystcombo"},
		success:function(data){
			$(".sname").html(data);
		}
	})
}
loadstationcombo();


// var  st_error=true;
var  svol_error=true;
// var  sct_error=true;
var  spr_error=true;
var  sava_error=true;

// $("#sname").keyup(function(){
//     st_check();
// });
$("#volt").keyup(function(){
    svolt_check();
})
$("#pr").keyup(function(){
    spr_check();
});
// $("#ct").keyup(function(){
//     sct_check();
// })
$("#sava").keyup(function(){
    sava_check();
});
// function st_check(){
//     var st_val=$("#sname").val();
//     // var regex = /^ST\d+/;
//     if(st_val.val()=='')
//     {
//         $("#serr").html("*Station Name is empty.");
//         $("#serr").focus();
//         $("#serr").css("color","black");
//         st_error=false;
//         return false;
//     }
//     else{
//         $("#serr").html("");
//     }
//     // if(!regex.test(sn_val))
//     // {
//     //     $("#snerr").html("*Enter valid Station Name(ST00).");
//     //     $("#snerr").focus();
//     //     $("#snerr").css("color","black");
//     //     sn_error=false;
//     //     return false;
//     // }
//     // else{
//     //     $("#snerr").html("");
//     // }
// }
function svolt_check(){
    var svol_val=$("#volt").val();
    // var reg_pwd_val=$("#registerpwd").val();
    var regex6 = /^\d+(\.\d+)?$/;
    if(svol_val.length=='')
    {
        $("#volerr").html("*Voltage is empty.");
        $("#volerr").focus();
        $("#volerr").css("color","black");
        svol_error=false;
        return false;
    }
    else{
        $("#volerr").html("");
    }
	if(!regex6.test(svol_val))
    {
        $("#volerr").html("*Invalid Voltage");
        $("#volerr").focus();
        $("#volerr").css("color","black");
        svol_error=false;
        return false;
    }
    else{
        $("#volerr").html("");
    }
}
function spr_check(){
    var spr_val=$("#pr").val();
    // var reg_pwd_val=$("#registerpwd").val();
    var regex7 = /^\d+(\.\d+)?$/;
    if(spr_val.length=='')
    {
        $("#prerr").html("*Price is empty.");
        $("#prerr").focus();
        $("#prerr").css("color","black");
        spr_error=false;
        return false;
    }
    else{
        $("#prerr").html("");
    }
	if(!regex7.test(spr_val))
    {
        $("#prerr").html("*Invalid Price.");
        $("#prerr").focus();
        $("#prerr").css("color","black");
        spr_error=false;
        return false;
    }
    else{
        $("#prerr").html("");
    }
}
// function sct_check(){
//     var sct_val=$("#ct").val();
//     // var regex = /^ST\d+/;
//     if(sct_val=='')
//     {
//         $("#cterr").html("*Current Type is empty.");
//         $("#cterr").focus();
//         $("#cterr").css("color","black");
//         sct_error=false;
//         return false;
//     }
//     else{
//         $("#cterr").html("");
//     }
//     // if(!regex.test(sn_val))
//     // {
//     //     $("#snerr").html("*Enter valid Station Name(ST00).");
//     //     $("#snerr").focus();
//     //     $("#snerr").css("color","black");
//     //     sn_error=false;
//     //     return false;
//     // }
//     // else{
//     //     $("#snerr").html("");
//     // }
// }
function sava_check()
{
    var sava_val=$("#sava").val();
    var regex8 = /^[01]$/;
    if(sava_val.length=='')
    {
        $("#savaerr").html("*Available is empty.");
        $("#savaerr").focus();
        $("#savaerr").css("color","black");
        sava_error=false;
        return false;
    }
    else{
        $("#savaerr").html("");
    }
    if(!regex8.test(sava_val))
    {
        $("#savaerr").html("*Only 1(available) or 0(unavailable).");
        $("#savaerr").focus();
        $("#savaerr").css("color","black");
        sava_error=false;
        return false;
    }
    else{
        $("#savaerr").html("");
    }
}



$(".inserts").on("click",function(e){

e.preventDefault();

// var  st_error=true;
var  svol_error=true;
// var  sct_error=true;
var  spr_error=true;
var  sava_error=true;


// st_check();
svolt_check();
spr_check();
// sct_check();
sava_check();

if(svol_error==true && spr_error==true && sava_error==true)
{
	sid=$(".sname").val();
	vol=$(".volt").val();
	curtype=$(".ct").val();
	price=$(".pr").val();
	ava=$(".ava").val();

	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"insertslot","sid":sid,"vol":vol,"curtype":curtype,"price":price,"ava":ava},
		success:function(data){
			if(data==1)
			{
				alert("data inserted successfully.");
				loadslotTB();
				resetslotform();
			}
		}
	})
}
})







//USER
function loaduserTB(page){
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"displayuser",page_no:page},
		success:function(data){
			$("#userdata").html(data);
		}
	})
}
$(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id=$(this).attr("id");
    loaduserTB(page_id);
})
$(document).on("click",".deleteuser",function(e){

	e.preventDefault();
	id=$(this).attr("id");
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"deleteuser","uid":id},
		success:function(data)
		{
			if(data==1)
			{
				loaduserTB();
				alert("deleted successfully.");			
			}
		}
	})
})
loaduserTB();


//BOOKING

function loadadminbookingTB(page){
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"displaybookingadmin",page_no:page},
		success:function(data){
			$("#bookingdataadmin").html(data);
		}
	})
}
$(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id=$(this).attr("id");
    loadadminbookingTB(page_id);
})
$(document).on("click",".deleteadminbooking",function(e){

	e.preventDefault();
	id=$(this).attr("id");
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"deleteadminbooking","bid":id},
		success:function(data)
		{
			if(data==1)
			{
				loadadminbookingTB();
				alert("Canceled successfully.");			
			}
		}
	})
})
loadadminbookingTB();

//SLOT


function loadslotTB(page){
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"displayslot",page_no:page},
		success:function(data){
			$("#slottable").html(data);
		}
	})
}
$(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id=$(this).attr("id");
    loadslotTB(page_id);
})

loadslotTB();
function resetslotform() 
{
	$('#slotform')[0].reset();
}

$(document).on("click",".deleteslot",function(e){

	e.preventDefault();
	id=$(this).attr("id");
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"deleteslot","slid":id},
		success:function(data)
		{
			if(data==1)
			{
				loadslotTB();
				alert("deleted successfully.");			
			}
		}
	})
})
sl_id=0;
$(document).on("click",".updateslot",function(e){
	e.preventDefault();
	$(".updates").show();
	$(".inserts").hide();
	sid=$(this).attr("id");
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"reflectslot","slotid":sid},
		success:function(data){
			$value=JSON.parse(data);
			$(".sname").val($value.stationid);
			$(".volt").val($value.voltage);
			$(".ct").val($value.currenttype);
			$(".pr").val($value.price);
			$(".ava").val($value.available);
		
			$sl_id=$value.slotid;
		}
	})
})
$(".updates").on("click",function(){
	sid=$(".sname").val();
	vol=$(".volt").val();
	curtype=$(".ct").val();
	price=$(".pr").val();
	ava=$(".ava").val();
	slotid=$sl_id;
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"updateslot","sid":sid,"vol":vol,"curtype":curtype,"price":price,"ava":ava,"slid":slotid},
		success:function(data){
			if(data==1)
			{
				alert("updated successfully.");
				loadslotTB();
				resetslotform();
			}
		}	
	})
})


//STATION
function loadstTB(page){
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"displaystation",page_no:page},
		success:function(data){
			$("#sttable").html(data);
		}
	})
}
function resetform() 
{
	$('#sform')[0].reset();
}
loadstTB();

$(document).on("click",".deletedata",function(e){

	e.preventDefault();
	id=$(this).attr("id");
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"deletestation","stid":id},
		success:function(data)
		{
			if(data==1)
			{
				loadstTB();
				alert("deleted successfully.");			
			}
		}
	})
})
std_id=0;
$(document).on("click",".updatedata",function(e){
	e.preventDefault();
	$(".update").show();
	$(".insert").hide();
	sid=$(this).attr("id");
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"reflectstation","stid":sid},
		success:function(data){
			$value=JSON.parse(data);
			$(".stname").val($value.stationname);
			$(".stloc").val($value.location);
			$(".starea").val($value.area);
			$(".stzone").val($value.zone);
			$(".stcity").val($value.city);
			$(".stlat").val($value.latitude);
			$(".stlon").val($value.longitude);
			$(".stava").val($value.available);
			$std_id=$value.stationid;
		}
	})
})
$(".update").on("click",function(){
	sname=$(".stname").val();
	sloc=$(".stloc").val();
	sarea=$(".starea").val();
	szone=$(".stzone").val();
	scity=$(".stcity").val();
	slat=$(".stlat").val();
	slon=$(".stlon").val();
	sava=$(".stava").val();
	sid=$std_id;
	$.ajax({
		url:"../ajax.php",
		type:"POST",
		data:{"flag":"updatestation","stname":sname,"stloc":sloc,"starea":sarea,"stzone":szone,"stcity":scity,"stlat":slat,"stlon":slon,"stava":sava,"stid":sid},
		success:function(data){
			if(data==1)
			{
				alert("updated successfully.");
				loadstTB();
				resetform();
			}
		}	
	})
})
$(document).on("click","#pagination a",function(e){
    e.preventDefault();
    var page_id=$(this).attr("id");
    loadstTB(page_id);
})
