@section('scripts')

<script>
 function tableGenerate(data='') {

    var dataTable =
    $('#dataTable').DataTable({
        ajax : {
            url   : "{{ url(route('roles.dataTable')) }}",
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
          {data: 'id' 		 	        , className: 'dt-center'},
    			{data: 'id' 		 	        , className: 'dt-center'},
          {data: 'display_name' 	  , className: 'dt-center'},
    			{data: 'name' 			      , className: 'dt-center'},
          {data: 'perms' 					  , className: 'dt-center' , render: "[ –– ].name" , orderable : false},
          {data: 'createdAt' 		    , className: 'dt-center'},
          {data: 'id'},
    		],
        columnDefs: [
          {
    				targets: 0,
    				width: '30px',
    				className: 'dt-center',
    				orderable: false,
    				render: function(data, type, full, meta) {
    					return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" value="`+data+` class="group-checkable" name="ids">
                        <span></span>
                      </label>
                    `;
    				},
    			},
          {
            targets: -1,
            width: '13%',
            title: '{{__('dashboard.roles.datatable.options')}}',
            className: 'dt-center',
            orderable: false,
            render: function(data, type, full, meta) {

              // Edit
    					var editUrl = '{{ route("roles.edit", ":id") }}';
    					editUrl = editUrl.replace(':id', data);

    					// Delete
    					var deleteUrl = '{{ route("roles.destroy", ":id") }}';
    					deleteUrl = deleteUrl.replace(':id', data);

              return `
    					@permission('edit_roles')
    						<a href="`+editUrl+`" class="btn btn-sm blue" title="Edit">
    			              <i class="fa fa-edit"></i>
    			            </a>
    					@endpermission

              @permission('delete_roles')
              @csrf
                <a href="javascript:;" onclick="deleteRow('`+deleteUrl+`')" class="btn btn-sm red">
                  <i class="fa fa-trash"></i>
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
