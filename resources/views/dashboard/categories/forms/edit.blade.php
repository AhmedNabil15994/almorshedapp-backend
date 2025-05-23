<div class="col-md-4">
    <h3 class="page-title">{{__('dashboard.categories.create.category_level')}}</h3>
    <div id="jstree">
        <ul>
            <li id="null" data-jstree='{ {{ ($category->category_id == null) ? '"selected":true' : '' }} }'>
                {{__('dashboard.categories.create.main_tree')}}
            </li>
        </ul>
        @include('dashboard.categories.tree.edit')
    </div>
</div>
<div class="col-md-8">
    <h3 class="page-title">{{__('dashboard.categories.create.name')}}</h3>
    <div class="col-md-10">
        @foreach (config('setting.locales') as $code)
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.categories.create.name')}} - {{ $code }}
            </label>
            <div class="col-md-9">
                <input type="text" name="title[{{$code}}]" class="form-control" data-name="title.{{$code}}" value="{{$category->translate($code)->title}}">
                <div class="help-block"></div>
            </div>
        </div>
        @endforeach
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.categories.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($category->status == 1) ? ' checked="" ' : ''}}>

                <div class="help-block"></div>
            </div>
            <input type="hidden" name="category_id" id="root_category" value="">
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.categories.create.image')}}
            </label>
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i>
                        </a>
                    </span>
                </div>
                <span id="holder" style="margin-top:15px;max-height:100px;">
                    <img src="{{url($category->image)}}" style="height: 15rem;">
                </span>
                <span id="image"></span>
            </div>
        </div>
    </div>
</div>
