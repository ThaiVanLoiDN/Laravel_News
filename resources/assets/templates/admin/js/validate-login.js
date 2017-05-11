$( document ).ready( function () {
	$( "#form-login" ).validate( {
		rules: {
			username: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
			password: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
		},
		messages: {
			username: {
				required: "",
				minlength: "",
				maxlength: "",
			},
			password: {
				required: "",
				minlength: "",
				maxlength: "",
			},
		},
	});
});

