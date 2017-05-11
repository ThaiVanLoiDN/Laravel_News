$( document ).ready( function () {
	$( "#addCat" ).validate( {
		rules: {
			name: {
				required: true,
				minlength: 5,
				maxlength: 100,
			},
		},
		messages: {
			name: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 100 kí tự",
			},
		},
	});
});

$( document ).ready( function () {
	$( "#addUser" ).validate( {
		rules: {
			username: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
			fullname: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
			capbac: {
				required: true,
				digits: true,
			},
			email: {
				required: true,
				minlength: 5,
				maxlength: 30,
				email: true,
			},
			reemail: {
				required: true,
				equalTo: "#email",
			},
			password: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
			repassword: {
				required: true,
				equalTo: "#password",
			},
		},
		messages: {
			username: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
			},
			fullname: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
			},
			capbac: {
				required: "Vui lòng nhập vào đây",
				digits: "Vui lòng chọn định dạng số",
			},
			email: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
				email: "Vui lòng nhập đúng định dạng email",
			},
			reemail: {
				required: "Vui lòng nhập vào đây",
				equalTo: "Chưa khớp email",
			},
			password: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
			},
			repassword: {
				required: "Vui lòng nhập vào đây",
				equalTo: "Chưa khớp mật khẩu",
			},
		},
	});
});

$( document ).ready( function () {
	$( "#editUser" ).validate( {
		rules: {
			username: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
			fullname: {
				required: true,
				minlength: 5,
				maxlength: 30,
			},
			capbac: {
				required: true,
				digits: true,
			},
			email: {
				required: true,
				minlength: 5,
				maxlength: 30,
				email: true,
			},
			reemail: {
				required: true,
				equalTo: "#email",
			},
			password: {
				minlength: 5,
				maxlength: 30,
			},
			repassword: {
				equalTo: "#password",
			},
		},
		messages: {
			username: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
			},
			fullname: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
			},
			capbac: {
				required: "Vui lòng nhập vào đây",
				digits: "Vui lòng chọn định dạng số",
			},
			email: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
				email: "Vui lòng nhập đúng định dạng email",
			},
			reemail: {
				required: "Vui lòng nhập vào đây",
				equalTo: "Chưa khớp email",
			},
			password: {
				minlength: "Vui lòng nhập tối thiểu 5 kí tự",
				maxlength: "Vui lòng nhập tối đa 30 kí tự",
			},
			repassword: {
				equalTo: "Chưa khớp mật khẩu",
			},
		},
	});
});

$( document ).ready( function () {
	$( "#addNews" ).validate( {
		ignore: [], 
		debug: false,
		rules: {
			name: {
				required: true,
				minlength: 10,
				maxlength: 100,
			},            
			cat_id: {
				required: true,
				digits: true,
			},
			preview: {
				required: true,
				minlength: 10,
				maxlength: 500,
			},
			detail:{
                required: function(){
                 	CKEDITOR.instances.detail.updateElement();
                },
                minlength:10,
				maxlength: 100000,
            }
		},
		messages: {
			name: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 10 kí tự",
				maxlength: "Vui lòng nhập tối đa 100 kí tự",
			},
			cat_id: {
				required: "Vui lòng nhập vào đây",
				digits: "Vui lòng chọn định dạng số",
			},
			preview: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 10 kí tự",
				maxlength: "Vui lòng nhập tối đa 500 kí tự",
			},
			detail:{
                required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 10 kí tự",
				maxlength: "Vui lòng nhập tối đa 100000 kí tự",
            }
		},
	});
});

$( document ).ready( function () {
	$( "#replyMail" ).validate( {
		ignore: [], 
		debug: false,
		rules: {
			email: {
				required: true,
				minlength: 10,
				maxlength: 100,
			},            
			title: {
				required: true,
				minlength: 10,
				maxlength: 100,
			},
			detail:{
                required: function(){
                 	CKEDITOR.instances.detail.updateElement();
                },
                minlength:10,
				maxlength: 10000,
            }
		},
		messages: {
			email: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 10 kí tự",
				maxlength: "Vui lòng nhập tối đa 100 kí tự",
			},
			title: {
				required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 10 kí tự",
				maxlength: "Vui lòng nhập tối đa 100 kí tự",
			},
			detail:{
                required: "Vui lòng nhập vào đây",
				minlength: "Vui lòng nhập tối thiểu 10 kí tự",
				maxlength: "Vui lòng nhập tối đa 10000 kí tự",
            }
		},
	});
});