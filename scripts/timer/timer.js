
var ms=0;
var sec=0;
var min=0;
var hr=0;

function loadTime(){

	if(hr>=1){
	document.getElementById('timer').innerHTML=parseInt(hr)+" Hours: "+parseInt(min)+" Minutes : "+parseInt(sec)+" Seconds : "+parseInt(ms)+" Milliseconds ";
	}
	else if(min>=1){
	document.getElementById('timer').innerHTML=parseInt(min)+" Minutes : "+parseInt(sec)+" Seconds : "+parseInt(ms)+" Milliseconds ";
	}
	else if(sec>=1){
	document.getElementById('timer').innerHTML=parseInt(sec)+" Seconds : "+parseInt(ms)+" MilliSeconds ";
	}
	else{
	document.getElementById('timer').innerHTML=parseInt(ms)+" Milliseconds ";
	}



	ms=ms+1;
	
	if(ms==60){
		ms=0;
		sec=sec+1;;
	}
	
	if(sec==60){
		ms=0;
		sec=0;
		min=min+1;
	}
	
	if(min==60){
		ms=0;
		sec=0;
		min=0;
		hr=hr+1;
	}
}

var interval;



function stopTimer(){
	clearInterval(interval);
}

function startTimer(){
	interval=setInterval('loadTime();',1000/60);
}
