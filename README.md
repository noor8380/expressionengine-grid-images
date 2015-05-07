
## Description

ExpressionEngine fieldtype and plugin which adds grid based responsive image support for text fields.

My goal with Grid Images is not to provide the full meal in terms of functionality, but rather provide bread for your sandwich. By no means am I offering an install-it-and-forget-it solution here, but something that you can easily customize to suit the needs of your build.

In the past I've achieved similar functionality using a multitide of addons from other developers. Not looking to reinvent the wheel, but instead streamline the process and provide required functionality in a single package supporting current versions of the CMS.

### Installation

Copy the "grid_images" folder to your /system/expressionengine/third_party folder. Install fieldtype from addons menu.

### Fieldtype Usage

The function of the fieldtype is to generate shortcodes for each grid row that can be copied and pasted into the text editor of your choice. Instead of creating a more robust fieldtype, I felt it best to piggy-back on Grid, leaving you open to use whichever file fieldtypes, size options, and other customizations you prefer.

#### Grid Field

![Image of Grid Field](http://thotbox.ca/grid-images-grid.jpg)

#### Text Field

![Image of Text Field](http://thotbox.ca/grid-images-text.jpg)

### Plugin Usage

The function of the plugin is to replace the shortcodes from your editor field with containers that you can target with javascript and insert images into.

Use the {exp:grid_images}{your_text_field}{/exp:grid_images} tag pair around your field output to replace shortcodes with numbered containers.

Example conversion:

```
[image-1] gets replaced with <div id="grid_image_1" class="grid_image"></div>
```

### Example Template Code

Using the above images as example, here's some sample template code. In the example above, I'm outputting the grid content as meta field, with data-attributes reflecting my options.

Your template code will need to be customized to reflect the custom options you've set in your grid field.

```
{exp:grid_images}{page_text}{/exp:grid_images}

{page_images}
    {if page_images:image_size == '1/2 Left'}
        <meta class="grid_images" id="grid_source_{page_images:count}" data-src="{page_images:image}" data-float="left" data-width="half">
    {if:elseif page_images:image_size == '1/2 Right'}
        <meta class="grid_images" id="grid_source_{page_images:count}" data-src="{page_images:image}" data-float="right" data-width="half">
    {if:else}
        <meta class="grid_images" id="grid_source_{page_images:count}" data-src="{page_images:image}" data-float="none" data-width="full">
    {/if}
{/page_images}
```

I don't recommend outputting raw images direct from the file upload field without some level of resizing happening. My preference is to use CE Image to manipulate images template-side, however solutions that manipulate the image at time of upload would work as well. Your template code will need to reflect whichever option you use.

### Example JavaScript

Your JS will also need to be customized to reflect the custom options used in your grid field, and whatever data-atributes you're outputting in your template. Once setup, the JS will look at your meta tags created by the grid field and create images inside the containers created by the plugin. Classes will be added to your containers based on the data-attributes attached to the meta tags, after which, the meta tags will be destroyed.

```
$(document).ready(function() {
    if($('.grid_images').length && $('.grid_image').length) {
        $('.grid_image').each(function() {
            var gridID = $(this).attr('id');
            gridID = gridID.replace('grid_image_', '');
            var gridImage = $('#grid_source_' + gridID).attr('data-src');
            var gridFloat = $('#grid_source_' + gridID).attr('data-float');
            var gridWidth = $('#grid_source_' + gridID).attr('data-width');

            $(this).html('<img src="' + gridImage + '">');

            if (gridFloat === 'left') {
                $(this).addClass('grid_image_left');
            } else if (gridFloat === 'right') {
                $(this).addClass('grid_image_right');
            }

            if (gridWidth === 'half') {
                $(this).addClass('grid_image_half');
            } else {
                $(this).addClass('grid_image_full');
            }

            $('#grid_source_' + gridID).remove();
        });
    }
});
```

### Example CSS

Finally, your CSS will need be customized to match your setup.

```
.grid_image_left { float: left; padding-right: 30px; }

.grid_image_right { float: right; padding-left: 30px; }

.grid_image_half { width: 50%; }

.grid_image_full { width: 100%; }

.grid_image img { margin-bottom: 30px; }

@media only screen and (max-width: 640px) { 
    .grid_image { float: none; padding: 0; width: 100%; }
}
```

### Sample Results

![Image of Results](http://thotbox.ca/grid-images-results.jpg)