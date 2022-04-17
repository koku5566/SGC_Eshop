var t = $('#participantTable').DataTable({//call table id
    dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Participant List'
            },
            {
                extend: 'pdfHtml5',
                title: 'Participant List'
            },
            {
                extend: 'csvHtml5',
                title: 'Participant List'
            },
        ]
});