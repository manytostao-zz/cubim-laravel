/**
 * Created by osmany.torres on 2/12/2016.
 */

var customersDatatables = function () {
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
                "url": laroute.route('customers.datatable'),
                "type": "POST",
                "data": {_token: CSRF_TOKEN}
            },
            "drawCallback": function (settings) {
                var counter = 0;
                table.find('tbody tr').each(function (counter) {
                    var aData = oTable.row(this).data();
                    if (aData != null) {
                        var nCloneTd = '';
                        if (aData[22] == true) {
                            aData[22] = '<i class="fa fa-check fa-success"></i>';
                        } else {
                            aData[22] = '<i class="fa fa-ban fa-danger"></i>';
                        }
                        var dropdownClass = 'dropdown-menu';
                        if (counter > oTable.rows().count() - 3 && counter < oTable.rows().count())
                            dropdownClass = 'dropdown-menu bottom-up';
                        aData[23] = aData[23] == true ? '<i class="fa fa-check fa-success"></i>' : '<i class="fa fa-ban fa-danger"></i>';
                        if (oTable.rows().count() > 2) {
                            nCloneTd = '' +
                                '<div class=col-md-12>' +
                                '<div class="btn-group">' +
                                '<button class="btn dropdown-toggle" data-toggle="dropdown">Acciones <i class="fa fa-angle-down"></i>' +
                                '</button>' +
                                '<ul class="' + dropdownClass + '">' +
                                '<li>' +
                                '<a href="' + laroute.route('customers.show', {customers: aData[0]}) + '">' +
                                '<i class="fa fa-search"></i>Ficha </a>' +
                                '</li>' +
                                '<li>' +
                                '<a href="' + laroute.route('customers.edit', {customers: aData[0]}) + '">' +
                                '<i class="fa fa-edit"></i>Editar </a>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>';
                        } else {
                            dropdownClass = 'dropdown-menu bottom-left';
                            nCloneTd = '' +
                                '<div class=col-md-12>' +
                                '<div class="btn-group pull-right">' +
                                '<button class="btn dropdown-toggle" data-toggle="dropdown">Acciones <i class="fa fa-angle-down"></i>' +
                                '</button>' +
                                '<ul class="' + dropdownClass + '">' +
                                '<li>' +
                                '<a href="' + laroute.route('customers.show', {customers: aData[0]}) + '">' +
                                '<i class="fa fa-search"></i>Ficha </a>' +
                                '</li>' +
                                '<li>' +
                                '<a href="' + laroute.route('customers.edit', {customers: aData[0]}) + '">' +
                                '<i class="fa fa-edit"></i>Editar </a>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>';
                        }
                        aData[26] = nCloneTd;
                        oTable.row(this).data(aData);
                    }
                    counter++;
                });
            },
            "columnDefs": [{
                "visible": false,
                "targets": [0, 3, 4, 5, 6, 7, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]
            }, {
                "class": "column-right",
                "targets": [5]
            }, {
                "class": "column-center",
                "targets": [3, 4, 9, 22, 23, 24, 25, 26]
            }, {
                "searchable": false,
                "targets": [0, 3, 4, 5, 6, 7, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 26]
            }, {
                "orderable": false,
                "targets": [26]
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

        $table = oTable;
        /* modify datatable control inputs */

        var tableWrapper = $('#usersListDatatable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        tableWrapper.find('.dataTables_length select').select2({showSearchInput: true}); // initialize select2 dropdown

        var tableColumnToggler = $('#usersListDatatable_column_toggler');
        tableColumnToggler.css("min-height", "620px");

        /* handle show/hide columns*/
        $('input[type="checkbox"]', tableColumnToggler).change(function () {
            var iCol = parseInt($(this).attr("data-column"));
            oTable.column(iCol).visible($(this).attr("checked") == "checked");
        });
    };

    var _initDatatableColumnVisibility = function () {
        var oTable = $('#usersListDatatable').DataTable();
        var tableColumnToggler = $('#usersListDatatable_column_toggler');

        tableColumnToggler.find('input[type="checkbox"]').each(function () {
            var iCol = parseInt($(this).attr("data-column"));
            oTable.column(iCol).visible($(this).attr("checked") == "checked");
        })
    };

    /*Datatables del historial del usuario*/
    var _initTable1 = function (userId) {
        var table;
        table = $('#sample_1');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet-details",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });

        var oTable = table.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": Routing.generate('entradas_ajax_listado', {'from': 'userDetails', 'id': userId}),
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(0, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td colspan="8">' + group + '</td></tr>'
                        );
                        last = group;
                    }
                });
            },
            "columnDefs": [{
                "visible": false,
                "targets": [0]
            }, {
                "class": "column-right",
                "targets": [4, 5]
            }
            ],
            "order": [
                [4, 'asc']
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
                "oPaginate": {sFirst: "Primero", sLast: "Último", sNext: "Siguiente", sPrevious: "Anterior"},
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            "tableTools": {
                "sSwfPath": "{{ asset('metronic/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}",
                "aButtons": [{
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
                    "sPdfMessage": "Listado de Entradas/Salidas",
                    "mColumns": [1, 2, 3, 4, 5]
                }, {
                    "sExtends": "xls",
                    "sButtonText": "Excel"
                }, {
                    "sExtends": "print",
                    "sButtonText": "Imprimir",
                    "sInfo": 'Presione "CTRL+P" para imprimir o "ESC" para regresar',
                    "sMessage": "Generado por CUBiM"
                }]
            }
        });
        $('#sample_1').on('click', 'tr.group', function () {
            oTable.fnSort([4, 'asc']);
        });
        var tableWrapper = $('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        var tableColumnToggler = $('#sample_1_column_toggler');

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;
    };

    var _initTable2 = function (userId) {
        var table = $('#sample_2');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet-details",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });

        var oTable = table.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": Routing.generate('referencia_ajax_listado', {'from': 'userDetails', 'id': userId}),
            "columnDefs": [{
                "visible": false,
                "targets": [0, 2, 6, 7]
            }, {
                "orderable": false,
                "targets": [6]
            }, {
                "class": "column-right",
                "targets": [8, 9]
            }
            ],
            "order": [
                [8, 'asc']
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
                "oPaginate": {sFirst: "Primero", sLast: "Último", sNext: "Siguiente", sPrevious: "Anterior"},
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            "tableTools": {
                "sSwfPath": "{{ asset('metronic/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}",
                "aButtons": [{
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
                    "sPdfMessage": "Listado de Entradas/Salidas",
                    "mColumns": "visible"
                }, {
                    "sExtends": "xls",
                    "sButtonText": "Excel"
                }, {
                    "sExtends": "print",
                    "sButtonText": "Imprimir",
                    "sInfo": 'Presione "CTRL+P" para imprimir o "ESC" para regresar',
                    "sMessage": "Generado por CUBiM"
                }]
            }
        });
        var tableWrapper = $('#sample_2_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        var tableColumnToggler = $('#sample_2_column_toggler');

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        /* handle show/hide columns*/
        $('input[type="checkbox"]', tableColumnToggler).change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            oTable.fnSetColumnVis(iCol, ($(this).attr("checked") == "checked"));
        });

    };

    var _initTable3 = function (userId) {
        var table;
        table = $('#sample_3');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet-details",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });

        var oTable = table.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": Routing.generate('navegacion_ajax_listado', {'from': 'userDetails', 'id': userId}),
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(0, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td colspan="8">' + group + '</td></tr>'
                        );
                        last = group;
                    }
                });
            },
            "searching": false,
            "columnDefs": [{
                "visible": false,
                "targets": [0]
            }, {
                "class": "column-right",
                "targets": [2, 4, 6, 7]
            }
            ],
            "order": [
                [6, 'asc']
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
                "oPaginate": {sFirst: "Primero", sLast: "Último", sNext: "Siguiente", sPrevious: "Anterior"},
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            "tableTools": {
                "sSwfPath": "{{ asset('metronic/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}",
                "aButtons": [{
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
                    "sPdfMessage": "Listado de Entradas/Salidas",
                    "mColumns": [1, 2, 3, 4, 5, 6, 7]
                }, {
                    "sExtends": "xls",
                    "sButtonText": "Excel"
                }, {
                    "sExtends": "print",
                    "sButtonText": "Imprimir",
                    "sInfo": 'Presione "CTRL+P" para imprimir o "ESC" para regresar',
                    "sMessage": "Generado por CUBiM"
                }]
            }
        });
        $('#sample_3').on('click', 'tr.group', function () {
            oTable.fnSort([7, 'asc']);
        });
        var tableWrapper = $('#sample_3_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        var tableColumnToggler = $('#sample_3_column_toggler');

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;
    };

    var _initTable0 = function (userId) {
        var table = $('#sample_0');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet-refe",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });

        var oTable = table.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": Routing.generate('bibliografia_ajax_listado', {from: 'userDetails', id: userId}),
                "type": "POST"
            },
            "drawCallback": function () {
                var $tr = $('#sample_0').find('tbody tr');
                $tr.each(function () {
                    var nCloneTd = document.createElement('td');
                    nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';

                    this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                })
            },
            "columnDefs": [{
                "visible": false,
                "targets": [0, 1, 3]
            }, {
                "orderable": false,
                "targets": [6, 7]
            }, {
                "class": "column-right",
                "targets": [4, 8]
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
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "oPaginate": {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            "tableTools": {
                "sSwfPath": "{{ asset('metronic/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}",
                "aButtons": [{
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
                    "sPdfMessage": "Listado de Entradas/Salidas",
                    "mColumns": [1, 2, 3, 4, 5, 6, 7]
                }, {
                    "sExtends": "xls",
                    "sButtonText": "Excel"
                }, {
                    "sExtends": "print",
                    "sButtonText": "Imprimir",
                    "sInfo": 'Presione "CTRL+P" para imprimir o "ESC" para regresar',
                    "sMessage": "Generado por CUBiM"
                }]
            }
        });
        var tableWrapper = $('#sample_0_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        var tableColumnToggler = $('#sample_0_column_toggler');

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        /* handle show/hide columns*/
        $('input[type="checkbox"]', tableColumnToggler).change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            oTable.fnSetColumnVis(iCol, ($(this).attr("checked") == "checked"));

            var nCloneTh = document.createElement('th');
            nCloneTh.className = "table-checkbox";

            table.find('thead tr').each(function () {
                this.insertBefore(nCloneTh, this.childNodes[0]);
            });
        });

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement('th');
        nCloneTh.className = "table-checkbox";

        table.find('thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        table.on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nTr);
            var param;
            if (aData == undefined) {
                param = $($(nTr).find("td")[0]).text();
            } else {
                param = aData[0];
            }
            if ($(this).hasClass("row-details-open")) {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                if (aData != undefined && $(nTr).next().hasClass('childTable')) {
                    $(nTr).next().remove();
                }
            } else {
                /* Open this row */
                var childTable = "";
                $(this).addClass("row-details-open").removeClass("row-details-close");

                $.ajax({
                    url: Routing.generate('bibliografia_respuestas', {'id': param}),
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        var childTable = $('<table></table>');
                        childTable.addClass('table table-striped table-bordered table-hover dataTable no-footer respuesta');
                        var childTHead = $('<thead></thead>');
                        var childTRTHead = $('<tr></tr>');
                        childTRTHead.append($('<th><strong>Descriptores</strong></th>'));
                        childTRTHead.append($('<th><strong>Respondido por</strong></th>'));
                        childTRTHead.append($('<th><strong>Fuentes de Informaci&oacute;n</strong></th>'));
                        childTRTHead.append($('<th><strong>Citas Relevantes</strong></th>'));
                        childTRTHead.append($('<th><strong>Citas Pertinentes</strong></th>'));
                        childTRTHead.append($('<th><strong>Fecha Respuesta</strong></th>'));
                        childTRTHead.append($('<th align="center" style="text-align: center"><strong>Operaciones</strong></th>'));
                        childTHead.append(childTRTHead);
                        childTable.append(childTHead);
                        var childTBody = $('<tbody></tbody>');
                        if (data.length > 2) {
                            var formattedData = JSON.parse(data);
                            for (var i = 0; i < formattedData.data.length; i++) {
                                var childTRTBody = $('<tr></tr>');
                                childTRTBody.append($('<td>' + formattedData.data[i].descriptores + '</td>'));
                                childTRTBody.append($('<td>' + formattedData.data[i].respondidoPor + '</td>'));
                                childTRTBody.append($('<td>' + formattedData.data[i].fuentesInfo + '</td>'));
                                childTRTBody.append($('<td>' + formattedData.data[i].citasRelevantes + '</td>'));
                                childTRTBody.append($('<td>' + formattedData.data[i].citasPertinentes + '</td>'));
                                childTRTBody.append($('<td>' + formattedData.data[i].fechaRespuesta + '</td>'));

                                var $column = $('<td align="center"></td>');

                                $column.width(142);
                                var $row = $('<div style="width: 142px"></div>');

                                //Botones

                                var $btnEditar = $('<a title="Editar Respuesta" href="#answer"></a>');
                                var $innerDiv1 = $('<div class="btn blue-hoki btn-small"></div>');
                                $innerDiv1.append($('<i class="fa fa-edit"></i>'));
                                $btnEditar.append($innerDiv1);
                                $btnEditar.attr('data-bibliografia', formattedData.data[i].bibliografia);
                                $btnEditar.attr('data-descriptores', formattedData.data[i].descriptores);
                                $btnEditar.attr('data-fuentesInfo', formattedData.data[i].fuentesInfo);
                                $btnEditar.attr('data-citasRelevantes', formattedData.data[i].citasRelevantes);
                                $btnEditar.attr('data-citasPertinentes', formattedData.data[i].citasPertinentes);
                                $btnEditar.attr('data-citas', formattedData.data[i].citas);
                                $btnEditar.attr('data-observaciones', formattedData.data[i].observaciones);
                                $btnEditar.attr('data-id', formattedData.data[i].id != null ? formattedData.data[i].id : null);

                                var $btnCitas = $('<a title="Ver Citas" href="#citas"></a>');
                                var $innerDiv2 = $('<div class="btn blue-hoki btn-small"></div>');
                                $innerDiv2.append($('<i class="fa fa-list"></i>'));
                                $btnCitas.append($innerDiv2);
                                $btnCitas.attr('data-citas', formattedData.data[i].citas);
                                $btnCitas.attr('data-observaciones', formattedData.data[i].observaciones);
                                $btnCitas.attr('data-id', formattedData.data[i].id != null ? formattedData.data[i].id : null);

                                var $btnModelo = $('<a title="Exportar Modelo" href="' + Routing.generate('bibliografia_exportar_modelo', {id: formattedData.data[i].id}) + '"></a>');
                                var $innerDiv3 = $('<div class="btn blue-hoki btn-small"></div>');
                                $innerDiv3.append($('<i class="fa fa-file-pdf-o"></i>'));
                                $btnModelo.append($innerDiv3);
                                $btnModelo.attr('data-id', formattedData.data[i].id != null ? formattedData.data[i].id : null);

                                $row.append($btnCitas).append($btnModelo);
                                $column.append($row);
                                childTRTBody.append($column);
                                childTBody.append(childTRTBody);

                                $btnCitas.click(function () {
                                    var id = $(this).attr('data-id');
                                    $('#memoCitas').val($(this).attr('data-citas'));
                                    $('#memoObs').val($(this).attr('data-observaciones'));
                                    var numCitas = 0;
                                    var citas = $(this).attr('data-citas').split("\n");
                                    for (var i = 0; i < citas.length; i++)
                                        if (citas[i].trim() != "")
                                            numCitas += 1;
                                    $('#numCitas').text(numCitas);
                                    var $modalView = $('#citas');
                                    $modalView.modal();
                                });

                                //Responder Bibliografía
                                $btnEditar.click(function () {
                                    $('.delete_fuentesInfo').click();
                                    var $collectionHolder = $('ul.fuentesInfo');
                                    $collectionHolder.data('index', 1);
                                    $('#formBiblioRespuesta_bibliografia').val($(this).attr('data-bibliografia'));
                                    $('#formBiblioRespuesta_id').val($(this).attr('data-id'));
                                    $('#formBiblioRespuesta_descriptores').val($(this).attr('data-descriptores'));
                                    $('#formBiblioRespuesta_citasRelevantes').val($(this).attr('data-citasRelevantes'));
                                    $('#formBiblioRespuesta_citasPertinentes').val($(this).attr('data-citasPertinentes'));
                                    $('#formBiblioRespuesta_citas').val($(this).attr('data-citas'));
                                    $('#formBiblioRespuesta_observaciones').val($(this).attr('data-observaciones'));
                                    var fuentes = $(this).attr('data-fuentesInfo').split(',');
                                    var $modalView = $('#answer');
                                    $modalView.modal();
                                    for (var i = 1; i < fuentes.length + 1; i++) {
                                        $('.add_fuentesInfo_link').click();
                                        var id = "formBiblioRespuesta_fuentesInfo_" + i + "_id";
                                        for (var li = 0; li < document.getElementById(id).childNodes.length; li = li + 1) {
                                            var opt = document.getElementById(id).childNodes[li];
                                            if (opt.firstChild != null && opt.firstChild.data == fuentes[i - 1].trim()) {
                                                opt.selected = true;
                                            }
                                        }
                                        $('#' + "formBiblioRespuesta_fuentesInfo_" + i + "_id").select2({
                                            allowClear: true,
                                            class_name: 'form-control'
                                        });
                                    }

                                    $('#cancelButton').click(function () {
                                        $('.delete_fuentesInfo').click();
                                        var $collectionHolder = $('ul.fuentesInfo');
                                        $collectionHolder.data('index', 1);
                                    });

                                    $('#submitButton').click(function () {
                                        document.forms[3].submit();
                                    });

                                });
                            }
                            childTable.append(childTBody);
                            var newTR = $('<tr class="childTable"></tr>');

                            var vCols = table.find('th').length;

                            var newTD = $('<td colspan="' + vCols + '" style="background-color: #dfdfdf"></td>');
                            newTD.append($('<strong>N&uacute;mero de respuestas: </strong> ' + i + '<br />'));
                            newTD.append(childTable);
                            newTR.append(newTD);
                            if (aData != undefined) {
                                $(nTr).after(newTR);
                            } else {
                                $(nTr).after('<tr><td colspan="2">' + childTable + "</td></tr>");
                            }
                            $('.respuesta').dataTable().fnDestroy();
                            $('.respuesta').dataTable({
                                destroy: true,
                                paging: false,
                                searching: false,
                                "columnDefs": [{
                                    "orderable": false,
                                    "targets": [5]
                                }
                                ],
                                "order": [
                                    [1, 'desc']
                                ],
                                "language": {
                                    "sZeroRecords": "",
                                    "sEmptyTable": "",
                                    "sInfo": ""
                                }
                            });

                        }

                    }
                });
            }
        });
    };

    var _initTable4 = function (userId) {
        var table = $('#sample_5');
        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        $.extend(true, $.fn.DataTable.TableTools.classes, {
            "container": "btn-group tabletools-dropdown-on-portlet-refe",
            "buttons": {
                "normal": "btn btn-sm default",
                "disabled": "btn btn-sm default disabled"
            }
        });

        var oTable = table.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": Routing.generate('lectura_ajax_listado', {from: 'userDetails', id: userId}),
                "type": "POST"
            },
            "drawCallback": function () {
                var $tr = $('#sample_5').find('tbody tr');
                $tr.each(function () {
                    var nCloneTd = document.createElement('td');
                    nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';

                    this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                })
            },
            "columnDefs": [{
                "visible": false,
                "targets": [0]
            }, {
                "orderable": false,
                "targets": [0]
            },
                {"width": "40%", "targets": 1}
            ],
            "order": [
                [2, 'desc']
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
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                "sPaginationType": "full_numbers",
                "sProcessing": "Procesando..."
            },
            // set the initial value
            "pageLength": 10,
            "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            "tableTools": {
                "sSwfPath": "{{ asset('metronic/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}",
                "aButtons": [{
                    "sExtends": "pdf",
                    "sButtonText": "PDF",
                    "sPdfMessage": "Listado de Entradas/Salidas",
                    "mColumns": [1, 2, 3, 4]
                }, {
                    "sExtends": "xls",
                    "sButtonText": "Excel"
                }, {
                    "sExtends": "print",
                    "sButtonText": "Imprimir",
                    "sInfo": 'Presione "CTRL+P" para imprimir o "ESC" para regresar',
                    "sMessage": "Generado por CUBiM"
                }, {
                    "sExtends": "copy",
                    "sButtonText": "Copiar"
                }]
            }
        });
        $lecturaTable.prePostConfigure(table, oTable);
    };

    var $lecturaTable = {};
    $lecturaTable.prePostConfigure = function (table, oTable) {
        var tableWrapper = $('#sample_5_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        /*
         * Insert a 'details' column to the table
         */

        var nCloneTh = document.createElement('th');
        nCloneTh.className = "table-checkbox";

        table.find('thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        table.on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nTr);
            var param;
            if (aData == undefined) {
                param = $($(nTr).find("td")[0]).text();
            } else {
                param = aData[0];
            }
            if ($(this).hasClass("row-details-open")) {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                if (aData != undefined && $(nTr).next().hasClass('childTable')) {
                    $(nTr).next().remove();
                }
            } else {
                /* Open this row */
                var childTable = "";
                $(this).addClass("row-details-open").removeClass("row-details-close");

                $.ajax({
                    url: Routing.generate('lectura_ajax_detalle', {'id': param}),
                    contentType: 'application/json; charset=utf-8',
                    success: function (data) {
                        var childTable = $('<table></table>');
                        childTable.addClass('table table-striped table-bordered table-hover dataTable no-footer detalle');
                        var childTHead = $('<thead></thead>');
                        var childTRTHead = $('<tr></tr>');
                        childTRTHead.append($('<th><strong>Modalidad</strong></th>'));
                        childTRTHead.append($('<th class="hidden"><strong>Agrupado por modalidades</strong></th>'));
                        childTHead.append(childTRTHead);
                        childTable.append(childTHead);
                        var childTBody = $('<tbody></tbody>');
                        if (data.length > 2) {
                            var formattedData = JSON.parse(data);
                            for (var i = 0; i < formattedData.data.length; i++) {
                                var childTRTBody = $('<tr></tr>');
                                childTRTBody.append($('<td>' + formattedData.data[i].modalidad + '</td>'));
                                if (formattedData.data[i].modalidad != "Autoestudio") {
                                    if (formattedData.data[i].modalidad != 'PC')
                                        childTRTBody.append($('<td>' + formattedData.data[i].tipo + ': ' + formattedData.data[i].detalle + ' </td>'));
                                    else
                                        childTRTBody.append($('<td> Número: ' + formattedData.data[i].detalle + ' </td>'));
                                } else {
                                    childTRTBody.append($('<td></td>'));
                                }
                                childTBody.append(childTRTBody);

                            }
                            childTable.append(childTBody);
                            var newTR = $('<tr class="childTable"></tr>');

                            var vCols = table.find('th').length;

                            var newTD = $('<td colspan="' + vCols + '" style="background-color: #dfdfdf"></td>');
                            newTD.append(childTable);
                            newTR.append(newTD);
                            if (aData != undefined) {
                                $(nTr).after(newTR);
                            } else {
                                $(nTr).after('<tr><td colspan="2">' + childTable + "</td></tr>");
                            }
                            $('.detalle').dataTable().fnDestroy();
                            var dt = $('.detalle').DataTable({
                                "drawCallback": function (settings) {
                                    var api = this.api();
                                    var rows = api.rows({page: 'current'}).nodes();
                                    var last = null;

                                    api.column(0, {page: 'current'}).data().each(function (group, i) {
                                        if (last !== group) {
                                            $(rows).eq(i).before(
                                                '<tr class="group"><td colspan="3">' + group + '</td></tr>'
                                            );

                                            last = group;
                                        }
                                    });
                                },
                                destroy: true,
                                paging: false,
                                searching: false,
                                "order": [
                                    [0, 'asc']
                                ],
                                "language": {
                                    "sZeroRecords": "",
                                    "sEmptyTable": "",
                                    "sInfo": ""
                                },
                                "columnDefs": [{
                                    "visible": false,
                                    "targets": [0]
                                }]
                            });
                            $('.detalle tbody').on('click', 'tr.group', function () {
                                var currentOrder = dt.order()[0];
                                if (currentOrder[0] === 0 && currentOrder[1] === 'asc') {
                                    dt.order([0, 'desc']).draw();
                                }
                                else {
                                    dt.order([0, 'asc']).draw();
                                }
                            });

                        }

                    }
                });
            }
        });
    };

    return {
        initUsersListDatatable: function () {
            _initUsersListDatatable();
        },

        initTable0: function (userId) {
            _initTable0(userId)
        },

        initTable1: function (userId) {
            _initTable1(userId)
        },

        initTable2: function (userId) {
            _initTable2(userId)
        },

        initTable3: function (userId) {
            _initTable3(userId)
        },

        initTable4: function (userId) {
            _initTable4(userId)
        },

        initDatatableColumnVisibility: function () {
            _initDatatableColumnVisibility();
        }
    }
}();