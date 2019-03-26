function validateInsertForm()
{
    var x = document.insertForm;
    if(x.user.value==0)
    {
    	alert("must select one option");
    	return false;
    }
    if(x.mobile.value.length!=10)
    {
    	alert("invalid mobile number");
    	return false;
    }
	
	  if(x.pincode.value.length!=6)
    {
    	alert("please enter valid pincode");
    	return false;
    }
	 if(isNaN(x.pincode.value))
   	{
   		alert("please enter digits in pincode");
    	return false;
    }

	
    if(x.password.value.length<6)
    {
    	alert("password should be atleast 6 characters");
    	return false;
    }
    if(x.password.value!=x.password2.value)
    {
    	alert("wrong password");
    	return false;
    }
   
    if(isNaN(x.mobile.value))
   	{
   		alert("please enter digits in mobile field");
    	return false;
    }

	  
}
function updatePassword()
{
	var x = document.changePassword;
	if(x.old_pswd.value.length<6)
    {
    	alert("please enter a valid password");
    	return false;
    }
	if(x.new_pswd.value.length<6)
    {
    	alert("password should be atleast 6 characters");
    	return false;
    }
	if(x.new_pswd.value!=x.new_pswd1.value)
    {
    	alert("passwords dosen't match");
    	return false;
    }
	
}

	
	
function validateLoginForm()
{
     
	  var x=document.loginForm;
	  if (x.mylist.value==0)
      {
        alert("please select one option from from sign-in as menu");
        return false;
		
	  }
	  if(x.username.value=="")
	  {
	     alert("Please enter the username");
        return false;	
	  }
	  if(x.password.value=="")
	  {
		  alert("invalid password");
		  return false;
	  }
      
}
 function validateLeadRegisterForm()
 {
	var x=document.leadRegisterForm;
	if(x.mobile.value.length!=10)
    {
    	alert("invalid mobile number");
    	return false;
    }
	
	if(isNaN(x.mobile.value))
   	{
   		alert("please enter digits in mobile field");
    	return false;
    }
 }
 
 function validateUpdateProfileForm()
 {
	 var x=document.updateProfileForm;
	 if(x.mobile.value.length!=10)
    {
    	alert("invalid mobile number");
    	return false;
    }
    if(isNaN(x.mobile.value))
   	{
   		alert("please enter digits in mobile field");
    	return false;
    }
 }
function validateemployeeUpdateForm()
{
	 var x = document.employeeUpdateForm;
	 if(x.role.value==0)
    {
    	alert("must select one option");
    	return false;
    }
	if(x.mobile.value.length!=10)
    {
    	alert("invalid mobile number");
    	return false;
    }
	if(isNaN(x.mobile.value))
   	{
   		alert("please enter digits in mobile field");
    	return false;
    }
	 
}
