$(document).ready(function()
{
	
	//global variable to store password1
	var g;
	var check= new Array(6);
	
	for(var i=0;i<6;i++)
		check[i]=false;
	
	
	/**************************************Signup form validation************************************************/
	//check if first name is non empty
	$('#first_name').blur(function()
	{
		var v= this.value;
		if(v.length >0)
		{
			check[0]=true;
			removePopover(this);
			$('#first_name_group').addClass("has-success").removeClass("has-error");
			$('#first_name_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			check[0]=false;
			addPopover(this,'This field is required!');
			$('#first_name_group').removeClass("has-success").addClass("has-error");
			$('#first_name_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	//Check if last name is non empty
	$('#last_name').blur(function()
	{
		
		var v=this.value;
		if(v.length>0)
		{
			check[1]=true;
			removePopover(this);
			$('#last_name_group').addClass("has-success").removeClass("has-error");
			$('#last_name_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			check[1]=false;
			addPopover(this,'This field is required');
			$('#last_name_group').removeClass("has-success").addClass("has-error");
			$('#last_name_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	//Check email
	//Check if it is in correct format
	//Example .ajax()
	$('#email').blur(function()
	{
		
		var v=this.value;
		if(v.length>0)
		{
			$.ajax({
				url:'php/check_email.php',
				data: {email : v },
				type: 'post',
				success: function(data)
						{
							if(data == "true")
							{
								check[2]=true;
								removePopover('#email');
								$('#email_group').removeClass('has-error').addClass('has-success');
								$('#email_feedback').removeClass('glyphicon-remove').addClass('glyphicon-ok');
							}
							else if(data == "invalid")
							{
								check[2]=false;
								addPopover('#email','Please enter a valid email address');
								$('#email_group').removeClass('has-success').addClass('has-error');
								$('#email_feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
							}
							else if(data == "taken")
							{
								check[2]=false;
								addPopover('#email','This email already has an account with us!');
								$('#email_group').removeClass('has-success').addClass('has-error');
								$('#email_feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
							}
							else
							{
								check[2]=false;
								addPopover('#email',data);
								$('#email_group').removeClass('has-success').addClass('has-error');
								$('#email_feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
							}
						}
			}).fail(function(){
					check[2]=false;
					alert("An error occurred. Unable to validate email");
				})
			  .done(function(){
					//alert("Ajax call complete");
			  })
			  .always(function(){
					//alert("This will be shown always");
			  });	
		}
		else
		{
			check[2]=false;
			addPopover(this,'This field is required!')
			$('#email_group').removeClass("has-success").addClass("has-error");
			$('#email_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
		
	});
	
	
	//Check username
	//Check if the length is greater than 3 and no username already exists. Several other checks included
	//example .post()
	
	$('#username').blur(function()
	{
		
			var v=this.value;
			if(v == "")
			{
				check[3]=false;
				addPopover(this,'This field is required!');
				$('#username_group').removeClass("has-success").addClass("has-error");
				$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
			}
			else if(username.length < 4)
			{
				check[3]=false;
				addPopover('#username','The username must be atleast 4 characters long');
				$('#username_group').removeClass("has-success").addClass("has-error");
				$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
			}
			else
			{
				$.post('php/check_username_avail.php',{ username : v },function(data){
					
						if(data == "false")
						{
							check[3]=false;
							addPopover('#username','Sorry! this username is already taken.');
							$('#username_group').removeClass("has-success").addClass("has-error");
							$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
						}
						else if(data == "true")
						{
							check[3]=true;
							removePopover(this);
							$('#username_group').addClass("has-success").removeClass("has-error");
							$('#username_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
						}
						else
						{
							check[3]=false;
							addPopover('#username',data);
							$('#username_group').removeClass("has-success").addClass("has-error");
							$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
						}
					}).error(function(){
						check[3]=false;
						alert("An error occurred. Unable to validate username");
					});
			}
	});
	
	//Validate password1
	//Check if the length is greater than 5
	$('#password1').on('keyup keypress blur change', function()
	{
		
		var v=this.value;
		g=v;
		if(v.length>5)
		{
			check[4]=true;
			removePopover(this);
			$('#password1_group').addClass("has-success").removeClass("has-error");
			$('#password1_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			check[4]=false;
			addPopover(this,'Your password must be atleast 6 characters long.');
			$('#password1_group').removeClass("has-success").addClass("has-error");
			$('#password1_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	//Validate password2 
	//Check if the length is greater than 5 and it is same as password1
	$('#password2').on('keyup keypress blur change', function()
	{
		var v=this.value;
		if(v==g && v.length>=6)
		{
			check[5]=true;
			removePopover();
			$('#password2_group').addClass("has-success").removeClass("has-error");
			$('#password2_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			check[5]=false;
			addPopover(this,'The two passwords do not match');
			$('#password2_group').removeClass("has-success").addClass("has-error");
			$('#password2_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});

	//function to add popover
	function addPopover(id,message)
	{
		$(id).attr("data-toggle","popover");
		$(id).attr("data-trigger","focus");
		$(id).attr("data-placement","left");
		$(id).attr("data-content",message);
		$(id).popover();
	}
	
	//function to remove popover
	function removePopover(id)
	{
		$(id).popover('destroy')
	}
	
	
	
	/************************************Functionality for signup******************************************/
	$('#signup_form').submit(function(){
		
		//Check if the all form validation is ok
		for(var i=0;i<6;i++)
		{
			if(check[i]==false)
			{
				$('#signup_submit_feedback').html('<p class="text-danger"><b >Please correct the above errors first before submitting!!</b></p>');
				return false;
			}
		}
		
		$('#signup_submit_feedback').html('<p class="text-success"><b >Everything ok! Please wait while we submit the form !!</b></p>');
		
		//Serialize the data in the form
		var contents = $(this).serialize();
		
		$.ajax({
			url: 'php/signup_functional.php',
			data: contents,
			type: 'post',
			success: function(data)
					 {
						console.log(data);
						if(data=="successful")
						{
						$('#signup_submit_feedback').html('<p class="text-success"><b >Signup successfull!! redirecting you to next page...</b></p>');
						window.location="step2.php";
						}
						else
						{
							alert("Some error occurred, please check console");
						}
					 }
		}).fail(function(){
			alert("Some error occured in submitting the signup form!");
		});
		
		return false;
	});
    
	
	
	
	
	/**************************************************Functionality for login**************************************/
	$('#login_form').submit(function(){
		
		//Serialize the data in the form
		var contents = $(this).serialize();
		
		$.ajax({
			url: 'php/login_functional.php',
			data: contents,
			type: 'post',
			success: function(data)
					 {
						console.log(data);
						if(data=="successful")
						{
							$('#login_submit_feedback').html('<p class="text-success"><b>Login successfull!! redirecting you to your home page...</b></p>');
							window.location="home.php";
						}
						else
						{
							$('#login_submit_feedback').html('<p class="text-danger"><b>'+data+'</b></p>');
						}
					 }
			
		}).fail(function()
		{
			alert("Some error occured in submitting the login form!");
		});
		
		return false;
	});
	
	
	
});








