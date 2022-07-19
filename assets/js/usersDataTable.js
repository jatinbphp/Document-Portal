$(document).ready(function() {
    //documents
    $('#documentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "userDocuments/fetch_documents",
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
                window.location.href = baseurl + '/userDocuments/delete/' + id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    });
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
                url: "userDocuments/fetch_company_data",
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
                url: "userDocuments/fetch_company_data",
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
    $('#subadminworkflowTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "SubadminWorkflow/fetch_company_data",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, ]
    });
    $('#subdocumentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "subdocuments/fetch_subdocuments",
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
    // $('#companySearch').change(function(e) {
    //     // $companyId = $('#companySearch').val();
    //     $("#subdocumentsTable").dataTable().fnDestroy();
    //     filterCompanyfilterData();
    // });
    // $('#userSearch').change(function(e) {
    //     $("#subdocumentsTable").dataTable().fnDestroy();
    //     filterUserfilterData();
    // });
    // //filterCompanyData();
    // function filterCompanyfilterData() {
    //     //reporting table
    //     $('#subdocumentsTable').DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "responsive": true,
    //         "order": [],
    //         "ajax": {
    //             url: "subdocuments/fetch_subdocuments",
    //             type: "POST",
    //             data: {
    //                 'company_id': $('#companySearch').val()
    //             }
    //         },
    //         "columnDefs": [{
    //             "orderable": false,
    //             "targets": -1
    //         }, {
    //             "orderable": false,
    //             "targets": 0
    //         }, {
    //             "orderable": false,
    //             "targets": 5
    //         }, {
    //             "width": "10%",
    //             "targets": 0
    //         }, {
    //             "width": "15%",
    //             "targets": 1
    //         }, {
    //             "width": "10%",
    //             "targets": 2
    //         }]
    //     });
    // }
    // function filterUserfilterData() {
    //     $('#subdocumentsTable').DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "responsive": true,
    //         "order": [],
    //         "ajax": {
    //             url: "subdocuments/fetch_subdocuments",
    //             type: "POST",
    //             data: {
    //                 'user_id': $('#userSearch').val()
    //             }
    //         },
    //         "columnDefs": [{
    //             "orderable": false,
    //             "targets": -1
    //         }, {
    //             "orderable": false,
    //             "targets": 0
    //         }, {
    //             "orderable": false,
    //             "targets": 5
    //         }, {
    //             "width": "10%",
    //             "targets": 0
    //         }, {
    //             "width": "15%",
    //             "targets": 1
    //         }, {
    //             "width": "10%",
    //             "targets": 2
    //         }]
    //     });
    // }
    $('#UserdocumentsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "userdocs/fetch_documents",
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
    $('#companySearchuser').change(function(e) {
        // $companyId = $('#companySearch').val();
        $("#UserdocumentsTable").dataTable().fnDestroy();
        filterCompanyfilterData1();
    });
    $('#userSearchuser').change(function(e) {
        $("#UserdocumentsTable").dataTable().fnDestroy();
        filterUserfilterData1();
    });
    //filterCompanyData();
    function filterCompanyfilterData1() {
        //reporting table
        $('#UserdocumentsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                url: "userdocs/fetch_documents",
                type: "POST",
                data: {
                    'company_id': $('#companySearchuser').val()
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
    $('#ceoAwatingTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "awaitingapprove/fetch_ceo_company_data",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, ]
    });
    $('#technicianCompanyTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "MedicalAndTrainingDocs/fetch_company_data",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, ]
    });
    $('#ceoComplianceReportTable').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [],
        "ajax": {
            url: "ceocompliancereport/fetch_ceo_compliance_report",
            type: "POST",
        },
        "columnDefs": [{
            "orderable": false,
            "targets": -1
        }, {
            "width": "85%",
            "targets": 0
        }, ]
    });
});