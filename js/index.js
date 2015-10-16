$(document).ready(function()
{
	
	//global variable to store password1
	var g;
	
	//check if first name is non empty
	$('#first_name').blur(function()
	{
		var v= this.value;
		if(v.length >0)
		{
			removePopover(this);
			$('#first_name_group').addClass("has-success").removeClass("has-error");
			$('#first_name_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
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
			removePopover(this);
			$('#last_name_group').addClass("has-success").removeClass("has-error");
			$('#last_name_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			addPopover(this,'This field is required');
			$('#last_name_group').removeClass("has-success").addClass("has-error");
			$('#last_name_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	//Check email
	//Check if it is in correct format
	$('#email').blur(function()
	{
		
		var v=this.value;
		if(v.length>0)
		{
			$.post('php/check_email.php',{ email : v },function(data){
				if(data == "true")
				{
					removePopover('#email');
					$('#email_group').removeClass('has-error').addClass('has-success');
					$('#email_feedback').removeClass('glyphicon-remove').addClass('glyphicon-ok');
				}
				else
				{
					addPopover('#email','Please enter a valid email address');
					$('#email_group').removeClass('has-success').addClass('has-error');
					$('#email_feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
				}
			}).error(function(){
					alert("An error occurred. Unable to validate email");
				});
		}
		else
		{
			addPopover(this,'This field is required!')
			$('#email_group').removeClass("has-success").addClass("has-error");
			$('#email_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
		
	});
	
	
	//Check username
	//Check if the length is greater than 3 and no username already exists. Several other checks included
	$('#username').blur(function()
	{
		
			var v=this.value;
			if(v == "")
			{
				addPopover(this,'This field is required!');
				$('#username_group').removeClass("has-success").addClass("has-error");
				$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
			}
			else if(username.length < 4)
			{
				addPopover('#username','The username must be atleast 4 characters long');
				$('#username_group').removeClass("has-success").addClass("has-error");
				$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
			}
			else
			{
				$.post('php/check_username_avail.php',{ username : v },function(data){
					
						if(data == "false")
						{
							addPopover('#username','Sorry! this username is already taken.');
							$('#username_group').removeClass("has-success").addClass("has-error");
							$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
						}
						else if(data == "true")
						{
							removePopover(this);
							$('#username_group').addClass("has-success").removeClass("has-error");
							$('#username_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
						}
						else
						{
							addPopover('#username',data);
							$('#username_group').removeClass("has-success").addClass("has-error");
							$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
						}
					}).error(function(){
						alert("An error occurred. Unable to validate username");
					});
			}
	});
	
	//Validate password1
	//Check if the length is greater than 5
	$('#password1').keyup(function()
	{
		
		var v=this.value;
		g=v;
		if(v.length>5)
		{
			removePopover(this);
			$('#password1_group').addClass("has-success").removeClass("has-error");
			$('#password1_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			addPopover(this,'Your password must be atleast 6 characters long.');
			$('#password1_group').removeClass("has-success").addClass("has-error");
			$('#password1_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	//Validate password2 
	//Check if the length is greater than 5 and it is same as password1
	$('#password2').keyup(function()
	{
		var v=this.value;
		if(v==g && v.length>=6)
		{
			removePopover();
			$('#password2_group').addClass("has-success").removeClass("has-error");
			$('#password2_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
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
		$(id).removeAttr("data-toggle");
		$(id).removeAttr("data-trigger");
		$(id).removeAttr("data-placement");
		$(id).removeAttr("data-content");
	}
	
	
});








