
window.onload = function()
{
	const prices = document.getElementsByName('price');
	const types = document.getElementsByName('type');

	let mon_canvas = document.getElementById('canvas');
	if(!canvas){
		alert("imposible de récupérer le canvas");
	}

	let ctx = mon_canvas.getContext('2d');
	if(!ctx){
		alert("imposible de récupérer le canvas");
	}


	var y = 10;

	for(let i = 0; i < types.length; i++){
		ctx.strokeRect(10,y,320,80);
		ctx.font = '20px Nunito';
		ctx.fillText(types[i].value,30,y+45);
		y += 80;
	}
// ctx.strokeRect(10,10,150,40);
// ctx.fillText("Constat", 20, 30);
//
// ctx.strokeRect(10,50,150,40);
// ctx.fillText("Recouvrement amiable", 20, 70);
//
// ctx.strokeRect(10,90,150,40);
// ctx.fillText("Recouvrement judiciaire", 20, 110);
//
// ctx.strokeRect(10,130,150,40);
// ctx.fillText("Expulsion", 20, 150);
//
// ctx.strokeRect(10,170,150,40);
// ctx.fillText("Saisie immobilière", 20, 190);

	y = 10;

	for(let i = 0; i < prices.length; i++){
		ctx.strokeRect(330,y,100,80);
		ctx.fillText(prices[i].value + ' €',360,y+45)
		y += 80;
	}
// ctx.strokeRect(160, 10, 100, 40);
// ctx.fillText("350 €", 180, 30);
//
// ctx.strokeRect(160, 50, 100, 40);
// ctx.fillText("200 €", 180, 70);
//
// ctx.strokeRect(160, 90, 100, 40);
// ctx.fillText("350 €", 180, 110);
//
// ctx.strokeRect(160, 130, 100, 40);
// ctx.fillText("400 €", 180, 150);
//
// ctx.strokeRect(160, 170, 100, 40);
// ctx.fillText("450 €", 180, 190);

}
