/**
 * Created by manytostao on 28/05/15.
 */
'use strict';

/*
 * show.bs.modal
 * shown.bs.modal
 * hide.bs.modal
 * hidden.bs.modal
 *
 * */
var tracesDatatables = function () {
    var _initUsersListDatatable = function () {
        var table = $('#usersListDatatable');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var oTable = table.DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "ajax": {
                "url": laroute.route('users.datatable'),
                "type": "POST",
                "data": {_token: CSRF_TOKEN}
            },
            "drawCallback": function (settings) {
                var counter = 0;
                table.find('tbody tr').each(function (counter) {
                    var aData = oTable.row(this).data();
                    if (aData !== null) {
                        var nCloneTd = '';
                        var dropdownClass = 'dropdown-menu pull-right';
                        if (counter > oTable.rows().count() - 3 && counter < oTable.rows().count())
                            dropdownClass = 'dropdown-menu pull-right bottom-up';
                        if (oTable.rows().count() > 2) {
                            nCloneTd = '' +
                                '<div class=col-md-12>' +
                                '<div class="btn-group">' +
                                '<button class="btn dropdown-toggle" data-toggle="dropdown">Acciones <i class="fa fa-angle-down"></i>' +
                                '</button>' +
                                '<ul class="' + dropdownClass + '">' +
                                '<li>' +
                                '<a href="' + laroute.route('users.show', {users: aData[0]}) + '">' +
                                '<i class="fa fa-search"></i>Perfil </a>' +
                                '</li>' +
                                '<li>' +
                                '<a href="' + laroute.route('users.edit', {users: aData[0]}) + '">' +
                                '<i class="fa fa-edit"></i>Editar </a>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>';
                            //aData[5] = '<i class="fa fa-check fa-success"></i>';
                        } else {
                            dropdownClass = 'dropdown-menu bottom-left';
                            nCloneTd = '' +
                                '<div class=col-md-12>' +
                                '<div class="btn-group pull-right">' +
                                '<button class="btn dropdown-toggle" data-toggle="dropdown">Acciones <i class="fa fa-angle-down"></i>' +
                                '</button>' +
                                '<ul class="' + dropdownClass + '">' +
                                '<li>' +
                                '<a href="' + laroute.route('users.show', {users: aData[0]}) + '">' +
                                '<i class="fa fa-search"></i>Perfil </a>' +
                                '</li>' +
                                '<li>' +
                                '<a href="' + laroute.route('users.edit', {users: aData[0]}) + '">' +
                                '<i class="fa fa-edit"></i>Editar </a>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>';
                            // aData[5] = '<i class="fa fa-check fa-success"></i>';

                        }
                        aData[6] = nCloneTd;
                        oTable.row(this).data(aData);
                    }
                    counter++;
                });
            },
            "columnDefs": [{
                "visible": false,
                "targets": [0]
            }, {
                "class": "column-center",
                "targets": [5, 7]
            }, {
                "searchable": false,
                "targets": [6]
            }, {
                "orderable": false,
                "targets": [4, 6]
            }
            ],
            "order": [
                [2, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "Todos"] // change per page values here
            ],
            "language": {
                "lengthMenu": " _MENU_ registros",
                "sSearch": "Buscar",
                "sZeroRecords": "No se encontraron registros",
                "sEmptyTable": "No hay registros disponibles: cambie los criterios de filtrado",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "oPaginate": {
                    sFirst: "<i class='fa fa-backward' title='Primero'></i>",
                    sLast: "<i class='fa fa-forward' title='Último'></i>",
                    sNext: "<i class='fa fa-caret-right' title='Siguiente'></i>",
                    sPrevious: "<i class='fa fa-caret-left' title='Anterior'></i>"
                },
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            // "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            "tableTools": {
                "sSwfPath": "",
                "aButtons": []
            },
            "pagingType": "full_numbers"
        });

        /* modify datatable control inputs */

        var tableWrapper = $('#usersListDatatable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        tableWrapper.find('.dataTables_length select').select2({showSearchInput: true}); // initialize select2 dropdown

        var tableColumnToggler = $('#usersListDatatable_column_toggler');
        tableColumnToggler.css("min-height", "160px");

        /* handle show/hide columns*/
        $('input[type="checkbox"]', tableColumnToggler).change(function () {
            var iCol = parseInt($(this).attr("data-column"));
            oTable.column(iCol).visible($(this).attr("checked") === "checked");
        });
    };

    var _initDatatableColumnVisibility = function () {
        var oTable = $('#usersListDatatable').DataTable();
        var tableColumnToggler = $('#usersListDatatable_column_toggler');

        tableColumnToggler.find('input[type="checkbox"]').each(function () {
            var iCol = parseInt($(this).attr("data-column"));
            oTable.column(iCol).visible($(this).attr("checked") === "checked");
        })
    };

    var _initTracesListDatatable = function (id) {
        var table = $('#tracesListDatatable');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var oTable = table.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": laroute.route('traces.datatable'),
                "type": "POST",
                "data": {_token: CSRF_TOKEN}
            },
            "columnDefs": [{
                "visible": false,
                "targets": [0, 5]
            }, {
                "orderable": false,
                "targets": [6]
            }
            ],
            "order": [
                [0, 'desc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "Todos"] // change per page values here
            ],
            "language": {
                "lengthMenu": " _MENU_ registros",
                "sSearch": "Buscar",
                "sZeroRecords": "No se encontraron registros",
                "sEmptyTable": "No hay registros disponibles: cambie los criterios de filtrado",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered": "",
                "oPaginate": {
                    sFirst: "<i class='fa fa-backward' title='Primero'></i>",
                    sLast: "<i class='fa fa-forward' title='Último'></i>",
                    sNext: "<i class='fa fa-caret-right' title='Siguiente'></i>",
                    sPrevious: "<i class='fa fa-caret-left' title='Anterior'></i>"
                },
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "pagingType": "full_numbers",
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            "tableTools": {
                "sSwfPath": "",
                "aButtons": []
            }
        });

        var tableWrapper = $('#tracesListDatatable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    };

    return {
        initTracesListDatatable: function (id) {
            _initTracesListDatatable(id)
        }
    }
}();