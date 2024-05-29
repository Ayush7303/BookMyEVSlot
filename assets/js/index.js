function getDate(val)
{
    let name = val.getAttribute("name");
    let date = name.split(":")[0];
    let stid = name.split(":")[1];

    $.ajax({
        url : "ajax.php",
        type : "GET",
        data : {"flag":"futslots", "date" : date, "stid":stid },
        success:function(data){
            $(".slot-details").html(data);
        }
    })
}
function chkBtnStatus(id){
    id = id.slice(11)
    if(!$(".time-value").is(":checked"))
    {
        alert("Please Select Time");
    }
    else if($(".time-value").is(":checked"))
    {
        $("#bookslot"+id).click();
    }
}
function setDate()
{
    $.ajax({
        url : "ajax.php",
        type : "GET",
        data : {"flag":"setDate"},
        success:function(data){
            // alert(data);
        }
    })    
}


setInterval(setDate, 1000);
// setDate();
function showSlots(id) {
    $(".main").show()
    $.ajax({
        url: "ajax.php",
        type: "GET",
        data: { "flag": "getSlots", "stid": id },
        success: function (data) {
            $(".main").html(data);
        }
    })
}

$(document).on("click", ".st-avl", function () {
    $(".main").hide()
})
$(document).on("click", ".st-unavl", function () {
    $(".main").hide()
})

$(document).on("change", ".time-value", function () {
    // alert("hii")
})

function select_time(id) {
    document.getElementById(id).classList.add("selected-time");
    document.getElementById("rb"+id).checked = true;
}

function reset_time(num) {
    for (i = 1; i < 36; i++) {
        if (i > num || i < num) {
            id = 'time'+i;
            if(document.getElementById(id).classList.contains("selected-time"))
            {
                document.getElementById(id).classList.remove("selected-time");
            }
        }
    }
}
function setBG(num)
{
    document.getElementById('day'+num).classList.add("selected-date");
}

function resetBG(num)
{
    for (i = 0; i < 7; i++) {
        if (i > num || i < num) {
            id = 'day'+i;
            if(document.getElementById(id).classList.contains("selected-date"))
            {
                document.getElementById(id).classList.remove("selected-date");
            }
        }
    }
}

function changeBG(id)
{
    num = id.slice(3);
    switch(id)
    {
        case 'day0':
            setBG(num);
            resetBG(num);
            break;
            
        case 'day1':
            setBG(num);
            resetBG(num);
            break;

        case 'day2':
            setBG(num);
            resetBG(num);
            break;

        case 'day3':
            setBG(num);
            resetBG(num);
            break;

        case 'day4':
            setBG(num);
            resetBG(num);
            break;

        case 'day5':
            setBG(num);
            resetBG(num);
            break;

        case 'day6':
            setBG(num);
            resetBG(num);
            break;
    }
}
function change_bg(id) {
    num = id.slice(4);
    switch (id) {
        case "time1":
            select_time("time1");
            reset_time(num);
            break;
        case "time2":
            select_time("time2");
            reset_time(num);
            break;
        case "time3":
            select_time("time3");
            reset_time(num);
            break;
        case "time4":
            select_time("time4");
            reset_time(num);
            break;
        case "time5":
            select_time("time5");
            reset_time(num);
            break;
        case "time6":
            select_time("time6");
            reset_time(num);
            break;
        case "time7":
            select_time("time7");
            reset_time(num);
            break;
        case "time8":
            select_time("time8");
            reset_time(num);
            break;
        case "time9":
            select_time("time9");
            reset_time(num);
            break;
        case "time10":
            select_time("time10");
            reset_time(num);
            break;
        case "time11":
            select_time("time11");
            reset_time(num);
            break;
        case "time12":
            select_time("time12");
            reset_time(num);
            break;
        case "time13":
            select_time("time13");
            reset_time(num);
            break;
        case "time14":
            select_time("time14");
            reset_time(num);
            break;
        case "time15":
            select_time("time15");
            reset_time(num);
            break;
        case "time16":
            select_time("time16");
            reset_time(num);
            break;
        case "time17":
            select_time("time17");
            reset_time(num);
            break;
        case "time18":
            select_time("time18");
            reset_time(num);
            break;
        case "time19":
            select_time("time19");
            reset_time(num);
            break;
        case "time20":
            select_time("time20");
            reset_time(num);
            break;
        case "time21":
            select_time("time21");
            reset_time(num);
            break;
        case "time22":
            select_time("time22");
            reset_time(num);
            break;
        case "time23":
            select_time("time23");
            reset_time(num);
            break;
        case "time24":
            select_time("time24");
            reset_time(num);
            break;
        case "time25":
            select_time("time25");
            reset_time(num);
            break;
        case "time26":
            select_time("time26");
            reset_time(num);
            break;
        case "time27":
            select_time("time27");
            reset_time(num);
            break;
        case "time28":
            select_time("time28");
            reset_time(num);
            break;
        case "time29":
            select_time("time29");
            reset_time(num);
            break;
        case "time30":
            select_time("time30");
            reset_time(num);
            break;
        case "time31":
            select_time("time31");
            reset_time(num);
            break;
        case "time32":
            select_time("time32");
            reset_time(num);
            break;
        case "time33":
            select_time("time33");
            reset_time(num);
            break;
        case "time34":
            select_time("time34");
            reset_time(num);
            break;
        case "time35":
            select_time("time35");
            reset_time(num);
            break;                
        case "time36":
            select_time("time36");
            reset_time(num);
            break;                        
    }
}
function update_time_stemp()
{
    $.ajax({
        url : "ajax.php",
        type : "GET",
        data : {"flag":"upstemp"},
        success:function(data){
            // alert(data);
        }
    })
}

setInterval(update_time_stemp, 1000);


function update_booking_stemp()
{
    $.ajax({
        url : "ajax.php",
        type : "GET",
        data : {"flag":"upbooking"},
        success:function(data){
            // alert(data);
        }
    })
}

setInterval(update_booking_stemp, 1000);