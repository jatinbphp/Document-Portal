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
            // userID: {
            //     required: true,
            // },
            categoryID: {
                required: true,
            },
            docFile: {
                required: true,
            },
            expireDate: {
                required: true,
            },
        },
        messages: {
            docName: {
                required: "Please enter Document Name",
            },
            // userID: {
            //     required: "Please select User Name",
            // },
            categoryID: {
                required: "Please select Category",
            },
            docFile: {
                required: "Please select Document file",
            },
            expireDate: {
                required: "Please select Expire Date",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#documentFormEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            docName: {
                required: true,
            },
            // userID: {
            //     required: true,
            // },
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
            // userID: {
            //     required: "Please select User Name",
            // },
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
    $('#workflowFormAddEdit').validate({
        // errorClass : 'text-danger',
        rules: {
            document_name: {
                required: true,
            },
            usertype_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            subcategory_id: {
                required: true,
            },
            document_files: {
                required: true,
            },
            comments: {
                required: true,
            },
        },
        messages: {
            document_name: {
                required: "Please enter Document Name",
            },
            usertype_id: {
                required: "Please select User Type",
            },
            category_id: {
                required: "Please select Category",
            },
            subcategory_id: {
                required: "Please select Sub Category",
            },
            document_files: {
                required: "Please select Document file",
            },
            comments: {
                required: "Please add your comments",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
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
                    url: baseurl + "/edit_profile/checkEditEmailExists",
                    type: "post",
                    data: {
                        old_email: function() {
                            return $('input#old_email').val();
                        }
                    }
                }
            },
            conpassword: {
                equalTo: "#pwd"
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
            conpassword: {
                equalTo: "Password not Match"
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
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
    // Edit user profile
    $('#userprofileFormAdd').validate({
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
                    url: baseurl + "/edit_profile/checkEditEmailExistsProfile",
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
            receive_email: {
                required: true,
                email: true
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
            receive_email: {
                required: "Please enter Email address for Email Receive",
                email: "Please enter Valid Email Address"
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});