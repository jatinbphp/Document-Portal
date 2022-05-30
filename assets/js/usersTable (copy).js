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
                window.location.href = baseurl + '/documents/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
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
                //data:{'test':'test'}
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
    /*
        //Reporting Category Table
        $('#repCatTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "reporting/category/fetch_reporting_data",
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
        
        */
    //company filter in documentlist
    $('#companySearch').change(function(e) {
        $companyId = $('#companySearch').val();
        if ($companyId == '') {
            $("#documentsTable").css("display", "block");
            $("#companySearchTable").css("display", "none");
        } else {
            $("#companySearchTable").css("display", "block");
            $("#documentsTable").css("display", "none");
        }
        $("#companySearchTable").dataTable().fnDestroy();
        filterCompanyData();
    });
    $('#userSearch').change(function(e) {
        $("#companySearchTable").dataTable().fnDestroy();
        filterUserData();
    });
    //filterCompanyData();
    function filterCompanyData() {
        //reporting table
        $('#companySearchTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "documents/fetch_company_data",
                type: "POST",
                data: {
                    'comapny_id': $('#companySearch').val()
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
        $('#companySearchTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "documents/fetch_company_data",
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
});