
let canvas=document.getElementById("simplecanvas");
let ctx=canvas.getContext("2d");
var r=0;
setInterval(function()
{
	ctx.beginPath();
	ctx.fillStyle="#000000";
	ctx.fillRect(0,0,r++,ctx.canvas.height);
	ctx.fill();
},1);

var z=ctx.canvas.width;
setInterval(function()
{
	ctx.beginPath();
	ctx.fillStyle="#000000";
	ctx.fillRect(z--,ctx.canvas.height-ctx.canvas.height,ctx.canvas.width,ctx.canvas.height);
	ctx.fill();

},1);


/*window.onload=canvas;

function canvas()
{
	var myCanvas=document.getElementById("simplecanvas");
	if(myCanvas && myCanvas.getContext("2d"))
	{
		var context=myCanvas.getContext("2d");
		var r=50;
		var x = -r;
		
		
		setInterval(function(){
			context.fillStyle   = "rgba(0,0,0,0.0)";
			context.fillRect(0, 0, context.canvas.width, context.canvas.height);
 
			context.beginPath();
			context.fillStyle   = "#212529";
			context.arc(x++, context.canvas.height/30, r, 0, 2 * Math.PI);
			context.fill();
 
			if( x >= context.canvas.width + r)
			    x  = -r; 
		}, 1);
	}
}
*/