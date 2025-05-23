<div class="col-md-8">
    <h3 class="page-title"></h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.availabilities.create.available_from')}}
            </label>
            <div class="col-md-4">
                <input type="time" class="form-control" name="available_from" data-name="available_from">
                <div class="help-block"></div>
            </div>
            <label class="col-md-2">
                {{__('dashboard.availabilities.create.available_to')}}
            </label>
            <div class="col-md-4">
                <input type="time" class="form-control" name="available_to" data-name="available_to">
                <div class="help-block"></div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="col-md-2">
                {{__('dashboard.availabilities.create.status')}}
            </label>
            <div class="col-md-9">
                <input type="checkbox" class="make-switch" id="test" data-size="small" name="status">
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>


