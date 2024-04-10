$(function(){

    $('#aaa-blog-list').btsListFilter('#search-input', {
        useHideClass: true,
        resetOnBlur: false,
        initial: false,
        minLength: 2,
        emptyNode: function(data){
            return '<a class="list-group-item-action well bts-dynamic-item" href="#"><span>No Blogs Found</span></a>';
        },
        cancelNode: function(){
            return '<button type="button" class="btn close form-control-feedback" aria-hidden="true" aria-label="Close" style="pointer-events: auto;"><span aria-hidden="true">×</span></button>';
        }
    });
    $("#search-input").on("keypress", function(e) { if (e.keyCode == 13) { e.preventDefault(); return false; } });
});
