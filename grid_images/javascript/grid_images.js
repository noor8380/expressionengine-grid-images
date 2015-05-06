$(document).ready(function() {
    $('head').append('<style>.grid_images{text-align:center;margin-top:8px;}</style>');
});

$('.grid_images').click(function() {
    $(this).select();
});

Grid.bind('grid_images', 'display', function(cell) {
   grid_images_render();
});

Grid.bind('grid_images', 'remove', function(cell) {
   grid_images_render();
});

Grid.bind('grid_images', 'beforeSort', function(cell) {
   grid_images_render();
});

Grid.bind('grid_images', 'afterSort', function(cell) {
   grid_images_render();
});

function grid_images_render() {
    setTimeout(function() {
        $('.grid_images:visible').each(function(i) {
            $(this).val('[image-'+(i+1)+']');
        });
    }, 50);
}