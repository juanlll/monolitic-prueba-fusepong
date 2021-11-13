'use strict';

let tableName = '#companiesTable';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [
        [0, 'asc']
    ],
    ajax: {
        url: recordsURL,
    },
    columnDefs: [{
        'targets': [3],
        'orderable': false,
        'className': 'text-center',
        'width': '8%',
    }, ],
    columns: [{
            data: 'name',
            name: 'name'
        }, {
            data: 'nit',
            name: 'nit'
        }, {
            data: 'phone',
            name: 'phone'
        },
        {
            data: function(row) {
                let url = recordsURL + row.id;
                let data = [{
                    'id': row.id,
                    'url': url + '/edit',
                    'urlProjects': '/projects?companyId=' + row.id,
                    'urlAddProject': '/projects/create?companyId=' + row.id,
                    'urlShow': url
                }];

                return prepareTemplateRender('#companiesTemplate', data);
            },
            name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function(event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'Company');
});