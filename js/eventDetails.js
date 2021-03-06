var t = $('#transactionTable').DataTable({//call table id
    responsive: true,
    scrollX: true,
    dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Transaction List'
            },
            {
                extend: 'csvHtml5',
                title: 'Transaction List'
            },
        ]
});

var t2 = $('#customFormData').DataTable({//call table id
    dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Custom Form Data'
            },
            {
                extend: 'csvHtml5',
                title: 'Custom Form Data'
            },
        ]
});