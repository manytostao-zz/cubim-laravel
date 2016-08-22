/**
 * Created by manytostao on 25/05/15.
 */
'use strict';

/*
 * show.bs.modal
 * shown.bs.modal
 * hide.bs.modal
 * hidden.bs.modal
 *
 * */

var nomenclatorsDatatables = function () {

    var oTable;

    var _initNomenclatorsListDatatable = function (nomenclator_type_id) {
        var table = $('#nomenclatorsListDatatable');
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

        oTable = table.DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": laroute.route('nomenclators.datatable'),
                "type": "POST",
                "data": {_token: CSRF_TOKEN, nomenclator_type_id: nomenclator_type_id}
            },
            "drawCallback": $nomenclatorTable.postDraw,
            "columnDefs": [{
                "visible": false,
                "targets": [0]
            }, {
                "orderable": false,
                "targets": [4]
            }, {
                "class": "nom-description",
                "targets": [1]
            }, {
                "class": "column-center",
                "targets": [2, 3, 4]
            }],
            "order": [
                [1, 'asc']
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
                "aButtons": []
            }
        });

        var tableWrapper = $('#nomenclatorsListDatatable_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

        /* modify datatable control inputs */
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    };

    var $nomenclatorTable = {};

    $nomenclatorTable.postDraw = function () {
        var $tr = $('#nomenclatorsListDatatable').find('tbody tr');
        $tr.each(function (counter) {
            var nCloneTd = '';
            var aData = $('#nomenclatorsListDatatable').DataTable().row(this).data();
            if (aData != undefined) {
                var dropdownClass = 'dropdown-menu';
                if (counter > oTable.rows().count() - 3 && counter < oTable.rows().count())
                    dropdownClass = 'dropdown-menu bottom-left';
                var col_md_12 = $('<div class=col-md-12></div>');
                var btn_group = $('<div class="btn-group"></div>');
                var btn_actions = $('<button class="btn dropdown-toggle" data-toggle="dropdown">Acciones <i class="fa fa-angle-down"></i></button>');
                var ul = $('<ul class="' + dropdownClass + '"></ul>');
                var btn_edit = $('<li class="pull-left">' +
                    '<a class="btn-edit" data-id="' + aData[0] + '" data-description="' + aData[1] + '" href="javascript:;">' +
                    '<i class="fa fa-edit"></i>Editar </a>' +
                    '</li>');
                var btn_activate = $('<li class="pull-left">' +
                    '<a class="btn-edit" data-id="' + aData[0] + '" href="javascript:;">' +
                    '<i class="fa fa-check"></i>Activar </a>' +
                    '</li>');
                var btn_delete = $('<li class="pull-left">' +
                    '<a class="btn-delete" data-id="' + aData[0] + '">' +
                    '<i class="fa fa-search"></i>Eliminar </a>' +
                    '</li>');
                if (oTable.rows().count() <= 2) {
                    ul.width(267);
                }
                if (aData[2] == true) {
                    if (oTable.rows().count() <= 2) {
                        ul.width(180);
                        ul.removeClass('bottom-left').addClass('bottom-left-small');
                    }
                    ul.append(btn_edit).append(btn_delete);
                }
                else {
                    if (oTable.rows().count() <= 2) {
                        ul.width(270);
                        ul.removeClass('bottom-left').addClass('bottom-left-wide');
                    }
                    ul.append(btn_edit).append(btn_activate).append(btn_delete);
                }
                btn_group.append(btn_actions).append(ul);
                col_md_12.append(btn_group);
                aData[2] = aData[2] == true ? '<i class="fa fa-check fa-success"></i>' : '<i class="fa fa-ban fa-danger"></i>';
                aData[4] = col_md_12.html();
                oTable.row(this).data(aData);
                $('.btn-edit').click(function () {
                    var $modalView = $('#modal-edit');
                    $modalView.modal();
                    $modalView.find('.modal-title').text('Editar valor');
                    $modalView.find('#form_id').val($(this).data('id'));
                    $modalView.find('#form_description').val($(this).data('description'));
                    $modalView.find('#form_nomenclator').attr('action', laroute.route('nomenclators.update', {nomenclators: $(this).data('id')}));
                    $modalView.modal('show');
                });

                $('.btn-delete').click(function () {
                    var id = $(this).attr('data-id');
                    $('#delete').attr('href', laroute.route('nomenclators.destroy', {nomenclators: id}));
                    var $modalView = $('#modal-delete');
                    $modalView.modal();
                });
            }
        });

    };

    return {
        initNomenclatorsListDatatable: function (nomenclator_type_id) {
            _initNomenclatorsListDatatable(nomenclator_type_id)
        }
    }
}();