$(document).ready(function(){

		$('#registration-form').validate({
		    rules: {
		        name: {
		            minlength: 3,
		            required: true,
		            required: true
		        },


		        lname: {
		            minlength: 3,
		            required: true,
		            required: true
		        },


		        username: {
		            minlength: 6,
		            required: true
		        },
		  
		  password: {
				required: true,
				minlength: 6
		  },

		  confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
		  
	      email: {
	        required: true,
	        email: true
	      },
		  
	     
		   address: {
	      	minlength: 10,
	        required: true
	      },
		  
		  agree: "required"
		  
	    },
			highlight: function(element) {
			    $(element).closest('.form-control').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.closest('.form-control').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready