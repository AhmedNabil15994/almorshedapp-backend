<div class="tab-pane fade" id="resultRange">
  <div class="col-md-12">
      <div class="col-md-10">
      @foreach($assessment->result_ranges as $range)
      <input type="hidden" name="result_range_id[]" value="{{ $range->id }}">
      @foreach (config('setting.locales') as $code)
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.assessments.create.rank')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <input type="text" name="rank[{{$code}}][]" class="form-control" data-name="rank.{{$code}}" value="{{ $range->translate($code)->rank }}">
              <div class="help-block"></div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.assessments.create.message')}} - {{ $code }}
          </label>
          <div class="col-md-9">
              <input type="text" name="message[{{$code}}][]" class="form-control" data-name="message.{{$code}}" value="{{ $range->translate($code)->message }}">
              <div class="help-block"></div>
          </div>
      </div>
      @endforeach
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.assessments.create.score_from')}}
          </label>
          <div class="col-md-9">
              <input type="number" class="form-control" name="score_from_{{ $range->id }}" data-name="score_from" value="{{ $range->score_from }}">
              <div class="help-block"></div>
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-2">
              {{__('dashboard.assessments.create.score_to')}}
          </label>
          <div class="col-md-9">
              <input type="number" class="form-control" name="score_to_{{ $range->id }}" data-name="score_to" value="{{ $range->score_to }}">
              <div class="help-block"></div>
          </div>
      </div>
      <hr>
      @endforeach
    </div>

    <div class="form-group resultRange-container">
        <label class="control-label col-md-3">
            <button type="button" class="btn btn-info add-resultRange"><i class="fa fa-plus"></i></button>
        </label>
    </div>

  </div>
</div>