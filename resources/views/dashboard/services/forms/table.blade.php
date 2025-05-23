@section('scripts')

<script>
 function tableGenerate(data='') {

    var dataTable =
    $('#dataTable').DataTable({
        ajax : {
            url   : "{{ url(route('services.dataTable')) }}",
            type  : "GET",
            data  : {
                req : data,
            },
        },
        language: {
            url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
        },
        processing: true,
        stateSave: true,
        serverSide: true,
        responsive: !0,
        order     : [[ 1 , "desc" ]],
        columns: [
    			{data: 'id' 		 	        , className: 'dt-center' , width: '10px',},
          {data: 'name' 			      , className: 'dt-center'},
    			{data: 'status' 			    , className: 'dt-center'},
          {data: 'createdAt' 		    , className: 'dt-center'},
          {data: 'id'},
    		],
        columnDefs: [
          {
    				targets: 2,
    				width: '30px',
    				className: 'dt-center',
    				render: function(data, type, full, meta) {
              if (data == 1) {
                return '<span class="badge badge-success"> {{__('datatable.active')}} </span>';
              }else{
                return '<span class="badge badge-danger"> {{__('datatable.unactive')}} </span>';
              }
    				},
    			},
          {
            targets: -1,
            width: '20%',
            title: '{{__('dashboard.services.datatable.options')}}',
            className: 'dt-center',
            orderable: false,
            render: function(data, type, full, meta) {

              // Show
    					var showUrl = '{{ route("services.show", ":id") }}';
    					showUrl = showUrl.replace(':id', data);

              // Edit
              var editUrl = '{{ route("services.edit", ":id") }}';
              editUrl = editUrl.replace(':id', data);

    					return `
    					@permission('edit_services')
    						<a href="`+editUrl+`" class="btn btn-sm blue" title="Edit">
    			              <i class="fa fa-edit"></i>
    			            </a>
    					@endpermission`;
            },
          },
        ],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50 , 100 , 500 ],
            [ '10', '25', '50', '100' , '500']
        ],
				buttons:[
					{
						extend: "pageLength", className: "btn blue btn-outline",
            text: "{{__('datatable.pageLength')}}",
            exportOptions: {
                stripHtml: true,
                columns: ':visible'
            }
					},
					{
						extend: "print", className: "btn blue btn-outline" ,
            text: "{{__('datatable.print')}}",
            exportOptions: {
                stripHtml: true,
                columns: ':visible'
            }
					},
					{
							extend: "pdf", className: "btn blue btn-outline" ,
              text: "{{__('datatable.pdf')}}",
              exportOptions: {
                  stripHtml: true,
                  columns: ':visible'
              }
					},
					{
							extend: "excel", className: "btn blue btn-outline " ,
              text: "{{__('datatable.excel')}}",
              exportOptions: {
                  stripHtml: true,
                  columns: ':visible'
              }
					},
					{
							extend: "colvis", className: "btn blue btn-outline",
              text: "{{__('datatable.colvis')}}",
              exportOptions: {
                  stripHtml: true,
                  columns: ':visible'
              }
					}
				]
    });
}

jQuery(document).ready(function() {
	tableGenerate();
});
</script>

@stop
