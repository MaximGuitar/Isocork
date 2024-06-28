sprint_editor.registerBlock('my_specifications_content', function ($, $el, data) {
    data = $.extend({
        title: '',
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

        data.items = [];

        $el.find('.my_specifications_content__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }

        });

        return data;
    };

    this.afterRender = function () {
  
        $el.on('click', '.my_specifications_content__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_specifications_content__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                specificationKey: '',
                specificationValue: '',
            };

            renderitem(uid);
        });

        $el.on('click', '.my_specifications_content__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        if(item) {
            item.find('.my_specifications_content__sp-item-title').bindWithDelay('input', function () {
                itemsCollection[uid].specificationKey = $(this).val();
            }, 500);

            item.find('.my_specifications_content__sp-item-value').bindWithDelay('input', function () {
                itemsCollection[uid].specificationValue = $(this).val();
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
            $item.replaceWith(sprint_editor.renderTemplate('my_specifications_content-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_specifications_content__sp-result').append(sprint_editor.renderTemplate('my_specifications_content-item', {
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