(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url

        // clear previous preview
        target_input.html('');
        target_preview.html('');

        // set or change the preview image src
        items.forEach(function (item) {
          target_preview.append('<div class="col-md-4"><div class="cbp-item identity logos"><div class="cbp-caption-defaultWrap"><img src="'+item.thumb_url+'" style="height: 15rem;"></div></div></div>');

          target_input.append(
            $('<input type="hidden" name="image[]">').attr('value', item.thumb_url)
          );
        });

        // trigger change event
        target_preview.trigger('change');
        target_input.trigger('change');
      };
      return false;
    });
  }

})(jQuery);
