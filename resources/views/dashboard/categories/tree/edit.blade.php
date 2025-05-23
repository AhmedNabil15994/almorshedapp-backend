@foreach ($mainCats as $cat)
	@if ($category->id != $cat->id)
		<ul>
			<li id="{{$cat->id}}"
				data-jstree='{"opened":true @if ($category->category_id == $cat->id),"selected":true @endif }'>
				{{$cat->title}}
				@if(count($cat->children))
					@include('dashboard.categories.tree.edit',['mainCats' => $cat->children])
				@endif
			</li>
		</ul>
	@endif
@endforeach
