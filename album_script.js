$(document).ready(function() {

	$('.onedit').hide();
	$('.onadd').hide();
	set_links();
	//switch to edit page when edit button clicked
	var a = document.getElementsByClassName("editbutton");

	var hidden = document.getElementById("edit_album");
	
	for (var j = 0; j < a.length; j++) {
		a[j].onclick = function(e) {
			e.preventDefault();
			document.getElementById("titlehead").innerHTML = "Edit Album";
    		$('div').remove('.search');
    		$('div').remove('.add');
    		$('table').remove('.editclicks');
    		$('.onedit').show();
    		clicked = this.id;
    		var priceVal = album_result[j-8];
    		var genreVal = album_result[j-7];
    		//find a way of setting value of input to right album_result index
    		var title_input = document.getElementById('album_edit_title');
    		var price_input = document.getElementById('album_edit_price');
    		var genre_input = document.getElementById('album_edit_genre');
			title_input.setAttribute("value", clicked);
			price_input.setAttribute("value", priceVal);
			genre_input.setAttribute("value", genreVal);
			hidden.setAttribute("value", clicked);

			return false;
            
          }
	}

	var b = document.getElementById('delete_button');
	b.onclick = function(){
		document.getElementById('titlehead').innerHTML = 'Album Info';
    	$('div').show('.search');
    	$('div').show('.add');
    	$('table').show('.editclicks');
    	$('.onedit').hide();
	}

	var c = document.getElementById('add_album_link');
	c.onclick = function() {
			document.getElementById("titlehead").innerHTML = "Add Album";
    		$('div').remove('.search');
    		$('div').remove('.add');
    		$('table').remove('.editclicks');
    		//$('.alert').show();
    		$('.onadd').show();
    		return false;
	}

          
});

function set_links(){
	var result = album_result;

	//set class and unique id for all edit links
	var links = document.querySelectorAll('a');
	var count = 0;

	for (var i = 0; i < links.length; i++) {
		var details = links[i].innerHTML;
		if(details == ' Edit '){
			links[i].setAttribute("class","editbutton");
			links[i].setAttribute("id", album_result[count]);
			//console.log(links[i]);
			count+=3;
		}
		
	}
}

function validateForm() {
    var form_input = document.forms["addform"]["add_price"].value;
    if (Number.isInteger(parseInt(form_input)) == false) {
        alert("Please enter a number for album price");
        return false;
    }
}
