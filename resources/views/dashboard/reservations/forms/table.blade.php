@section('scripts')

    <script>
        function tableGenerate(data = '') {

            var dataTable =
                $('#dataTable').DataTable({

                    ajax: {
                        url: "{{ url(route('reservations.dataTable')) }}",
                        type: "GET",

                        data: {
                            req: data,

                        },
                        dataSrc: function (data) {
                            total_price = data.total_price;

                            return data.data;
                        },
                    },


                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                    },
                    processing: true,
                    stateSave: true,
                    serverSide: true,
                    /*responsive: {
                        details: true
                    },*/
                    responsive: true,
                    // responsive: !0,

                    order: [[1, "desc"]],

                    "headerCallback": function (thead, data, start, end, display) {
                        $(thead).addClass('success');

                        $(thead).find('th').eq(0).html("اجمالي المبالغ حسب الفترة : " + total_price);

                        $(thead).find('th').eq(1).html('اجمالي الطلبات حسب الفترة : ' + this.fnSettings().fnRecordsTotal()
                        );


                    },
                    columns: [
                        {data: 'id', className: 'dt-center'},
                        {data: 'id', className: 'dt-center', width: '10px',},
                        {
                            data: "username", className: 'dt-center',
                            render: function (data, type, row, meta) {
                                var url = "{{ route('users.edit', ':id') }}";
                                url = url.replace(':id', row.user_id);
                                return '<a href="' + url + '"> ' + row.username + '</a>';
                            }
                        },
                        {data: "user_id", className: 'hide_column'},
                        {data: 'user_email', className: 'hide_column'},
                        {data: 'user_mobile', className: 'hide_column'},
                        {data: "doctor.user.id", className: 'hide_column'},

                        {
                            data: "doctor.user.name", className: 'dt-center',
                            searchable: false, orderable: false,
                            render: function (data, type, row, meta) {
                                var url = "{{ route('doctors.edit', ':id') }}";
                                url = url.replace(':id', row.doctor.id);
                                return '<a href="' + url + '"> ' + row.doctor.user.name + '</a>';
                            }
                        },

                            {{--{--}}
                            {{--    data: "doctor_name", className: 'dt-center',--}}
                            {{--    render: function (data, type, row, meta) {--}}
                            {{--        var url = "{{ route('doctors.edit', ':id') }}";--}}
                            {{--        url = url.replace(':id', row.doctor_id);--}}
                            {{--        return '<a href="' + url + '"> ' + row.doctor_name + '</a>';--}}
                            {{--    }--}}
                            {{--},--}}

                        {
                            data: "doctor.user.email", className: 'hide_column'
                        },
                        {data: 'created_at', className: 'dt-center'},
                        {data: 'date', className: 'dt-center'},

                        // {data: 'start_time', className: 'dt-center'},
                        // {data: 'end_time', className: 'dt-center'},

                        {
                            data: 'start_time', className: 'dt-center', render: function (data, type, row, meta) {
                                // var startTime = (row.start_time > 12 ? (row.start_time - 12) + " PM" : (row.start_time == 0 ? "12 AM" : row.start_time + " AM"));
                                var startTime = (row.start_time < 12 ? (row.start_time == 0 ? 12 + " AM" : row.start_time + " AM") : (row.start_time == 12 ? 12 + " PM" : row.start_time - 12 + " PM"));
                                return startTime;
                            }
                        },
                        {
                            data: 'end_time', className: 'dt-center', render: function (data, type, row, meta) {
                                // var endTime = (row.end_time > 12 ? (row.end_time - 12) + " PM" : (row.end_time == 0 ? "12 AM" : row.end_time + " AM"));
                                var endTime = (row.end_time < 12 ? (row.end_time == 0 ? 12 + " AM" : row.end_time + " AM") : (row.end_time == 12 ? 12 + " PM" : row.end_time - 12 + " PM"));
                                return endTime;
                            }
                        },

                        {data: "service.name", className: 'dt-center'},
                        {data: 'price', className: 'dt-center'},
                        {data: 'order_status.title', className: 'hide_column'},
                        {data: 'payment_type', className: 'hide_column'},
                        {data: 'id'},
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            width: '30px',
                            className: 'dt-center',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" value="` + data + ` class="group-checkable" name="ids">
                        <span></span>
                      </label>
                    `;
                            },
                        },
                        {
                            targets: -1,
                            width: '13%',
                            title: '{{__('dashboard.reservations.datatable.options')}}',
                            className: 'dt-center',
                            orderable: false,
                            render: function (data, type, full, meta) {

                                // Edit
                                var editUrl = '{{ route("reservations.edit", ":id") }}';
                                editUrl = editUrl.replace(':id', data);

                                // Delete
                                var deleteUrl = '{{ route("reservations.destroy", ":id") }}';
                                deleteUrl = deleteUrl.replace(':id', data);

                                return `
    					@permission('edit_reservations')
    						<a href="` + editUrl + `" class="btn btn-sm blue" title="Edit">
    			              <i class="fa fa-edit"></i>
    			            </a>
    					@endpermission

              @permission('delete_reservations')
              @csrf
                                    <a href="javascript:;" onclick="deleteRow('` + deleteUrl + `')" class="btn btn-sm red">
                  <i class="fa fa-trash"></i>
                </a>
              @endpermission`;
                            },
                        },
                    ],

                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, 500],
                        ['10', '25', '50', '100', '500']
                    ],
                    buttons: [
                        {
                            extend: "pageLength", className: "btn blue btn-outline",
                            text: "{{__('datatable.pageLength')}}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        {
                            extend: "print", className: "btn blue btn-outline",
                            text: "{{__('datatable.print')}}",
                            exportOptions: {
                                stripHtml: true,
                                // columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                            }
                        },
                        {
                            extend: "pdf", className: "btn blue btn-outline",
                            text: "{{__('datatable.pdf')}}",
                            exportOptions: {
                                stripHtml: true,
                                // columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                            }
                        },
                        {
                            extend: "excel", className: "btn blue btn-outline ",
                            text: "{{__('datatable.excel')}}",
                            exportOptions: {
                                stripHtml: true,
                                // columns: ':visible',
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
                            }
                        },
                        {{--{--}}
                        {{--    extend: "colvis", className: "btn blue btn-outline",--}}
                        {{--    text: "{{__('datatable.colvis')}}",--}}
                        {{--    exportOptions: {--}}
                        {{--        stripHtml: true,--}}
                        {{--        columns: ':visible',--}}
                        {{--        // columns: [1, 2, 6, 7, 9, 10, 11, 12, 13]--}}
                        {{--    }--}}
                        {{--},--}}


                    ],
                    text: [

                        {{--{--}}
                        {{--    extend: "colvis", className: "btn blue btn-outline",--}}
                        {{--    text: "{{__('datatable.colvis')}}",--}}
                        {{--    exportOptions: {--}}
                        {{--        stripHtml: true,--}}
                        {{--        columns: ':visible',--}}
                        {{--        // columns: [1, 2, 6, 7, 9, 10, 11, 12, 13]--}}
                        {{--    }--}}
                        {{--},--}}

                    ]


                });

            dataTable.column(12).visible(true);

        }

        jQuery(document).ready(function () {
            tableGenerate();

        });
    </script>

@stop
