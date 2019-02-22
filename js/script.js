<script type="text/javascript">
var flag = [0,0,0,0,0,0,0];
var i;
var usn=document.getElementById("usn");
var sec=document.getElementById("sec");
var sem=document.getElementById("sem");
var mail=document.getElementById("email");
var phno=document.getElementById("phno");
function checkusn()
{
var test=usn.value.search(/^[1-4]\w{2}\d{2}[a-zA-Z][a-zA-Z]\d{3}$/);
if(!(test>=0)){
alert("usn is invalid");
flag[0]=1;
}
else
{
flag[0]=0;
}
}
function checksem()
{
var test1=sem.value.search(/^[1-8]$/);
if(!(test1>=0))
alert("Invalid Semester");
}
function checksec()
{
var test1=sem.value.search(/^[A-Z]$/);
if(!(test1>=0))
alert("Invalid Section");
}

function checkmail()   
{  
var test1=mail.value.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value));
if((!mail>=0))   
    alert("You have entered an invalid email address!");  
}  
	
function checkphno()
{
var test1=phno.value.search(/^[0-9]{10}$/);
if(!(test1>=0))
alert("Invalid Phone Number");
}
window.onsubmit=function()
{
for(i=0;i<7;i++)
{
if(flag[i]==1)
{
return false;
}
}
}
</script>
