function dev(){
    // grabs the user input
    var user = document.getElementById("Usernameinput").value;
    // checks if anything was submited
    if (user.length > 0){
        // attmpts to log in
        devlogin(user);
    }
    // otherwise output error
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }
}

function devlogin(user){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();

    // variables for our PHP file
    var urlstub = "php/checklogin.php";
    var varstub = "username="+user;

    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = httpRequest.responseText;
            // php returned true so go to friend.php
            if (return_data == 1){
                document.getElementById("status").innerHTML = "Logging in";
                window.location.href = 'friends.php';
            }
            // php returned false so user didn't exist
            else{
                document.getElementById("status").innerHTML = "Username does not exist";
            }
        }
        else{
            document.getElementById("status").innerHTML = "Failed. Try again.";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    // while waiting, display processing
    document.getElementById("status").innerHTML = "processing....";
}





// called when the login button is pressed
function checklogin(){
    // grabs the user input
    var user = document.getElementById("Usernameinput").value;
    // checks if anything was submited
    if (user.length > 0){
        // attmpts to log in
        login(user);
    }
    // otherwise output error
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }
}

// Attmpets to login by calling checklogin.php
function login(user){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();

    // variables for our PHP file
    var urlstub = "php/checklogin.php";
    var varstub = "username="+user;

    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = httpRequest.responseText;
            // php returned true so go to friend.php
            if (return_data == 1){
                document.getElementById("status").innerHTML = "Logging in";
                window.location.href = 'FriendsList.php';
            }
            // php returned false so user didn't exist
            else{
                document.getElementById("status").innerHTML = "Username does not exist";
            }
        }
        else{
            document.getElementById("status").innerHTML = "Failed. Try again.";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    // while waiting, display processing
    document.getElementById("status").innerHTML = "processing....";
}

// called when the new user button is called
function checkregister(){
    var user = document.getElementById("Usernameinput").value;
    if (user.length > 0){
        if(user.length > 2){
            register(user);
        }
        else{
            document.getElementById("status").innerHTML = "Please enter more then 2 characters";
        }
    }
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }
}
// Attmpets to login by calling registeruser.php
function register(user){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();
    

    // variables for our PHP file
    var urlstub = "php/registeruser.php";
    var varstub = "username="+user;

    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = httpRequest.responseText;
            // php returned true so go to friend.php
            if (return_data == 1){
                document.getElementById("status").innerHTML = "Registered";
            }
            // php returned false so user already exist
            else{
                document.getElementById("status").innerHTML = "Username already exists";
            }
        }
        else{
            document.getElementById("status").innerHTML = "Failed. Try again.";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    // while waiting, display processing
    document.getElementById("status").innerHTML = "processing...";
}


//
function loadfriends(){
    // Creates a XMLHttpRequest object
                    

    var httpRequest = new XMLHttpRequest();
    
    // variables for our PHP file
    var urlstub = "php/loadfriends.php";
    var varstub = "";
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            document.getElementById("friendbox").innerHTML = "";
            var return_data = httpRequest.responseText;
            // php returned true so go to friend.php

            //document.getElementById("friendbox").innerHTML ='<input name=Friend type=submit id=Friend value=" . $friend . "> <br>';
            var jsonobject = JSON.parse(return_data);
            var listbox = document.getElementById('friendbox');

            while (listbox.firstChild) {
                listbox.removeChild(listbox.firstChild);
            }
            //document.getElementById("friendbox").innerHTML = jsonobject.length;

            for (var i = 0; i < jsonobject.length - 1; i++) {
                  
                  var friend = document.createElement('div');
                  friend.setAttribute('id','Friend');
                  friend.innerHTML = "<input name=Friend type=submit value=" + jsonobject[i] + " onClick=\"javascript:openconversation('"+jsonobject[i]+"');\"> <br>";

                  listbox.appendChild(friend);
            };
        }
        else{
            document.getElementById("friendbox").innerHTML = "Failed to load";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    
}
function openconversation(user){
    alert("Hi "+user);
}

function checkAddFriend(){
    var friend = document.getElementById("AddFriendtextfield").value;
    if (friend.length > 0){
        if(friend.length > 2){
            AddFriend(friend);
            document.getElementById("status").innerHTML = "";
        }
        else{
            document.getElementById("status").innerHTML = "Please enter more then 2 characters";
        }
    }
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }

}

function AddFriend(friend){
    alert("Hi "+ friend);
}