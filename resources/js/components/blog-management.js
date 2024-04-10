$(function() {

    /*  Initialse DataTables, with no sorting on the 'details' column  */
    $('#blog-mgmt-tbl').dataTable({
        order: [[0, 'asc']],
        aoColumnDefs: [
          {
            aTargets: [ 4 ],
            bSortable: false
          },
          {
            aTargets: [ 5 ],
            bSortable: false
          }
        ],
        dom: "<'row'<'col-xs-12 col-sm-6 col-md-3 m-b-10'l>" +
          "<'col-xs-10 col-sm-6 col-md-5 m-b-10'f><'col-xs-12 col-sm-12 col-md-4 m-b-10'B>r>t" +
          "<'row'<'col-xs-12 col-sm-12 col-md-6'i><'col-xs-12 col-sm-12 col-md-6'p>>",
        buttons: [
          {
            extend: 'csvHtml5',
            text: 'Download CSV',
            title: $(this).data('table-name') || "aaa_blogs-" + moment(new Date()).format('YYYYMMDD'),
            className: 'btn btn-white',
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4],
              modifier: {
                search: 'none',
              },
              format: {
                body: function ( data, row, column, node ) {
                  // Use full value from title if data contains an ellipsis
                  return node && $(node).children('span.ellipsis').length ?
                    $(node).children('span.ellipsis').first().attr('title') || data :
                    data;
                }
              },
              orthogonal: 'fullBlogList'
            }
          }
        ],
        initComplete: function () {

            this.api().columns('.select-filter').every( function () {
                var column = this;
                var select = $('<select style="width:90%;" data-placeholder="All"><option value="0">All</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        if ( val == '0' ){  // Check for show all option
                            column.search('').draw();

                        } else {
                            column.search(val).draw();
                        }
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );

        }
    });

    $('.dataTables_filter input').attr("placeholder", "Blog...");

});
