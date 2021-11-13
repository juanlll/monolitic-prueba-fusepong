'use strict';
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const arrayUrl = window.location.href.split('/');
const isFromCompany = arrayUrl[(arrayUrl.length - 1) - 1] == 'companies';
const companyId = isFromCompany ? arrayUrl.pop() : urlParams.get('companyId');
const companyServerUrl = companyId ? recordsURL + '?companyId=' + companyId : recordsURL;

let tableName = '#projectsTable';
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
        url: companyServerUrl
    },
    columnDefs: [{
        'targets': [2],
        'orderable': false,
        'className': 'text-center',
        'width': '8%',
    }, ],
    columns: [{
            data: 'name',
            name: 'name'
        }, {
            data: function(row) {
                return row.company.name ? row.company.name : row.company_id;
            },
            name: 'company_id',
        },
        {
            data: function(row) {
                let url = recordsURL + row.id;
                let data = [{
                    'id': row.id,
                    'url': companyId ? url + '/edit?companyId=' + companyId : url + '/edit',
                    'urlShow': url
                }];
                return prepareTemplateRender('#projectsTemplate', data);
            },
            name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function(event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'Project');
});