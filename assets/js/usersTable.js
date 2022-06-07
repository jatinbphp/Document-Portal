$(document).ready(function() {
    $('#usersTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "users/fetch_users",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    // User delete Event    
    $(document).on('click', '.deleteUsers', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete User",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/users/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    // user Types Table    
    $('#user_typesTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "user_types/fetch_user_types",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, ]
    });
    // User Types delete Event    
    $(document).on('click', '.deleteUsertypes', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete User Types",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/user_types/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    // user Types Table    
    $('#companyTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "company/fetch_company",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, ]
    });
    // User Types delete Event    
    $(document).on('click', '.deleteCompany', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete Company",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/company/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    //documents
    $('#documentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "documents/fetch_documents",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    // User delete Event    
    $(document).on('click', '.manageDocDelete', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete Document",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/documents/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    // report documents table
    $('#uploadedDocuments').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "UploadedDocuments/fetch_uploaded_documents",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    //category Table
    $('#categoryTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "category/fetch_category",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, ]
    });
    // Category delete Event    
    $(document).on('click', '.deleteCategory', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete Category",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/category/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    // SubCategory Table    
    $('#subCategoryTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "subCategory/fetch_category",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "40",
            "targets": 0
        }, {
            "width": "40",
            "targets": 1
        }, {
            "width": "20%",
            "targets": 2
        }, ]
    });
    // SubCategory delete Event    
    $(document).on('click', '.deleteSubCategory', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete SubCategory",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/subcategory/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    // User delete Event    
    $(document).on('click', '.deleteUsers', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete User",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/users/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    //reporting table
    $('#categoryFilter').change(function(e) {
        $("#reportingTable").dataTable().fnDestroy();
        filterData();
    });
    filterData();

    function filterData() {
        //reporting table
        $('#reportingTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "reporting/fetch_users_data",
                type: "POST",
                data: {
                    'comapny_id': $('#categoryFilter').val()
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": -1
            }, {
                "orderable": false,
                "targets": 0
            }, {
                "orderable": false,
                "targets": 5
            }, {
                "width": "10%",
                "targets": 0
            }, {
                "width": "15%",
                "targets": 1
            }, {
                "width": "10%",
                "targets": 2
            }]
        });
    }
    //company filter in documentlist
    $('#companySearch').change(function(e) {
        $companyId = $('#companySearch').val();
        $("#documentsTable, #uploadedDocuments").dataTable().fnDestroy();
        filterCompanyData();
    });
    $('#userSearch').change(function(e) {
        $("#documentsTable, #uploadedDocuments").dataTable().fnDestroy();
        filterUserData();
    });
    //filterCompanyData();
    function filterCompanyData() {
        //reporting table
        $('#documentsTable, #uploadedDocuments').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "documents/fetch_documents",
                type: "POST",
                data: {
                    'company_id': $('#companySearch').val()
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": -1
            }, {
                "orderable": false,
                "targets": 0
            }, {
                "orderable": false,
                "targets": 5
            }, {
                "width": "10%",
                "targets": 0
            }, {
                "width": "15%",
                "targets": 1
            }, {
                "width": "10%",
                "targets": 2
            }]
        });
    }

    function filterUserData() {
        //reporting table
        $('#documentsTable, #uploadedDocuments').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "documents/fetch_documents",
                type: "POST",
                data: {
                    'user_id': $('#userSearch').val()
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": -1
            }, {
                "orderable": false,
                "targets": 0
            }, {
                "orderable": false,
                "targets": 5
            }, {
                "width": "10%",
                "targets": 0
            }, {
                "width": "15%",
                "targets": 1
            }, {
                "width": "10%",
                "targets": 2
            }]
        });
    }
    // report documents table
    $('#editedDocuments').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "DocumentEdi/fetch_edited_documents",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    // User delete Event    
    $(document).on('click', '.deleteDocuments', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete Document",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/docs/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    //document edit log table
    $('#editedDocument').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "DocumentEdit/fetch_edited_documents",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 3
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    //workflow table
    $('#workflowTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "workflow/fetch_workflow",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    $(document).on('click', '.workflowDelete', function(event) {
        event.preventDefault();
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Delete workflow",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = baseurl + '/workflow/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
    
     //Outstanding Documents
    $('#outstandingDocumentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "OutstandingDocuments/fetch_outstanding_documents",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "orderable": false,
            "targets": 0
        }, {
            "orderable": false,
            "targets": 6
        }, {
            "width": "10%",
            "targets": 0
        }, {
            "width": "15%",
            "targets": 1
        }, {
            "width": "10%",
            "targets": 2
        }, {
            "width": "10%",
            "targets": 3
        }, ]
    });
    
    
     //company filter in documentlist
    $('#companySearch').change(function(e) {
        //$companyId = $('#companySearch').val();
        $("#outstandingDocumentsTable").dataTable().fnDestroy();
        filter();
    });
    
   
    //filterCompanyData();
    function filter() {
        //reporting table
         //Outstanding Documents
		$('#outstandingDocumentsTable').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				url: "OutstandingDocuments/fetch_outstanding_documents",
				type: "POST",
				data: {
                    'company_id': $('#companySearch').val()
                    //'company_id': 'company_id'
                }
			},
			"columnDefs": [{
				"orderable": false,
				"targets": -1
			}, {
				"orderable": false,
				"targets": 0
			}, {
				"orderable": false,
				"targets": 6
			}, {
				"width": "10%",
				"targets": 0
			}, {
				"width": "15%",
				"targets": 1
			}, {
				"width": "10%",
				"targets": 2
			}, {
				"width": "10%",
				"targets": 3
			}, ]
		});
    }
    
    
});
