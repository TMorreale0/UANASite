/* ================
showFederation: (id: string with name of federation)
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
	document.getElementById("infodisplay").innerHTML = "Loading...";
	getFederationData('Fed='+id);
}

/* ================
getFederationData: (fed: string with name of federation in POST format)
  calls a php script to fetch the data from the database
  and return the info in a json object for template to use
================ */
function getFederationData(fed) {
	var httpc = new XMLHttpRequest();
	var url = "php/get_info.php";
	httpc.open("POST", url, true);

	httpc.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	httpc.onload = function () {
		var text = this.responseText;
		text = text.replace(/(?:\\)/g, '\\\n');
		console.log(text);
		postData(text);
	}
	httpc.send(fed);

}

/* ================
postData: (federation: raw text in JSON style from get_data.php)
  callback function from getFederationData, called when the 
  php script returns database info. Takes info, and puts it into
  the handlebars template for display on the UI
================ */
function postData(federation) {
	var federation = eval( "(" + federation + ")");
	var resultsPlaceholder = document.getElementById('infodisplay');

	var templateSource = document.getElementById('federation-template').innerHTML;
	var template = Handlebars.compile(templateSource);

	var data = federation;
	
	resultsPlaceholder.innerHTML = template(data);
}

/* ================
changeData: (tab: int between [1, 3])
  hides/displays elements in the Contact Info, About, People
  tabs depending on which one is active at the time
================ */
function changeData(tab) {
	tab1 = document.getElementById('ContactInfo');
	tab2 = document.getElementById('About');
	tab3 = document.getElementById('People');

	if(tab == 1) {
		tab2.style.display = "none";
		tab3.style.display = "none";
		tab1.style.display = "block";
	} else if(tab == 2) {
		tab1.style.display = "none";
		tab3.style.display = "none";
		tab2.style.display = "block";
	} else {
		tab2.style.display = "none";
		tab1.style.display = "none";
		tab3.style.display = "block";
	}
}