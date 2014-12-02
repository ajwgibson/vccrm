
<script type="text/javascript">

	var roles;

	$('#project_id, #role_id, #contact_id, .multi-select').select2();

	$('#project_id').on('change', function(event) {
	    changeProject();
	});

	$('#role_id').on('change', function(event) {

	    var role_id = $('#role_id').val();
	    for (var role = 0; role < roles.length; role++) {
	        if (roles[role].id == role_id) {
	            $('#hours').val(roles[role].hours);
	            break;              
	        }
	    } 

	});


	function changeProject() {

	    var role_select = $('#role_id');
	    role_select.prop("disabled", true);

	    var project_id = $('#project_id').val();
	    if (project_id == '') project_id = 0;

	    $.ajax({
	        
	        url: "/project/" + project_id + "/roles",

	        success: function(data) {
	            roles = data;
	            updateRoles();
	        },

	        error: function() {
	            roles = [];
	            updateRoles();
	        }
	    });
	}


	// Update the options in the role select
	function updateRoles() {

	    var role_select = $('#role_id');

	    role_select.select2("destroy");
	    
	    role_select.empty();
	    role_select.append('<option value="-1">Select a role...</option>');
	    
	    for (var role = 0; role < roles.length; role++) {
	        role_select.append("<option value='" +roles[role].id + "'>" +roles[role].name + "</option>");    
	    } 

	    role_select.select2();
	 
	    role_select.prop("disabled", false);
	 
	    role_select.select2("val", {{ Input::old('role_id', $role_id) }});
	}


	// Re-initialise the role selector based on the project
	$(document).ready(function() {
	    changeProject();
	});

</script>