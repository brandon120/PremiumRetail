
function pickcolor(){
	var test=document.getElementById("coloroption");
    var style=test.style.display;
        if(style=='none')
        	{
            test.style.display='flex';
			test.style.flexDirection='row';
			test.style.justifyContent='center';
        	}
    	else{
            test.style.display='none';
        	}
}

function capacitypick() {
	
	
	var capacity=document.getElementById("capacityoption");
    var style=capacity.style.display;
        if(style=='none')
        	{
            capacity.style.display='block';
        	}
    	else{
            capacity.style.display='none';
        	}
}

function showdescription() {
	
	
	var description=document.getElementById("descriptionshow");
    var style=description.style.display;
        if(style=='none')
        	{
            description.style.display='block';
        	}
    	else{
            description.style.display='none';
        	}
}





