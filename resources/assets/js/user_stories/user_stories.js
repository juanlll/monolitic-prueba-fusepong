'use strict';

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const arrayUrl = window.location.href.split('/');
const isFromProject = arrayUrl[(arrayUrl.length - 1) - 1] == 'projects';
const projectId = isFromProject ? arrayUrl.pop() : urlParams.get('projectId');
const projectServerUrl = projectId ? recordsURL + '?projectId=' + projectId : recordsURL;

let tableName = '#userStoriesTable';
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
        url: projectServerUrl
    },
    columnDefs: [{
        'targets': [4],
        'orderable': false,
        'className': 'text-center',
        'width': '8%',
    }, ],
    columns: [{
            data: 'id',
            name: 'id'
        }, {
            data: 'name',
            name: 'name'
        },
        {
            data: (row) => {
                return row.project.name ? row.project.name : row.project_id;
            },
            name: 'project_id',
        },
        {
            data: 'acceptance_criteria',
            name: 'acceptance_criteria'
        },
        {
            data: function(row) {
                let url = recordsURL + row.id;
                let data = [{
                    'id': row.id,
                    'url': projectId ? url + '/edit?projectId=' + projectId : url + '/edit',
                    'urlShow': url
                }];

                return prepareTemplateRender('#userStoriesTemplate',
                    data);
            },
            name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function(event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'User Story');
});