$('#loginForm').on('submit', function(e){
    e.preventDefault();
    // fetch values.
    var username = $("#username").val();
    var password = $("#password").val();
    
    $.ajax({
      type: 'POST',
      url: 'loginProcess.php',
      data: {
        username: username,
        password: password
      },
      success: function(output){
          var outputObj = JSON.parse(output);
          if(outputObj['resultType'] == 'success'){
          window.location.href = "allRegistrations.php";
          }else{
            // alert("here..."+ outputObj['errorType']);
            $('#errors').html(`Invalid credentials, please try again!`);
          }
      }
    });
  });