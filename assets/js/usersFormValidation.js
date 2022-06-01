$(document).ready(function() {
    $("#userFormAdd").validate({
        rules: {
            firstName: {
                required: true,
            },
            lastName: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: baseurl + "/users/checkEmailExists",
                    type: "post",
                }
            },
            pwd: {
                required: true,
            },
            conpassword: {
                required: true,
                equalTo: "#pwd"
            },
            userTypeID: {
                required: true,
            },
        },
        messages: {
            firstName: {
                required: "Please enter First Name",
            },
            lastName: {
                required: "Please enter Last Name",
            },
            email: {
                required: "Please enter Email Address",
                email: "Please enter Valid Email Address",
                remote: "This email address already exist"
            },
            pwd: {
                required: "Please enter Password",
            },
            conpassword: {
                required: "Please enter Confirm Password",
                equalTo: "Password not Match"
            },
            userTypeID: {
                required: "Please select User Type",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    // Edit user form
    $('#userFormEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            firstName: {
                required: true,
            },
            lastName: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: baseurl + "/users/checkEditEmailExists",
                    type: "post",
                    data: {
                        old_email: function() {
                            return $('input#old_email').val();
                        }
                    }
                }
            },
            pwd: {
                required: false,
            },
            conpassword: {
                required: false,
                equalTo: "#pwd"
            },
            userTypeID: {
                required: true,
            },
        },
        messages: {
            firstName: {
                required: "Please enter First Name",
            },
            lastName: {
                required: "Please enter Last Name",
            },
            email: {
                required: "Please enter Email Address",
                email: "Please enter Valid Email Address",
                remote: "This email address already exist"
            },
            pwd: {
                required: "Please enter Password",
            },
            conpassword: {
                required: "Please enter Confirm Password",
                equalTo: "Password not Match"
            },
            userTypeID: {
                required: "Please select User Type",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    //Add & Edit User Type form
    $('#user_typesFormAddEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            userTypeName: {
                required: true,
            },
        },
        messages: {
            userTypeName: {
                required: "Please enter User Type Name",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#companyFormAddEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            companyName: {
                required: true,
            },
        },
        messages: {
            companyName: {
                required: "Please enter Company Name",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#documentFormAddEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            docName: {
                required: true,
            },
            userID: {
                required: true,
            },
            categoryID: {
                required: true,
            },
            // docFile: {
            //     required: true,
            // },
            expireDate: {
                required: true,
            },
        },
        messages: {
            docName: {
                required: "Please enter Document Name",
            },
            userID: {
                required: "Please select User Name",
            },
            categoryID: {
                required: "Please select Category",
            },
            // docFile: {
            //     required: "Please select Document file",
            // },
            expireDate: {
                required: "Please select Expire Date",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#categoryFormAddEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            categoryName: {
                required: true,
            },
        },
        messages: {
            categoryName: {
                required: "Please enter Category Name",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#subcatFormAddEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            categoryName: {
                required: true,
            },
            SubCatName: {
                required: true,
            },
        },
        messages: {
            categoryName: {
                required: "Please select Category Name",
            },
            SubCatName: {
                required: "Please select Sub Category Name",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});