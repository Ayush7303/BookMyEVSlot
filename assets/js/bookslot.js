function send_vehicle(){
    document.getElementById("vehicle").innerHTML = document.getElementById("v-select").value.split(":")[1];
    document.getElementById("vid").value = document.getElementById("v-select").value.split(":")[0];
}