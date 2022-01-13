let part_one = document.getElementsByClassName("part_one");


function check_part_one(){
	var temp_hold_one = [];
	for(var i = 0; i < part_one.length; i++){
		if(part_one[i].value ==""){

		}else{
		temp_hold_one.push(part_one[i].value);
	}
	}
	
	if(temp_hold_one.length == 3){
		document.getElementById('first_btn').style.display = "block";
	}

}