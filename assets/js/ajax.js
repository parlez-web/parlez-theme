/**
 * File ajax.js
 *
 * Handles ajax laoding of category posts on the homepage
 *
 */
( function($) {

var $content = $('.category-posts');
var $headline = $('.ajax-cat-name');

//* Streetstyle Category Load 
var $category_button = $('#category-filter button');

$category_button.on('click', function(event) {
    // Prevent normal link functionality
    event.preventDefault();
    // Get the name (slug) of the clicked menu tag
    var cat_slug = $(this).data('category');
    // Remove all 'selected' classes
    $category_button.removeClass('selected');
    // Add class 'selected' to the clicked item
    $(this).addClass('selected');
    // Then call ajax function with slug 
    load_ajax_cat_posts( cat_slug );
    console.log("Category: " + cat_slug);
});

//* Ajax Cat Function for Homepage
function load_ajax_cat_posts( slug ) {
    // Get the category of the page
    //var page_cat = $('.category-load-more').data('category');

    $.ajax({
            type: 'POST',
            dataType: 'html',
            url: ajaxpagination.ajaxurl,
            data: {
                'cat': slug,
                'action': 'jouy_category_post_ajax'
            },
            beforeSend : function () {
                // $content.html( $loading );
                // $loading.show();
                // $loader.hide();
                // $no_posts.hide();
            },
            success: function (data) {
                var $data = $(data);
                var $newElements = $data.css({ opacity: 0 });
                $content.html($newElements);
                $headline.hide();
                $newElements.animate({ opacity: 1 });
                // $loader.show();
                // $loading.hide();
            },
            error : function (jqXHR, textStatus, errorThrown) {
                $loader.html($.parseJSON(jqXHR.responseText) + ' :: ' + textStatus + ' :: ' + errorThrown);
                console.log(jqXHR);
                // $no_posts.show();
                ("Didn't work");
            },
        });
}

} )(jQuery);




