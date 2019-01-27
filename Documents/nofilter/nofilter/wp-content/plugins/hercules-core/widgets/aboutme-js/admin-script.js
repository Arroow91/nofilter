function hs_open_uploader(element, class_name){

	$that = jQuery(element);
    wp.media.editor.send.attachment = function(props, attachment, field){
        var size = props.size;
    	$that.prev().val(attachment.sizes[size].url);

    	jQuery('.'+class_name + ' > img').remove();
    	jQuery('.'+class_name).prepend('<img src="'+attachment.sizes[size].url+'" style="max-width:100%">');
    }

    wp.media.editor.open(this);

    return false;
}