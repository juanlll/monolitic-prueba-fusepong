'use strict';
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const arrayUrl = window.location.href.split('/');
const isFromUserStory = arrayUrl[(arrayUrl.length - 1) - 1] == 'userStories';
const userStoryId = isFromUserStory ? arrayUrl.pop() : urlParams.get('userStoryId');
const projectServerUrl = userStoryId ? recordsURL + '?userStoryId=' + userStoryId : recordsURL;

let tableName = '#ticketsTable';

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
        url: projectServerUrl,
    },
    columnDefs: [{
        'targets': [3],
        'orderable': false,
        'className': 'text-center',
        'width': '8%',
    }, ],
    columns: [{
            data: 'comments',
            name: 'comments'
        }, {
            data: 'status',
            name: 'status'
        }, {
            data: 'user_story_id',
            name: 'user_story_id'
        },
        {
            data: function(row) {
                let url = recordsURL + row.id;
                let data = [{
                    'id': row.id,
                    'url': userStoryId ? url + '/edit?userStoryId=' + userStoryId : url + '/edit',
                    'urlShow': url
                }];

                return prepareTemplateRender('#ticketsTemplate',
                    data);
            },
            name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function(event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'Ticket');
});