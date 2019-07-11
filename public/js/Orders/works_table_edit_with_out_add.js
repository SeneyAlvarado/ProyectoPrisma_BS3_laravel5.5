$('#worksTable').DataTable(
    {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        
        responsive: true,
        stateSave: true,
        paging: false,
        "ordering": false,
        "columns": [
            { "width": "9%" },
            { "width": "12%" },
            { "width": "12%" },
            { "width": "20%" },
            { "width": "35%" },
            { "width": "12%" },
        ],
        columnDefs: [
            { className: "text-center", targets: "_all" },

            {
                'targets': 1,
                'createdCell': function (td, cellData, rowData, row, col) {
                    $(td).attr('id', 'date' + row);
                }
            },
            {
                'targets': 2,
                'createdCell': function (td, cellData, rowData, row, col) {
                    $(td).attr('id', 'priority' + row);
                }
            },
            {
                'targets': 3,
                'createdCell': function (td, cellData, rowData, row, col) {
                    $(td).attr('id', 'product' + row);
                }
            },
        ],
    });