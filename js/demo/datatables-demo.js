$(document).ready(function() {
   var dt = $('#dataTable').DataTable( {
        dom: 'Bfrtip',
         lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
        ], 
        
    } );
    
    
      var dt1 =  $('#dataTableNew').DataTable( {
        dom: 'Bfrtip',
         lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
        ], 
        
    } );

    
} );



