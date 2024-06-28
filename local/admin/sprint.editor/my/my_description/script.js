sprint_editor.registerBlock('my_description', function ($, $el, data) {

    data = $.extend({
        title: '',
    }, data);

    var areas = [
        {
            dataKey : 'text',
            blockName: 'text',
            container : '.sp-text'
        },
    ];

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.title = $el.find('.sp-title').val();
        return data;
    };

    this.getAreas = function(){
        return areas;
    };
});