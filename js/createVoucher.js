var vouchertable = $('#vouchertable').DataTable( {

   retrieve: true,
   responsive: true,
   scrollCollapse: true,
   ordering: true,
   searching: true,
   paging: true,
 
   columnDefs: [ {
     targets:   0,
     className: 'select-checkbox',
   },
   {
      targets: -1,
      data: null,
      defaultContent:'<button class="btn btn-light btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-trash"></i></button>'
    }],
 
   lengthMenu:[
   [6,-1],
   [6,"All"]
 ],
 
 select: {
     style:    'multi', //'multi' - select multiple checkbox
     selector: 'td:first-child'
 },
 
 order: [[ 1, 'asc' ]]
 
 } );

 //-----------------------Delete Row-----------------------------//
$('#vouchertable tbody').on( 'click', 'button', function () {

   var row = vouchertable.row($(this).parents('tr'));
   row.remove().draw(false);
  })