var j=0;
		var i=document.getElementById("menu").childNodes;
		
		function expand(){
			if(j==0){
				document.getElementById("add").style.transform = 'rotate(-30deg)';
				document.getElementById("menu").style.transform='scale(1)';
				i[1].style.transform='translate(75px,-10px)';
				i[9].style.transform='translate(-60px,-8px)';
				i[11].style.transform='translate(10px,-85px)';
			j=1;

		}
		else{
				document.getElementById("add").style.transform = 'rotate(0deg)';
				document.getElementById("menu").style.transform='scale(0.9)';
				i[1].style.transform='translateY(0)';
				i[9].style.transform='translatey(0)';
				i[11].style.transform='translateY(0)';

				j=0;
		}
	}