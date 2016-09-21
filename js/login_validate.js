var valLogin=1;
var valPass=1;

function initLogin()
{
	login();
	passwordLogin();
}

$("#login").blur(function()
{
	login();
});


$("#passLogin").blur(function()
{
	passwordLogin();
});


function validate_email(val)
{
	var re=/^\S+@\w+\.\w+$/;
	return re.test(val);
}

function loginCheck()
{
	var login=$("#login").val();
	var password=$("#passLogin").val();
	initLogin();
	// console.log(login);
	if(valLogin==0 && valPass==0)
	{
		var q={"login":login,"password":password};
	  	q="q="+JSON.stringify(q);
	  	// console.log(q);
	  	var xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function()
	  	{
		    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		    {
		      	result=JSON.parse(xmlhttp.responseText);
		        if(result['location'])
		        {
		        	location.href=result['location'];
		        }
		        if(result['login'])
		        {
		        	$("#loginLabel p").remove("p");
					showLoginError(result['login']);
		        }
		        if(result['password'])
		        {
		        	$("#passLabelLogin p").remove("p");
					showPassError(result['password']);
		        }
		    }
	  	};
		xmlhttp.open("POST", "ajax/validate_login.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(q);
	}
	else
	{
		alert("Enter correct details");
	}
}

function showLoginError(txt)
{
	$("#login").css({"outline":"none","border-color":"red"});
	var txt1=$("<span></span>").text(txt).css({'font-size':'15px','color':'red','display':'inline-block',"padding": "5px"});
	$("#loginLabel").append(txt1);
}

function showPassError(txt)
{
	$("#passLogin").css({"outline":"none","border-color":"red"});
	var txt1=$("<span></span>").text(txt).css({'font-size':'15px','color':'red','display':'inline-block',"padding": "5px"});
	$("#passLabelLogin").append(txt1);
}

function login()
{
	var re=/^\S+@/;
	var val=$("#login").val();
	$("#loginLabel span").remove("span");
	// console.log(val);
	if(val=="")
	{
		showLoginError(" *Please enter your email or username");
	}
	else if(re.test(val))
	{
		var ret=validate_email(val);
		if(!ret)
		{
			showLoginError(" *Invalid Email");
		}
		else
		{
			$("#login").css({"outline":"none","border-color":"green"});
			valLogin=0;
		}
	}
	else
	{
		$("#login").css({"outline":"none","border-color":"green"});
		valLogin=0;
	}
}

function passwordLogin()
{
	var val=$("#passLogin").val();
	$("#passLabelLogin span").remove("span");
	if(val=="")
	{
		showPassError(" *Enter Password");
	}
	else
	{
		$("#passLogin").css({"outline":"none","border-color":"green"});
		valPass=0;
	}
}