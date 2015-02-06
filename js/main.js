/* ================
showFederation: 
  hides the search div and replaces it with a div
  for the specfic federations that the user is searching for
================ */
function showFederation(id) {
	var resultsPlaceholder = document.getElementById('infodisplay');

	//check for -1
	if(id == -1) {
		resultsPlaceholder.innerHTML = "<h2>Select A Federation Above To Begin</h2>";
		return;
	}


  //hide the search box
  //document.getElementById("search").style.display = "none";
  //show the infodisplay div and update its content for the
  //given federation
  //document.getElementById("infodisplay").style.display = "block";

  document.getElementById("infodisplay").innerHTML += federations[id];


	var templateSource = document.getElementById('federation-template').innerHTML;

	var template = Handlebars.compile(templateSource);

	var data = {
			"name": federations[id].name,
			"address": federations[id].address,
			"phone": federations[id].phone,
			"fax": federations[id].fax,
			"email": federations[id].email,
			"website": federations[id].website,
			"mission": federations[id].mission,
			"president": federations[id].people.president,
			"vicepresident": federations[id].people.vicepresident,
			"secretary": federations[id].people.secretary
	};

	resultsPlaceholder.innerHTML = template(data);
}