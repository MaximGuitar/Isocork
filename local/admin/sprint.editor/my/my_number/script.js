sprint_editor.registerBlock('my_number', function ($, $el, data, settings) {

    settings = settings || {};

    data = $.extend({
        title: '',
        text: '',
        btnText: '',
        btnLink: '',
        file: {},
        items: [],
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
        data.text = $el.find('.sp-text').val();
        data.btnText = $el.find('.sp-btnText').val();
        data.btnLink = $el.find('.sp-btnLink').val();

        data.items = [];

        $el.find('.my_number__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }
        });

        return data;
    };

    this.afterRender = function () {
        renderfiles();
        var $btn = $el.find('.sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');
        var labeltext = $label.text();

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_number') + '/upload.php',
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

        $el.on('click', '.my_number__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_number__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });


        $el.on('click', '.sp-item-del', function () {
            var $image = $el.find('.sp-x-active');
            $image.remove();
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                uid: uid,
                file: '',
                fileIcon: '',
                title: '',
                desc: '',
            };

            renderitem(uid);
        });

        $el.on('click', '.my_number__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var renderfiles = function () {
        $el.find('.sp-result').html(
            sprint_editor.renderTemplate('my_number-image', data)
        );
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        if(item) {
            item.find('.my_number__sp-item-desc').bindWithDelay('input', function () {
                itemsCollection[uid].desc = $(this).val();
            }, 500);

            item.find('.my_number__sp-item-title').bindWithDelay('input', function () {
                itemsCollection[uid].title = $(this).val();
            }, 500);
        }
    };

    var renderitem = function (uid) {
        if (!itemsCollection[uid]) {
            return;
        }

        var item = itemsCollection[uid];
        var $item = $el.find('[data-uid="' + uid + '"]');

        if ($item.length > 0) {
            $item.replaceWith(sprint_editor.renderTemplate('my_number-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_number__sp-result').append(sprint_editor.renderTemplate('my_number-item', {
                item: item,
                uid: uid,
                active: 0
            }));
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