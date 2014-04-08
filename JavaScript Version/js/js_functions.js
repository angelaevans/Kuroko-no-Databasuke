function login(){
    var user = document.getElementById("Usernameinput").value;
    if (user.length > 0){
        var urlstub = "php/checklogin.php";
        var varstub = "username="+user;
                
        checkloginPHPrequest(urlstub, varstub);
    }
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }
  
}

function checkloginPHPrequest(urlstub, varstub){
    // Create XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();

    // variables for our PHP file
    var url = urlstub;
    var vars = varstub;
    httpRequest.open("POST", url, true);

    // Set content type header information for sending url encoded variables in the request
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    httpRequest.onreadystatechange = function() {
        
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = httpRequest.responseText;
            if (return_data == 1){
                document.getElementById("status").innerHTML = "Logging in";
                window.location.href = 'friends.php';
            }
            else{
                document.getElementById("status").innerHTML = "Username does not exist";
            }

        }
        else{
            document.getElementById("status").innerHTML = "Failed. Try again.";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(vars);
    document.getElementById("status").innerHTML = "processing....";

}
