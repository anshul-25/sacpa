function getCity(id,selectId) {
	$.ajax({
		type: "GET",
		url: "getCity.php",
		data: "stateid=" + id,
		success: function(result) {
			$(selectId).html(result);
		}
	});
};

function getStates(id,selectId) {
	$.ajax({
		type: "GET",
		url: "getStates.php",
		data: "countryid=" + id,
		success: function(result) {
			$(selectId).html(result);
		}
	});
};


var max_fields      = 10;
var wrapper         = $(".addDetails");
var add_button      = $(".add_form_field");
var x = 1;

function addActivity() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addActivity.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addCC() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addCC.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addClubs() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addClubs.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addProgramme() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addProgramme.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addDepartment() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addDepartment.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addSubject() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addSubject.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addInternship() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addInternship.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addPlacement() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addPlacement.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

function addSubMarks() {
	if(x < max_fields)
	{
		x++;
		$.ajax({
			type: "GET",
			url: "addSubMarks.php",
			data: "x="+x,
			success: function(result) {
				$(wrapper).append(result);
			}
		});
	}
};

$(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

