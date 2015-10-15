
$(document).ready(function()
{
	
	var g;
	$('#first_name').blur(function()
	{
		var v= this.value;
		if(v.length >0)
		{
			$('#first_name_group').addClass("has-success").removeClass("has-error");
			$('#first_name_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			$('#first_name_group').removeClass("has-success").addClass("has-error");
			$('#first_name_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
    
	
	
	$('#last_name').blur(function()
	{
		
		var v=this.value;
		if(v.length>0)
		{
			$('#last_name_group').addClass("has-success").removeClass("has-error");
			$('#last_name_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			$('#last_name_group').removeClass("has-success").addClass("has-error");
			$('#last_name_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	
	$('#email').blur(function()
	{
		
		var v=this.value;
		if(v.length>0)
		{
			$.post('php/check_email.php',{ email : v },function(data){
				if(data == "true")
				{
						$('#email_group').removeClass('has-error').addClass('has-success');
						$('#email_feedback').removeClass('glyphicon-remove').addClass('glyphicon-ok');
					}
					else
					{
						$('#email_group').removeClass('has-success').addClass('has-error');
						$('#email_feedback').removeClass('glyphicon-ok').addClass('glyphicon-remove');
					}
			}).error(function(){
					alert("An error occurred. Unable to validate email");
				});
		}
		else
		{
			$('#email_group').removeClass("has-success").addClass("has-error");
			$('#email_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
		
	});
	
	
	
	$('#username').blur(function()
	{
		
			var v=this.value;
			if(v == "")
			{
				$('#username_group').removeClass("has-success").addClass("has-error");
				$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
			}
			else if(username.length < 4)
			{
				$('#username_group').removeClass("has-success").addClass("has-error");
				$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
			}
			else
			{
				$.post('php/check_username_avail.php',{ username : v },function(data){
					
						if(data == "false")
						{
							$('#username_group').removeClass("has-success").addClass("has-error");
							$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
						}
						else if(data == "true")
						{
							$('#username_group').addClass("has-success").removeClass("has-error");
							$('#username_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
						}
						else
						{
							$('#username_group').removeClass("has-success").addClass("has-error");
							$('#username_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
						}
					}).error(function(){
						alert("An error occurred. Unable to validate username");
					});
			}
	});
	
	$('#password1').blur(function()
	{
		
		var v=this.value;
		g=v;
		if(v.length>5)
		{
			$('#password1_group').addClass("has-success").removeClass("has-error");
			$('#password1_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			$('#password1_group').removeClass("has-success").addClass("has-error");
			$('#password1_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	
	
	
	$('#password2').blur(function()
	{
		var v=this.value;
		if(v==g && v.length>=6)
		{
			$('#password2_group').addClass("has-success").removeClass("has-error");
			$('#password2_feedback').addClass("glyphicon-ok").removeClass("glyphicon-remove");
		}
		else
		{
			$('#password2_group').removeClass("has-success").addClass("has-error");
			$('#password2_feedback').removeClass("glyphicon-ok").addClass("glyphicon-remove");
		}
	});
	

});








