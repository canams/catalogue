$(document).ready(function() {
 	var eclicked, tclicked;
 	//hide edit artist box
	$('.onedit').hide();
	$('.onadd').hide();
	$('.alert').hide();
	set_links();
	
	//switch to edit page when edit button clicked
	var a = document.getElementsByClassName("editbutton");
	var hid = document.getElementById('artid');
	
	
	for (var j = 0; j < a.length; j++) {
		a[j].onclick = function(e) {
			e.preventDefault();

			document.getElementById("titlehead").innerHTML = "Edit Artist";
    		$('div').remove('.search');
    		$('div').remove('.add');
    		$('table').remove('.editclicks');
    		$('.onedit').show();
    		eclicked = this.id;
    		var input = document.getElementById('edit_query');
			input.setAttribute("value", eclicked);
			var submitedit = document.getElementsByClassName('edit_submit');
			submitedit[0].setAttribute("id", eclicked);

			
			hid.setAttribute("value", eclicked);
			console.log(hid);
			return false;
            
          }
	}

	var b = document.getElementsByClassName("titlelink");
	var hidden = document.getElementById("title_id");
	var form = document.getElementById("titleform");
	
	for (var j = 0; j < b.length; j++) {
		b[j].onclick = function(e) {

    		tclicked = this.id;
    		hidden.setAttribute("value", tclicked);

    		form.submit();
            
          }
	}

	var c = document.getElementById('delete_button');
	c.onclick = function(){
		document.getElementById('titlehead').innerHTML = 'Artist Info';
    	$('div').show('.search');
    	$('div').show('.add');
    	$('table').show('.editclicks');
    	$('.onedit').hide();
	}

	var d = document.getElementById('add_artist_link');
	d.onclick = function() {
			document.getElementById("titlehead").innerHTML = "Add Artist";
    		$('div').remove('.search');
    		$('div').remove('.add');
    		$('table').remove('.editclicks');
    		//$('.alert').show();
    		$('.onadd').show();
    		return false;
	}
          
});

function set_links(){
	var result_array = result;
	
	//set class and unique id for all edit links 
	var links = document.querySelectorAll('a');
	var count = 0;

	for (var i = 0; i < links.length; i++) {
		var details = links[i].innerHTML;
		if(details == ' Edit '){
			links[i].setAttribute("class","editbutton");
			links[i].setAttribute("id", result[count]);
			count++;
		}
		
	}

	count = 0;

	for (var i = 0; i < links.length; i++) {
		var details = links[i].innerHTML;

		if(details != ' Edit ' && details != ' Add Artist ' && details != 'Artists'){
			links[i].setAttribute("class","titlelink");
			links[i].setAttribute("id", "title_"+ result[count]);
			count++;
		}
		
	}
}
