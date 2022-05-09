
function initializeDataTable(id_datatables) {

  $('#'+id_datatables).DataTable( {
    // "pagingType": "full_numbers",
    'dom':  '<\'pane_header_datatable well well-sm\'<\'dataFloatButtonCreate\'>fl><t>ip',
    // 'order': [[0, 'asc']], //ordenacao das colunas
    'columnDefs': [
      // {
      //   'targets': [1, 2],
      //   // 'className': 'text-right', //estilizando colunas
      // },
      {
        'targets': [-1],
        'orderable': false, //removendo ordenacao
      },
    ],
    // "lengthMenu": [99],
    'language': {
      'search': false,
      'searchPlaceholder': 'Pesquisar',
      'info'         : 'Mostrando _START_ a _END_ de um total de _TOTAL_ itens',
      'infoEmpty'    : 'Nenhum resultado encontrado',
      'infoFiltered' : '(de _MAX_ itens cadastrados)',
      'lengthMenu'   : 'Mostrar _MENU_ itens',
      'zeroRecords'  : 'Nenhum item encontrado',
      'paginate': {
        'first'    : 'Primeiro',
        'last'     : 'Último',
        'next'     : 'Seguinte',
        'previous' : 'Anterior'
      },
    },
    // pagination size
    'drawCallback': function () {
      // $('.dataTables_paginate > .pagination').addClass('pagination-sm');
    }
  });

}