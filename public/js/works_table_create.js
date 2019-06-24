$('#worksTable').DataTable(
    {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "paging": false,
        dom: 'l<"toolbar">frtip',
        initComplete: function () {
            $("div.toolbar")
                .html('&nbsp<a id="hrefCreate" onclick="showModalWork();" class=" btn btn-secundary btn-sm" style="color:white; background-color:#96183a !important; border-radius: 4px;margin-bottom: 10px;">&nbsp<span class="glyphicon glyphicon-plus"></span> </a>');
        },
        stateSave: true,
        "ordering": false,
        columnDefs: [
            { className: "text-center", targets: "_all" },

            {
        		'targets': 0,
        		'createdCell':  function (td, cellData, rowData, row, col) {
                       $(td).attr('id', 'date' + row); 
        		}
             },
             {
        		'targets': 1,
        		'createdCell':  function (td, cellData, rowData, row, col) {
           			$(td).attr('id', 'priority' + row); 
        		}
             },
             {
        		'targets': 2,
        		'createdCell':  function (td, cellData, rowData, row, col) {
           			$(td).attr('id', 'product' + row); 
        		}
     		},
        ],
    });