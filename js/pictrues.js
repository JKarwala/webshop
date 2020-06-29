function setpic(number)
{
	number=parseInt(number);
	switch(number)
	{
		case 1: var phpdata=document.getElementById("img1").value; break;
		case 2: var phpdata=document.getElementById("img2").value; break;
		case 3: var phpdata=document.getElementById("img3").value; break;
		case 4: var phpdata=document.getElementById("img4").value; break;
	}
	var file = "<img src=\""+phpdata+"\">";
	document.getElementById("pic").innerHTML=file;
}