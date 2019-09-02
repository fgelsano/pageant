$(document).ready(function(){
	$("form").on('submit', function(e){
		e.preventDefault();
		var action = $(this).attr("action");
		var users = $(this).serializeArray();
		var user = users[0].value;
		var pass = users[1].value;
		if(user == ''){ return;}

		var token = "";
		$.ajax({
			url: 'api/user.php',
			method: 'GET',
			data: {
				user: user,
				pass:pass
			},
			success: function(data){
				token = data;
				if(data != 'null'){
					if(data.user.Status == 'LOGIN'){
						$("form p").html("You are not allowed to login simultaneously");
						$("form p").slideDown("fade");
					}
					if(data.user == '0'){
						$("form p").html("Invalid Username and Password");
						$("form p").slideDown("fade");
					}
					if(data.user.Status == 'LOGOUT'){
						action += "?cat=" + data.category[0].name;
						$.ajax({
							url: 'api/users.php',
							method: 'POST',
							data: {
								user: user
							},
							success: function(data){
								if(data.user == "1"){
									localStorage.setItem("token" , JSON.stringify(token));
									location.href = action;
								}
							}
						})
					}
				}
			}
		})
	})

	if(localStorage.token != ""){
		var token = JSON.parse(localStorage.token);
		location.href = "view.php" + "?cat=" + token.category[0].name;
	}
});





