sprint_editor.registerBlock('my_color', function ($, $el, data) {
    data = $.extend({
        title: '',
        items: [],
        file: {},
        filepdf: {},
    }, data);

    var itemsCollection = {};

    $.each(data.items, function (index, item) {
        var uid = sprint_editor.makeUid();
        itemsCollection[uid] = item;
    });

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.title = $el.find('.sp-title').val();

        data.items = [];

        $el.find('.my_color__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }

        });

        return data;
    };

    this.afterRender = function () {

        renderfiles();

        var $btn = $el.find('.my_color__sp-file-color');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');
        var $text = '';

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('files') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                data.file = result.result.file[0];

                $label.text(data.file.ORIGINAL_NAME);

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);
                $label.text('Загрузка: ' + progress + '%');
            }

        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');




        var $pdfbutton = $el.find('.my_advantages__sp-filepdf');
        var $btninputpdf = $pdfbutton.find('input[type=file]');
        var $labelpdf = $pdfbutton.find('strong');

        $btninputpdf.fileupload({
            url: sprint_editor.getBlockWebPath('files') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                data.filepdf = result.result.file[0];

                $labelpdf.text(data.filepdf.ORIGINAL_NAME);

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);
                $labelpdf.text('Загрузка: ' + progress + '%');
            }

        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');




        $el.on('click', '.my_color__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_color__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();
        });
        
        $el.on('click', '.my_advantages__sp-item-del-file', function () {
            deletefiles();
            data.filepdf = {};
            renderfiles();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                file: '',
                colorName: '',
            };

            renderitem(uid);
        });

        $el.on('click', '.my_color__sp-item-del-file', function () {
            deletefiles();
            data.file = {};
            renderfiles();
        });

        $el.on('click', '.my_color__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item = false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_color__sp-file');
        var $btninput = $btn.find('input[type=file]');

        if (item) {
            item.find('.my_color__sp-item-title').bindWithDelay('input', function () {
                itemsCollection[uid].colorName = $(this).val();
            }, 500);
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_color') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].file = result.result.file[0];

                renderitem(uid);
            },
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    };

    var renderitem = function (uid) {
        if (!itemsCollection[uid]) {
            return;
        }

        var item = itemsCollection[uid];
        var $item = $el.find('[data-uid="' + uid + '"]');

        if ($item.length > 0) {
            $item.replaceWith(sprint_editor.renderTemplate('my_color-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_color__sp-result').append(sprint_editor.renderTemplate('my_color-item', {
                item: item,
                uid: uid,
                active: 0
            }));
        }
    };

    var renderfiles = function () {
        var $btn = $el.find('.my_color__sp-file-color');
        var $label = $btn.find('strong');

        if (data.file.ORIGINAL_NAME) {
            $label.text(data.file.ORIGINAL_NAME);
        } else {
            $label.text('Загрузить');
        }
    };

    var deletefiles = function (uid) {
        if (uid && itemsCollection[uid]) {
            var items = {};
            items[uid] = itemsCollection[uid];

            sprint_editor.markImagesForDelete(items);
        }
    };
});