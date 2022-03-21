var TicketListTable = $('#ticketTypeList_tbl').DataTable({//call table id

    dom: 'Bfrtip',
    order: [ 1, 'asc' ],
    pagingType: "full_numbers",
    retrieve: true,
    lengthMenu:[
       [6,-1],
       [6,"All"]
    ],
 
    columnDefs: [{
       className: 'dt-control', //innertable icon
       orderable: false,
       targets: 0,
       data: null,
       defaultContent: ''
    },
 
    {
       targets: -1,
       data: null,
       defaultContent: '<button class="btn btn-light btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" id="edit"><i class="fa fa-edit"></i></button>'
    }],
 
    responsive: true,
    language:{
       search: "_INPUT_",
       searchPlaceholder:"Search",
    },
 });