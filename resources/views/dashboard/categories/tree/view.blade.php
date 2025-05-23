@foreach ($mainCats as $category)
<ul>
	<li id="{{$category->id}}" data-jstree='{"opened":true}'>
		{{$category->title}}
		@if(count($category->children))
			@include('dashboard.categories.tree.view',['mainCats' => $category->children])
		@endif
	</li>
</ul>
@endforeach
