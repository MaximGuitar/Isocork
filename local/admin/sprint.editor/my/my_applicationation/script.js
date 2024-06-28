sprint_editor.registerBlock('my_applicationation', function ($, $el, data, settings) {

    settings = settings || {};

    data = $.extend({
        title: '',
        text: '',
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

        data.items = [];

        $el.find('.my_applicationation__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }
        });

        return data;
    };

    this.afterRender = function () {

        $el.on('click', '.my_applicationation__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_applicationation__sp-item');
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
                desc: '',
            };

            renderitem(uid);
        });

        $el.on('click', '.my_applicationation__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_applicationation__sp-file');
        var $btninput = $btn.find('input[type=file]');

        if(item) {
            item.find('.my_applicationation__sp-item-desc').bindWithDelay('input', function () {
                itemsCollection[uid].desc = $(this).val();
            }, 500);
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_applicationation') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].file = result.result.file[0];

                renderitem(uid);
            },
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        var $btnIcon = $el.find('.my_applicationation__sp-file-icon');
        var $btninputIcon = $btnIcon.find('input[type=file]');

        $btninputIcon.fileupload({
            url: sprint_editor.getBlockWebPath('my_applicationation') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].fileIcon = result.result.file[0];

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
            $item.replaceWith(sprint_editor.renderTemplate('my_applicationation-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_applicationation__sp-result').append(sprint_editor.renderTemplate('my_applicationation-item', {
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

    // this.getAreas = function(){
    //     return areas;
    // };
});