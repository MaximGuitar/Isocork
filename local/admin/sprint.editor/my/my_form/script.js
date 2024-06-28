sprint_editor.registerBlock('my_form', function ($, $el, data) {

    data = $.extend({
        title: '',
        subtitle: '',
        file: {},
    }, data);

    this.afterRender = function () {
        renderfiles();

        var $btn = $el.find('.sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');
        var labeltext = $label.text();

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_form') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                deletefiles();

                $.each(result.result.file, function (index, file) {
                    data.file = file;
                });

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);

                $label.text('Загрузка: ' + progress + '%');

                if (progress >= 100) {
                    $label.text(labeltext);
                }
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        $el.on('click', '.sp-item-del', function () {
            deletefiles();
            data.file = {};
            renderfiles();
        });
    };

    var renderfiles = function () {
        $el.find('.sp-result').html(
            sprint_editor.renderTemplate('my_form-image', data)
        );
    };

    var deletefiles = function () {
        var uid = sprint_editor.makeUid();
        var items = {};
        items[uid] = {
            file: data.file
        };

        sprint_editor.markImagesForDelete(items);
    };

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.title = $el.find('.sp-title').val();
        data.subtitle = $el.find('.sp-subtitle').val();
        return data;
    };
});