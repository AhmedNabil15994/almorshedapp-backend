@if (is_rtl() == 'rtl')
    <script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-rtl.min.js"
            type="text/javascript"></script>
@else
    <script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
@endif
<script>

    // DELETE ROW FROM DATATABLE
    function deleteRow(url) {
        var _token = $('input[name=_token]').val();

        bootbox.confirm({
            message: '{{__('dashboard.general.msg_delete')}}',
            buttons: {
                confirm: {
                    label: '{{__('dashboard.general.yes_delete')}}',
                    className: 'btn-success'
                },
                cancel: {
                    label: '{{__('dashboard.general.no_delete')}}',
                    className: 'btn-danger'
                }
            },

            callback: function (result) {
                if (result) {

                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: _token
                        },
                        success: function (msg) {
                            toastr["success"](msg[1]);
                            $('#dataTable').DataTable().ajax.reload();
                        },
                        error: function (msg) {
                            toastr["error"](msg[1]);
                            $('#dataTable').DataTable().ajax.reload();
                        }
                    });

                }
            }
        });
    }

    // DELETE ROW FROM DATATABLE
    function deleteAllChecked(url) {
        var someObj = {};
        someObj.fruitsGranted = [];

        $("input:checkbox").each(function () {
            var $this = $(this);

            if ($this.is(":checked")) {
                someObj.fruitsGranted.push($this.attr("value"));
            }
        });

        var ids = someObj.fruitsGranted;

        bootbox.confirm({
            message: '{{__('dashboard.general.msg_all_delete')}}',
            buttons: {
                confirm: {
                    label: '{{__('dashboard.general.yes_delete')}}',
                    className: 'btn-success'
                },
                cancel: {
                    label: '{{__('dashboard.general.no_delete')}}',
                    className: 'btn-danger'
                }
            },

            callback: function (result) {
                if (result) {

                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            ids: ids,
                        },
                        success: function (msg) {

                            if (msg[0] == true) {
                                toastr["success"](msg[1]);
                                $('#dataTable').DataTable().ajax.reload();
                            } else {
                                toastr["error"](msg[1]);
                            }

                        },
                        error: function (msg) {
                            toastr["error"](msg[1]);
                            $('#dataTable').DataTable().ajax.reload();
                        }
                    });

                }
            }
        });
    }

    $(document).ready(function () {

        $('.js-example-basic-single').select2();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            if (start.isValid() && end.isValid()) {
                $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                $('input[name="from"]').val(start.format('YYYY-MM-DD'));
                $('input[name="to"]').val(end.format('YYYY-MM-DD'));
            } else {
                $('#reportrange .form-control').val('Without Dates');
                $('input[name="from"]').val('');
                $('input[name="to"]').val('');
            }
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                '{{__('dashboard.general.date_range.today')}}': [moment(), moment()],
                '{{__('dashboard.general.date_range.yesterday')}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '{{__('dashboard.general.date_range.7days')}}': [moment().subtract(6, 'days'), moment()],
                '{{__('dashboard.general.date_range.30days')}}': [moment().subtract(29, 'days'), moment()],
                '{{__('dashboard.general.date_range.month')}}': [moment().startOf('month'), moment().endOf('month')],
                '{{__('dashboard.general.date_range.last_month')}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            },
            @if (is_rtl() == 'rtl')
            opens: 'left',
            @endif
            buttonClasses: ['btn'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-danger',
            format: 'YYYY-MM-DD',
            separator: 'to',
            locale: {
                applyLabel: '{{__('dashboard.general.date_range.save')}}',
                cancelLabel: '{{__('dashboard.general.date_range.cancel')}}',
                fromLabel: 'from',
                toLabel: 'to',
                customRangeLabel: '{{__('dashboard.general.date_range.custom')}}',
                firstDay: 1
            }
        }, cb);

        cb(start, end);

    });

</script>
