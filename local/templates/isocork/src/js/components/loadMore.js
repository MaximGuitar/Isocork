import getProjectItems from './projectPage';

$(document).ready(function(){
    $(document).on('click', '.load_more', function(){
        var targetContainer = $('.loadmore_wrap'),
            url =  $('.load_more').attr('data-url');
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){
                    //  Удаляем старую навигацию
                    $('.load_more').remove();
                    var elements = $(data).find('.loadmore_item'), 
                        pagination = $(data).find('.load_more');
                    targetContainer.append(elements); 
                    targetContainer.after(pagination);

                    getProjectItems();
                }
            })
        }
    });
});