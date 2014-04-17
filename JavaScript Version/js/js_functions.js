// called when the login button is clicked
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

    // uses post and puts our php files as where we need to go
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    // Have no idea what this means. it was on the tutorial I watched
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    // This is ASYNCHRONOUS BTW. what this does is when we do get a response back from the database (because it takes time)
    // then run this code. in the meantime, run the code after. This is why we see processing.... on the page before an actually useful message.
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked we got a response period
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
        	// since this is the login method, the php checks in the user exists. if yes then we can log, if no then error message
            var return_data = httpRequest.responseText;
            // php returned true so display a message and go to friend.php
            if (return_data == 1){
                document.getElementById("status").innerHTML = "Logging in";
                window.location.href = 'friends.php';
            }
            // php returned false so user didn't exist
            else{
                document.getElementById("status").innerHTML = "Username does not exist";
            }
        }
        // Didn't get a response. either a bad connection or the more likely case is a bad php file. usually wrong syntax, runtime error, or permissions
        else{
            document.getElementById("status").innerHTML = "Failed. Try again.";
        }
    };

    // Actually send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    // while waiting, display processing...
    document.getElementById("status").innerHTML = "processing....";
}

// called when the new user button is clicked
function checkregister(){
	// grabs the user input
    var user = document.getElementById("Usernameinput").value;
    // checks if anything was submited
    if (user.length > 0){
    	// checks if it is at least 3 character (just because)
        if(user.length > 2){
        	//attemps to register
            register(user);
        }
      	// otherwise output error
        else{
            document.getElementById("status").innerHTML = "Please enter more then 2 characters";
        }
    }
    // otherwise output error
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }
}

// Attmpets to register by calling registeruser.php
function register(user){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();
    

    // variables for our PHP file
    var urlstub = "php/registeruser.php";
    var varstub = "username="+user;
    // uses post and puts our php files as where we need to go
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    // Have no idea what this means. it was on the tutorial I watched
     httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Access the onreadystatechange event for the XMLHttpRequest object
    // This is ASYNCHRONOUS BTW. what this does is when we do get a response back from the database (because it takes time)
    // then run this code. in the meantime, run the code after. This is why we see processing.... on the page before an actually useful message.
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked we got a response period
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
        	// since this is the register method, the php checks in the user exists. if yes then we registered successfully, otherwise boo!
            var return_data = httpRequest.responseText;
            // php returned true so no one has the name, we're good to go
            if (return_data == 1){
                document.getElementById("status").innerHTML = "Registered";
            }
            // php returned false so user already exist
            else{
                document.getElementById("status").innerHTML = "Username already exists";
            }
        }
        // Didn't get a response. either a bad connection or the more likely case is a bad php file. usually wrong syntax, runtime error, or permissions
        else{
            document.getElementById("status").innerHTML = "Failed. Try again.";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    // while waiting, display processing
    document.getElementById("status").innerHTML = "processing...";
}

function firstload(){
    loadfriends();

}

// this method is called automaticlly in the <body> of friends.php as a onload event
// it should also be called whenever we want to refresh the friends list
function loadfriends(){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();
    
    // variables for our PHP file
    var urlstub = "php/loadfriends.php";
    var varstub = "";
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    // Have no idea what this means. it was on the tutorial I watched
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

   // Access the onreadystatechange event for the XMLHttpRequest object
    // This is ASYNCHRONOUS BTW. what this does is when we do get a response back from the database (because it takes time)
    // then run this code. in the meantime, run the code after. This is why we see processing.... on the page before an actually useful message.
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
        	// ok so here's the deal. when the php is successful then we get returned a josn array of names.
        	// these are the friends of the current user.

        	// first we clear the friend box which other wise will say Failed to load
            document.getElementById("friendbox").innerHTML = "";

            // takes the responseText which is the return value. this will be a json string
            var return_data = httpRequest.responseText;

            // parses the string so now it's a javascript array
            var jsonobject = JSON.parse(return_data);
	    
            // Sorts your friends list
	    jsonobject.sort();

            // grabs the location of where we're going to dump the friends list
            var listbox = document.getElementById('friendbox');

            // removes all elements inside. this insures that the list we get is always new
            while (listbox.firstChild) {
                listbox.removeChild(listbox.firstChild);
            }

            // loops through all the friends
            for (var i = 1; i < jsonobject.length; i++) {
                  
                  // with each friend we make a new div element
                  var friend = document.createElement('div');
                  // set the id to Friend
                  friend.setAttribute('id','Friend');
                  // and then make it a button with each button having the name of the friend and an onclick link to
                  // the open conversation function with their name as a parameter.
		  friend.innerHTML = "<input name=Friend type=submit value=" + jsonobject[i] + " onClick=\"javascript:openconversation('"+jsonobject[i]+"');\"> <br>";
                  // adds them to our friend box
                  listbox.appendChild(friend);
            };
        }
        // nothing came back so error out?
        else{
            document.getElementById("friendbox").innerHTML = "Failed to load";
        }
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    
}

