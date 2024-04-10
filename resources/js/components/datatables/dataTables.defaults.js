$.extend( true, $.fn.dataTable.defaults, {
    responsive: {
        details: {
            renderer: function ( api, rowIdx, columns ) {
                console.log("API: ", api);
                console.log("rowIdx: ", rowIdx);
                var data = $.map( columns, function ( col, i ) {
                    return col.hidden && col.title ?
                        '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                        '<td>'+col.title+':'+'</td> '+
                        '<td>'+col.data+'</td>'+
                        '</tr>' :
                        '';
                } ).join('');

                if(!data) {
                    console.log("Row: ", api.rows(rowIdx).nodes().to$());
                    api.rows(rowIdx).nodes().to$().removeClass('parent').addClass('empty-column');
                }
                return data && data.length ?
                    $('<table class="width-100p"/>').append( data ) :
                    false;
            }
        }
    },
    "aLengthMenu": [
        [10, 15, 20, -1],
        [10, 15, 20, "All"] // change per page values here
    ],
    bLengthChange: true,
    dom: "<'row'<'col-xs-12 col-sm-6 col-md-3 m-b-10'l>" +
        "<'col-xs-10 col-sm-6 col-md-5 m-b-10'f><'col-xs-12 col-sm-12 col-md-4 m-b-10'B>r>t" +
        "<'row'<'col-xs-12 col-sm-12 col-md-6'i><'col-xs-12 col-sm-12 col-md-6'p>>",
} );