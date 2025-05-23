<div class="portlet-body">
    <div class="panel-group accordion scrollable" id="accordion2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#filter_data_table" style="font-family: Cairo;"> {{__('datatable.search')}}
                    </a>
                </h4>
            </div>
            <div id="filter_data_table" class="panel-collapse collapse">
                <div class="panel-body">
                    <form id="formFilter" class="horizontal-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            {{__('dashboard.doctors.datatable.date_range')}}
                                        </label>
                                        <div id="reportrange" class="btn default form-control">
                                            <i class="fa fa-calendar"></i> &nbsp;
                                            <span> </span>
                                            <b class="fa fa-angle-down"></b>
                                            <input type="hidden" name="from">
                                            <input type="hidden" name="to">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-actions">
                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom" id="search">
                            <i class="fa fa-search"></i>
                            {{__('datatable.search')}}
                        </button>
                        <button class="btn btn-sm red btn-outline filter-cancel">
                            <i class="fa fa-times"></i>
                            {{__('datatable.reset')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