// Haven't done this yet but I have a plan. since this is javascript we can find the placeholders of where we're putting this data
// hence why I wanted to put it all on one page. second we load the pictures that are currently on file for both users. we have both 
// names so that's not a problem. then we either A. figure out how to push updates or B. refresh the picture every say 5=30 secs.
function openconversation(user){
 	// in the meantime HI
    alert("Hi "+user);
    
}

// called when the Add Friend button is clicked
function checkAddFriend(){
    // grabs the user input
    var friend = document.getElementById("AddFriendtextfield").value;
   
    // clears the input text field 
    document.getElementById("AddFriendtextfield").value = '';

    // checks if anything was submited
    if (friend.length > 0){
        // checks if it is at least 3 character (just because)
        if(friend.length > 2){
        	// attempts to add them as a friend
            AddFriend(friend);
            document.getElementById("status").innerHTML = "";
        }
        // otherwise output error
        else{
            document.getElementById("status").innerHTML = "Please enter more then 2 characters";
        }
    }
    // otherwise output error
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }

}

//Attempts to add this as friends by calling addfriend.php
function AddFriend(friend){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();
    
    // variables for our PHP file
    var urlstub = "php/addfriend.php";
    var varstub = "friendname="+friend;
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    // Have no idea what this means. it was on the tutorial I watched
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

   // Access the onreadystatechange event for the XMLHttpRequest object
    // This is ASYNCHRONOUS BTW. what this does is when we do get a response back from the database (because it takes time)
    // then run this code. in the meantime, run the code after. This is why we see processing.... on the page before an actually useful message.
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = httpRequest.responseText;
	    // 1= added, 0=user doesn't exist, and -1= failed you're already friends 
	    if (return_data == 1){
	    	loadfriends();
            	document.getElementById("status").innerHTML = "New Friend added :3"; 	
	    }
	    else if(return_data == 0){
            	document.getElementById("status").innerHTML = "Username does not exist"; 		
	    }
	    else{
            	document.getElementById("status").innerHTML = "You're already friends"; 		
	    }
	}
        // nothing came back so error out?
        else{
            document.getElementById("status").innerHTML = "Failed to load";
	}       
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    
}

// this is actually just broken. I stopped before I finished debugging.
// called when the delete Friend button is clicked.
function checkDeleteFriend(){
    // grabs the user input
    var friend = document.getElementById("DeleteFriendtextfield").value;

    // clears the input text field 
    document.getElementById("DeleteFriendtextfield").value = '';

    // checks if anything was submited
    if (friend.length > 0){
        // checks if it is at least 3 character (just because)
        if(friend.length > 2){
        	//attempts to delete
            DeleteFriend(friend);
            document.getElementById("status").innerHTML = "";
        }
        // otherwise output error
        else{
            document.getElementById("status").innerHTML = "Please enter more then 2 characters";
        }
    }
    // otherwise output error
    else{
        document.getElementById("status").innerHTML = "No Username Entered";
    }

}

// attempts to delete two friends by calling deletefriend.php
function DeleteFriend(friend){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();
    
    // variables for our PHP file
    var urlstub = "php/deletefriend.php";
    var varstub = "friendname="+friend;
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    // Have no idea what this means. it was on the tutorial I watched
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

   // Access the onreadystatechange event for the XMLHttpRequest object
    // This is ASYNCHRONOUS BTW. what this does is when we do get a response back from the database (because it takes time)
    // then run this code. in the meantime, run the code after. This is why we see processing.... on the page before an actually useful message.
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = httpRequest.responseText;
	    // 1= deleted, 0 = user doesn't exist, and -1= failed you're already not friends 
	    if (return_data == 1){
	    	loadfriends();
            	document.getElementById("status").innerHTML = "Friend Deleted :("; 	
	    }
	    else if(return_data == 0){
            	document.getElementById("status").innerHTML = "Username does not exist"; 		
	    }
	    else{
            	document.getElementById("status").innerHTML = "You were never friends"; 		
	    }
	}
        // nothing came back so error out?
        else{
            document.getElementById("status").innerHTML = "Failed to load";
	}       
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    
}

function logout(){
    // Creates a XMLHttpRequest object
    var httpRequest = new XMLHttpRequest();
    
    // variables for our PHP file
    var urlstub = "php/logout.php";
    var varstub = "";
    httpRequest.open("POST", urlstub, true);

    // Set content type header information for sending url encoded variables in the request
    // Have no idea what this means. it was on the tutorial I watched
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

   // Access the onreadystatechange event for the XMLHttpRequest object
    // This is ASYNCHRONOUS BTW. what this does is when we do get a response back from the database (because it takes time)
    // then run this code. in the meantime, run the code after. This is why we see processing.... on the page before an actually useful message.
    httpRequest.onreadystatechange = function() {
        // "httpRequest.readyState == 4 && httpRequest.status == 200" means that it worked
        if(httpRequest.readyState == 4 && httpRequest.status == 200) { 
            document.getElementById("status").innerHTML = "Yay";
            window.location.href = 'login.php';
 
	}
        // nothing came back so error out?
        else{
            document.getElementById("status").innerHTML = "Failed";
	}       
    };

    // Send the data to PHP now... and wait for response to update the status div
    httpRequest.send(varstub);
    document.getElementById("status").innerHTML = "Logging out";
}
