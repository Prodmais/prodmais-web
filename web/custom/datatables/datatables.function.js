
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
    "lengthMenu": [20, 50, 100, 150, 200, 250, 500],
    'language': {
      'search': '<div class=\'has-feedback\'>_INPUT_<span class=\'glypxhicon glyxphicon-search form-control-feedback\'><i class=\'fa fa-search\' aria-hidden=\'true\'></i></span></div>',
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
      $('.dataTables_paginate > .pagination').addClass('pagination-sm');
    }
  });

}