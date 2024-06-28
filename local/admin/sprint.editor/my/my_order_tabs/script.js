sprint_editor.registerBlock('my_order_tabs', function ($, $el, data, settings, currentEditorParams) {

    settings = settings || {};
    currentEditorParams = currentEditorParams || {};

    data = $.extend({
        items: [],
        file: {},
        title: ''
    }, data);

    var blocklist = [
        { id: 'my_order_content', title: 'Вид работы' },
    ];

    if (settings.blocks && settings.blocks.value) {
        blocklist = [];
        $.each(settings.blocks.value, function (index, val) {
            blocklist.push({ id: index, title: val })
        });
    }

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.title = $el.find('.sp-title').val();
        var $container = $el.children('.sp-acc-container');
        data.descr = $el.find('.sp-descr').val();
        data.items = [];
        $container.children('.sp-acc-tab').each(function () {
            var $tabContainer = $(this).children('.sp-acc-tab-container');
            var $tabBtn1 = $(this).children('.sp-acc-buttons1')
            var $tabBtn2 = $(this).children('.sp-acc-buttons2')

            var tab = {
                file: {},
                blocks: []
            };

            $tabContainer.children('.sp-acc-box').each(function () {
                var blockData = sprint_editor.collectData(
                    $(this).data('uid')
                );

                blockData.settings = sprint_editor.collectSettings(
                    $(this).children('.sp-x-box-settings')
                );

                tab.blocks.push(blockData);
            });

            data.items.push(tab);

        });
        return data;
    };

    this.afterRender = function () {
        var $container = $el.children('.sp-acc-container');
        var $addtabbtn = $el.children('.sp-acc-add-tab');

        renderfiles();

        var $btn = $el.find('.my_order_content__sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');

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


        $el.on('click', '.my_order_content__sp-item-del-file', function () {
            deletefiles();
            data.file = {};
            renderfiles();
        });


        $.each(data.items, function (index, item) {
            addTab(item);
        });

        $addtabbtn.on('click', function (e) {
            addTab({
                blocks: []
            });
        });

        $container.sortable({
            items: "> div",
            handle: ".sp-acc-tab-handle",
        });

        function addTab(tabData) {
            var $tab = $(sprint_editor.renderTemplate('my_order_tabs-tab', {
                blocklist: blocklist
            }));

            $container.append($tab);

            var $tabcontainer = $tab.children('.sp-acc-tab-container');

            $.each(tabData.blocks, function (index, blockData) {
                addblock(blockData, $tabcontainer)
            });

            var $tabBtn1 = $tab.children('.sp-acc-buttons1')
            //var $tabBtn2 = $tab.children('.sp-acc-buttons2')

            if (tabData.blocks.length === 0) {
                addblock(
                    {
                        name: 'my_order_content'
                    },
                    $tabcontainer
                );
            }

            $tabBtn1.on('click', '.sp-acc-del', function (e) {
                e.preventDefault();
                var $target = $(this).closest('.sp-acc-tab');

                $target.hide(250, function () {
                    $target.remove();
                });
            });
            $tabBtn1.on('click', '.sp-acc-up', function (e) {
                e.preventDefault();
                var $block = $(this).closest('.sp-acc-tab');
                var $nblock = $block.prev('.sp-acc-tab');
                if ($nblock.length > 0) {
                    $block.insertBefore($nblock);
                }
            });
            $tabBtn1.on('click', '.sp-acc-dn', function (e) {
                e.preventDefault();
                var $block = $(this).closest('.sp-acc-tab');
                var $nblock = $block.next('.sp-acc-tab');
                if ($nblock.length > 0) {
                    $block.insertAfter($nblock);
                }
            });


            $tabcontainer.sortable({
                items: "> div",
                handle: ".sp-acc-box-handle",
                connectWith: ".sp-acc-tab-container",
            });
        }

        function addblock(blockData, $tabcontainer) {
            var uid = sprint_editor.makeUid('sp-acc');
            var blockSettings = sprint_editor.getBlockSettings(blockData.name, currentEditorParams);

            var $box = $(sprint_editor.renderTemplate('my_order_tabs-box', {
                uid: uid,
                title: sprint_editor.getBlockTitle(blockData.name),
                compiled: sprint_editor.compileSettings(blockData, blockSettings)
            }));

            $tabcontainer.append($box);

            var $elBlock = $box.children('.sp-acc-box-block');
            var elEntry = sprint_editor.initblock(
                $,
                $elBlock,
                blockData.name,
                blockData,
                blockSettings,
                currentEditorParams
            );

            sprint_editor.initblockAreas(
                $,
                $elBlock,
                elEntry,
                currentEditorParams
            );
            sprint_editor.registerEntry(uid, elEntry);


            var $buttonsBox = $box.children('.sp-x-buttons-box');

            $buttonsBox.on('click', '.sp-acc-box-del', function (e) {
                e.preventDefault();
                var $target = $(this).closest('.sp-acc-box');

                var uid = $target.data('uid');
                sprint_editor.beforeDelete(uid);

                $target.hide(250, function () {
                    $target.remove();
                });
            });
            $buttonsBox.on('click', '.sp-acc-box-up', function (e) {
                e.preventDefault();

                var $block = $(this).closest('.sp-acc-box');
                var $grid = $(this).closest('.sp-acc-tab');

                var $nblock = $block.prev('.sp-acc-box');
                if ($nblock.length > 0) {
                    $block.insertBefore($nblock);
                    sprint_editor.afterSort($block.data('uid'));
                } else {
                    var $ngrid = $grid.prev('.sp-acc-tab');
                    if ($ngrid.length > 0) {
                        $block.appendTo(
                            $ngrid.children('.sp-acc-tab-container')
                        );
                        sprint_editor.afterSort(
                            $block.data('uid')
                        );
                    }
                }
            });
            $buttonsBox.on('click', '.sp-acc-box-dn', function (e) {
                e.preventDefault();

                var $block = $(this).closest('.sp-acc-box');
                var $grid = $(this).closest('.sp-acc-tab');

                var $nblock = $block.next('.sp-acc-box');
                if ($nblock.length > 0) {
                    $block.insertAfter($nblock);
                    sprint_editor.afterSort(
                        $block.data('uid')
                    );
                } else {
                    var $ngrid = $grid.next('.sp-acc-tab');
                    if ($ngrid.length > 0) {
                        $block.insertAfter(
                            $ngrid.children('.sp-acc-tab-container')
                        );
                        sprint_editor.afterSort(
                            $block.data('uid')
                        );
                    }
                }
            });
        }


        var btns = [];
        var cssList = {};
        var plugins = {};

        if (settings.csslist && settings.csslist.value) {
            cssList = settings.csslist.value;

            plugins = {
                mycss: {
                    cssList: cssList
                }
            };

            btns = [
                ['viewHTML'],
                ['formatting'],
                ['myCss'],
                ['strong', 'em', 'underline', 'del'],
                ['link', 'specialChars'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['removeformat']
            ];

        } else {
            btns = [
                ['viewHTML'],
                ['formatting'],
                ['strong', 'em', 'underline', 'del'],
                ['link', 'specialChars'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['removeformat']
            ]
        }


        $el.find('.sp-descr').trumbowyg({
            svgPath: '/bitrix/admin/sprint.editor/assets/trumbowyg/ui/icons.svg',
            lang: 'ru',
            resetCss: true,
            removeformatPasted: true,
            autogrow: true,
            btns: btns,
            plugins: plugins
        });
    };

    var renderfiles = function () {
        var $btn = $el.find('.my_order_content__sp-file');
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
