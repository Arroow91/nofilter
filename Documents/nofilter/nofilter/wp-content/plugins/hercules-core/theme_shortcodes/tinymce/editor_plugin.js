(function($) {
    tinymce.PluginManager.add('HS_Shortcodes', function( editor, url ) {
	
	        //helper functions
        function getAttr(s, n) {
            n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
            return n ?  window.decodeURIComponent(n[1]) : '';
        };
 
        function html( cls, data) {
		//var placeholder = url + '/images/' + getAttr(data,'visibleitems') + 'gallery-shortcode.jpg';
            var placeholder = url + '/images/gallery-shortcodeplaceholder.jpg';
            data = window.encodeURIComponent( data );
            
 
            return '<img style="width:auto;border: 1px solid #dddddd;position: relative;clear: both;margin-bottom: 16px;display: block;" src="' + placeholder + '" class="wpview wpview-wrap  ' + cls + '" ' + 'data-sh-attr="' + data + '" data-mce-resize="false" data-mce-placeholder="1" contenteditable="false" />';
        }
 
        function replaceShortcodes( content ) {
           
            return content.replace( /\[hercules-gallery([^\]]*)\]/g, function( all,attr) {
                return html( 'wp-bs3_panel', attr);
            });
        }
 
        function restoreShortcodes( content ) {
            //match any image tag with our class and replace it with the shortcode's content and attributes
            return content.replace( /(?:<p(?: [^>]+)?>)*(<img [^>]+>)(?:<\/p>)*/g, function( match, image ) {
                var data = getAttr( image, 'data-sh-attr' );
 
                if ( data ) {
                    return '[hercules-gallery' + data + ']';
                }
                return match;
            });
        }

		//replace from shortcode to an image placeholder
        editor.on('BeforeSetcontent', function(event){
            event.content = replaceShortcodes( event.content );
        });
 
        //replace from image placeholder to shortcode
        editor.on('GetContent', function(event){
            event.content = restoreShortcodes(event.content);
        });
		        //open popup on placeholder double click
        editor.on('mouseup',function(e) {
            var cls  = e.target.className.indexOf('wp-bs3_panel');
            if ( e.target.nodeName == 'IMG' && e.target.className.indexOf('wp-bs3_panel') > -1 ) {
                var title = e.target.attributes['data-sh-attr'].value;
                title = window.decodeURIComponent(title);
                //console.log(title);
               
                editor.execCommand('bs3_panel_popup','',{
                    ids : getAttr(title,'ids'),
                    rowheight : getAttr(title,'rowheight'),
                    lastrow   : getAttr(title,'lastrow'),
                    visibleitems   : getAttr(title,'visibleitems'),
					thumbwidth   : getAttr(title,'thumbwidth'),
					thumbheight   : getAttr(title,'thumbheight'),
					margins   : getAttr(title,'margins'),
					captions   : getAttr(title,'captions'),
					pinit   : getAttr(title,'pinit'),
					randomize   : getAttr(title,'randomize'),
					opengallerylink   : getAttr(title,'opengallerylink'),
					opengallerytext   : getAttr(title,'opengallerytext'),
					backtostory   : getAttr(title,'backtostory')
                });
            }
        });
		
		
		
		        //add popup
        editor.addCommand('bs3_panel_popup', function(ui, v) {
            //setup defaults
            var ids = '';
            if (v.ids)
                ids = v.ids;
            var rowheight = '';
            if (v.rowheight)
                rowheight = v.rowheight;
            var lastrow = 'nojusstify';
            if (v.lastrow)
                lastrow = v.lastrow;
			
			            var visibleitems = '0';
            if (v.visibleitems)
                visibleitems = v.visibleitems;
				
			            var thumbwidth = '200';
            if (v.thumbwidth)
                thumbwidth = v.thumbwidth;
				
			            var thumbheight = '220';
            if (v.thumbheight)
                thumbheight = v.thumbheight;
				
			            var margins = '5';
            if (v.margins)
                margins = v.margins;
				
			            var captions = 'true';
            if (v.captions)
                captions = v.captions;

							            var pinit = 'true';
            if (v.pinit)
                pinit = v.pinit;
				
							            var randomize = 'false';
            if (v.randomize)
                randomize = v.randomize;
				
										            var opengallerylink = 'true';
            if (v.opengallerylink)
                opengallerylink = v.opengallerylink;
				
										            var opengallerytext = 'OPEN GALLERY';
            if (v.opengallerytext)
                opengallerytext = v.opengallerytext;
											            var backtostory = 'Back to story';
            if (v.backtostory)
                backtostory = v.backtostory;
            //open the popup
            editor.windowManager.open( {
                            title: 'Insert Hercules Gallery Shortcode',
                            body: [
							{
    type: 'button',
	label: 'Select images',
    name: 'selectimagee',
    text: 'Select Images',
								classes: 'my_upload_button',

},{
                            type: 'textbox',
                            name: 'ids',
                            label: 'Selected image ids',
                            value: ids,
                            classes: 'my_input_image',
							disabled: true
                        },

                            {
                                type: 'textbox',
                                name: 'rowheight',
                                label: 'Row height',
								tooltip: 'The preferred height of rows in pixel.',
								value: rowheight
								
                            },{
                                type: 'listbox',
                                name: 'lastrow',
								tooltip: "Decide to justify the last row or not, or to hide the row if it can't be justified.",
                                label: 'Last row',
								value: lastrow, 
                                     'values': [
                                    {text: 'justify', value: 'justify'},
                                    {text: 'no justify', value: 'nojustify'},
									{text: 'center', value: 'center'},
									{text: 'right', value: 'right'},
									{text: 'hide', value: 'hide'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'visibleitems',
                                label: 'Visible images',
								tooltip: 'The number of visible images in the gallery. 0 means all images.',
								value: visibleitems
								
                            },{
                                type: 'textbox',
                                name: 'thumbwidth',
                                label: 'Thumb width',
								tooltip: 'Enter the thumb width.',
								value: thumbwidth
								
                            },{
                                type: 'textbox',
                                name: 'thumbheight',
                                label: 'Thumb height',
								tooltip: 'Enter the thumb height.',
								value: thumbheight
								
                            },{
                                type: 'textbox',
                                name: 'margins',
                                label: 'Margins',
								tooltip: 'Margins between the images.',
                                value: margins
                            },{
                                type: 'listbox',
                                name: 'captions',
								tooltip: 'Decide if you want to show the caption or not.',
                                label: 'Captions',
                                value: captions,
								'values': [
                                    {text: 'true', value: 'true'},
                                    {text: 'false', value: 'false'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'pinit',
								tooltip: 'Enable or disable the PinIt button',
                                label: 'PinIt',
                                value: pinit,
								'values': [
                                    {text: 'true', value: 'true'},
                                    {text: 'false', value: 'false'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'randomize',
								tooltip: 'Automatically randomize or not the order of photos.',
                                label: 'Randomize',
                                values: randomize,
								'values': [
								{text: 'false', value: 'false'},
                                    {text: 'true', value: 'true'}
                                    
                                ]
                            },{
                                type: 'listbox',
                                name: 'opengallerylink',
								tooltip: 'Do you want to display an additional OPEN GALLERY link below the gallery?',
                                label: 'Open gallery link',
                                values: opengallerylink,
								'values': [
								{text: 'true', value: 'true'},
								{text: 'false', value: 'false'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'opengallerytext',
                                label: 'Open gallery text',
								tooltip: 'Change the "OPEN GALLERY" text.',
								value: opengallerytext
								
                            },{
                                type: 'textbox',
                                name: 'backtostory',
                                label: '"Back to story" text',
								tooltip: 'Change the "Back to story" text visible in the lightbox.',
								value: backtostory
								
                            }],
			
                            onsubmit: function( e ) {  
							
                                editor.insertContent( '[hercules-gallery ids="' + e.data.ids + '" rowheight="' + e.data.rowheight + '" lastrow="' + e.data.lastrow + '" visibleitems="' + e.data.visibleitems + '" thumbwidth="' + e.data.thumbwidth + '" thumbheight="' + e.data.thumbheight + '" margins="' + e.data.margins + '" captions="' + e.data.captions + '" pinit="' + e.data.pinit + '" randomize="' + e.data.randomize + '" opengallerylink="' + e.data.opengallerylink + '" opengallerytext="' + e.data.opengallerytext + '" backtostory="' + e.data.backtostory + '"]');
								
                            }
            });
        });
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        editor.addButton( 'HS_Shortcodes', {
            title: 'Insert Shortcode',
			type: 'menubutton',
            icon: 'icon hs-own-icon',
			// Menu
			menu: [
									   
			// Hercules gallery
						   {
                    text: 'Hercules gallery',
                    onclick: function() {
                        editor.windowManager.open( {

                            title: 'Insert Hercules Gallery Shortcode',
                            body: [
							{
    type: 'button',
	label: 'Select images',
    name: 'selectimagee',
    text: 'Select Images',
								classes: 'my_upload_button',

},{
                            type: 'textbox',
                            name: 'ids',
                            label: 'Selected image ids',
                            value: '',
                            classes: 'my_input_image',
							disabled: true
                        },

                            {
                                type: 'textbox',
                                name: 'rowheight',
                                label: 'Row height',
								tooltip: 'The preferred height of rows in pixel.',
								value: '150'
								
                            },{
                                type: 'listbox',
                                name: 'lastrow',
								tooltip: "Decide to justify the last row or not, or to hide the row if it can't be justified.",
                                label: 'Last row',
                                'values': [
                                    {text: 'justify', value: 'justify'},
                                    {text: 'no justify', value: 'nojustify'},
									{text: 'center', value: 'center'},
									{text: 'right', value: 'right'},
									{text: 'hide', value: 'hide'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'visibleitems',
                                label: 'Visible images',
								tooltip: 'The number of visible images in the gallery. 0 means all images.',
								value: '0'
								
                            },{
                                type: 'textbox',
                                name: 'thumbwidth',
                                label: 'Thumb width',
								tooltip: 'Enter the thumb width.',
								value: '220'
								
                            },{
                                type: 'textbox',
                                name: 'thumbheight',
                                label: 'Thumb height',
								tooltip: 'Enter the thumb height.',
								value: '200'
								
                            },{
                                type: 'textbox',
                                name: 'margins',
                                label: 'Margins',
								tooltip: 'Margins between the images.',
                                value: '5'
                            },{
                                type: 'listbox',
                                name: 'captions',
								tooltip: 'Decide if you want to show the caption or not.',
                                label: 'Captions',
                                'values': [
                                    {text: 'true', value: 'true'},
                                    {text: 'false', value: 'false'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'pinit',
								tooltip: 'Enable or disable the PinIt button',
                                label: 'PinIt',
                                'values': [
                                    {text: 'true', value: 'true'},
                                    {text: 'false', value: 'false'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'randomize',
								tooltip: 'Automatically randomize or not the order of photos.',
                                label: 'Randomize',
                                'values': [
								{text: 'false', value: 'false'},
                                    {text: 'true', value: 'true'}
                                    
                                ]
                            },{
                                type: 'listbox',
                                name: 'opengallerylink',
								tooltip: 'Do you want to display an additional OPEN GALLERY link below the gallery?',
                                label: 'Open gallery link',
                                'values': [
								{text: 'true', value: 'true'},
								{text: 'false', value: 'false'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'opengallerytext',
                                label: 'Open gallery text',
								tooltip: 'Change the "OPEN GALLERY" text.',
								value: 'OPEN GALLERY'
								
                            },{
                                type: 'textbox',
                                name: 'backtostory',
                                label: '"Back to story" text',
								tooltip: 'Change the "Back to story" text visible in the lightbox.',
								value: 'Back to story'
								
                            }],
			
                            onsubmit: function( e ) {  
							
                                editor.insertContent( '[hercules-gallery ids="' + e.data.ids + '" rowheight="' + e.data.rowheight + '" lastrow="' + e.data.lastrow + '" visibleitems="' + e.data.visibleitems + '" thumbwidth="' + e.data.thumbwidth + '" thumbheight="' + e.data.thumbheight + '" margins="' + e.data.margins + '" captions="' + e.data.captions + '" pinit="' + e.data.pinit + '" randomize="' + e.data.randomize + '" opengallerylink="' + e.data.opengallerylink + '" opengallerytext="' + e.data.opengallerytext + '" backtostory="' + e.data.backtostory + '"]');
								
                            }
                        });
                    }
                },
				// End hercules gallery
			// Post grid
						   {
                    text: 'Post grid',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Post grid Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'type',
                                label: 'Type of posts',
								tooltip: 'This is the type of posts. Leave blank for posts from Blog'
  
                            },{
                                type: 'textbox',
                                name: 'num',
                                label: 'Columns',
								tooltip: 'Number of posts per row'
  
                            },{
                                type: 'textbox',
                                name: 'rows',
                                label: 'Rows',
								tooltip: 'Number of rows'
  
                            },{
                                type: 'listbox',
                                name: 'orderby',
								tooltip: 'Choose the order by mode.',
                                label: 'Order by',
                                'values': [
                                    {text: 'date', value: 'date'},
                                    {text: 'title', value: 'title'},
									{text: 'popular', value: 'popular'},
									{text: 'random', value: 'random'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'order',
								tooltip: 'Choose the order mode ( from Z to A or from A to Z).',
                                label: 'Order',
                                'values': [
                                    {text: 'DESC', value: 'DESC'},
                                    {text: 'ASC', value: 'ASC'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'thumbwidth',
                                label: 'Image width',
								tooltip: 'Set width for your featured images.'
  
                            },{
                                type: 'textbox',
                                name: 'thumbheight',
                                label: 'Image height',
								tooltip: 'Set height for your featured images.'
  
                            },{
                                type: 'listbox',
                                name: 'meta',
								tooltip: 'Show a post meta?',
                                label: 'Meta',
                                'values': [
                                    {text: 'yes', value: 'yes'},
                                    {text: 'no', value: 'no'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'excerpt',
                                label: 'The number of words in the excerpt',
								tooltip: 'How many words are displayed in the excerpt?'
  
                            },{
                                type: 'listbox',
                                name: 'link',
								tooltip: 'Show link after posts, yes or no.',
                                label: 'Link',
                                'values': [
                                    {text: 'yes', value: 'yes'},
                                    {text: 'no', value: 'no'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'linktxt',
                                label: 'Link Text',
								tooltip: 'Text for the link.'
  
                            },{
                                type: 'textbox',
                                name: 'category',
                                label: 'Which category to pull from? (for Blog posts)',
								tooltip: 'Enter the slug of the category you would like to pull posts from. Leave blank if you would like to pull from all categories.'
  
                            },{
                                type: 'textbox',
                                name: 'customcategory',
                                label: 'Which category to pull from? (for Custom posts)',
								tooltip: 'Enter the slug of the category you would like to pull posts from. Leave blank if you would like to pull from all categories.'
  
                            },{
                                type: 'textbox',
                                name: 'tag',
                                label: 'Posts tag',
								tooltip: 'Enter tags for posts filtering. Leave blank to pull all tags'
  
                            },{
                                type: 'textbox',
                                name: 'classc',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class for posts.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[posts_grid type="' + e.data.type + '" columns="' + e.data.num + '" rows="' + e.data.rows + '" order_by="' + e.data.orderby + '" order="' + e.data.order + '" thumb_width="' + e.data.thumbwidth + '" thumb_height="' + e.data.thumbheight + '" meta="' + e.data.meta + '" excerpt_count="' + e.data.excerpt + '" link="' + e.data.link + '" link_text="' + e.data.linktxt + '" category="' + e.data.category + '" custom_category="' + e.data.customcategory + '" tag="' + e.data.tag + '" custom_class="' + e.data.classc + '"]');
                            }
                        });
                    }
                },
				// End Post grid
			// Elements
			{
                    text: 'Elements',
            menu: [
				{
            		text: 'Spacer', value: '[spacer]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Spacer-small', value: '[spacer-small]', onclick: function() {editor.insertContent(this.value()); }
           		},
				// Intro text
				{
						text   : 'Intro text',
						value  : 'Intro text',
						onclick: function () {
						content = editor.selection.getContent();
							editor.insertContent( '[intro]' + content + '[/intro]');
						}
					},
				// End Intro text
				
				// Text highlight
				{
						text   : 'Text highlight',
						value  : 'Text highlight',
						onclick: function () {
						content = editor.selection.getContent();
							editor.insertContent( '[highlight]' + content + '[/highlight]');
						}
					},
				// End Text highlight
				
// Blockquote
						   {
                    text: 'Blockquote',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Blockquote Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'txt_color',
								value: '',
                                label: 'txt color',
								tooltip: 'Enter the txt color value, example: #222222'
                            },{
                                type: 'textbox',
                                name: 'size',
								value: '',
                                label: 'font size value',
								tooltip: 'Enter the font size value'
                            },{
                                type: 'textbox',
                                name: 'line_height',
								value: '',
                                label: 'font line height value',
								tooltip: 'Enter the font line height value'
                            },{
                                type: 'textbox',
                                name: 'cclass',
                                label: 'custom css class',
								value: '',
								tooltip: 'Enter your custom css class name'
                            }],
                            onsubmit: function(e) {
							content = editor.selection.getContent();
                                editor.insertContent( '[blockquote custom_class="' + e.data.cclass + '" txt_color="' + e.data.txt_color + '" size="' + e.data.size + '" line_height="' + e.data.line_height + '"]' + content + '[/blockquote]');
                            }
                        });
                    }
                },
				// End Blockquote
				
				// Bigletter
						   {
                    text: 'Bigletter',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Bigletter Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'cclass',
                                label: 'custom css class',
								value: '',
								tooltip: 'Enter your custom css class name'
                            }],
                            onsubmit: function(e) {
							content = editor.selection.getContent();
                                editor.insertContent( '[bigletter custom_class="' + e.data.cclass + '"]' + content + '[/bigletter]');
                            }
                        });
                    }
                },
				// End Bigletter
				
				// pullquote
						   {
                    text: 'Pullquote',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Pullquote Shortcode',
                            body: [{
                                type: 'listbox',
                                name: 'align',
								tooltip: 'align',
                                label: 'align',
                                'values': [
                                    {text: 'left', value: 'left'},
                                    {text: 'right', value: 'right'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'style',
								tooltip: 'select style',
                                label: 'style',
                                'values': [
                                    {text: 'default', value: 'default'},
                                    {text: 'style1', value: 'style1'},
									{text: 'style2', value: 'style2'},
									{text: 'style3', value: 'style3'},
									{text: 'style4', value: 'style4'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'width',
                                label: 'width value',
								value: '300',
								tooltip: 'Enter the width value'
                            },{
                                type: 'textbox',
                                name: 'size',
								value: '16',
                                label: 'font size value',
								tooltip: 'Enter the font size value'
                            },{
                                type: 'textbox',
                                name: 'line_height',
								value: '18',
                                label: 'font line height value',
								tooltip: 'Enter the font line height value'
                            },{
                                type: 'textbox',
                                name: 'bg_color',
								value: '#ffffff',
                                label: 'bg color',
								tooltip: 'Enter the bg color value, example: #eeeeee'
                            },{
                                type: 'textbox',
                                name: 'txt_color',
								value: '#222222',
                                label: 'txt color',
								tooltip: 'Enter the txt color value, example: #222222'
                            }],
                            onsubmit: function( e ) {
							content = editor.selection.getContent();
                                editor.insertContent( '[pullquote align="' + e.data.align + '" style="' + e.data.style + '" width="' + e.data.width + '" size="' + e.data.size + '" line_height="' + e.data.line_height + '" bg_color="' + e.data.bg_color + '" txt_color="' + e.data.txt_color + '"]' + content + '[/pullquote]');
                            }
                        });
                    }
                },
				// End pullquote
				
				
				// Skills
		   {
                    text: 'Skills',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Skills Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'val',
                                label: 'Value',
								tooltip: 'Enter the value for circle (%).'
                            },
                            {
                                type: 'textbox',
                                name: 'size',
                                label: 'Size',
								tooltip: 'Enter the size of the circle. Default is 180'
                            },
                            {
                                type: 'textbox',
                                name: 'bg',
                                label: 'Background Color',
								tooltip: 'Enter the Background Color. Default is #f2f2f2'
  
                            },
							{
                                type: 'textbox',
                                name: 'fg',
                                label: 'Foreground Color',
								tooltip: 'Enter the Foreground Color. Default is #000000'
  
                            },{
                                type: 'textbox',
                                name: 'thick',
                                label: 'Thickness',
								tooltip: 'Enter the thickness of the wheel. Default is 27.'
  
                            },{
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
								tooltip: 'Enter the title.'
  
                            },{
                                type: 'textbox',
                                name: 'fm',
                                label: 'Font Family',
								tooltip: 'Enter the Font Family.'
  
                            },{
                                type: 'textbox',
                                name: 'fsize',
                                label: 'Font Size',
								tooltip: 'Enter Font Size.'
  
                            },{
                                type: 'textbox',
                                name: 'fstyle',
                                label: 'Font Style',
								tooltip: 'Enter Font Style.'
  
                            },{
                                type: 'textbox',
                                name: 'cclass',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[skills value="' + e.data.val + '" size="' + e.data.size + '"' + ' bgcolor="' + e.data.bg + '" fgcolor="' + e.data.fg + '" donutwidth="' + e.data.thick + '" title="' + e.data.title + '" font="' + e.data.fm + '" fontsize="' + e.data.fsize + '" fontstyle="' + e.data.fstyle + '" custom_class="' + e.data.cclass + '"][/skills]');
                            }
                        });
                    }
                },
				// End Skills
				// Progressbar
						   {
                    text: 'Progressbar',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Progressbar Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'val',
                                label: 'Value',
								tooltip: 'Enter the value for bar (%).'
                            },
                            {
                                type: 'textbox',
                                name: 'label',
                                label: 'Label',
								tooltip: 'Enter label.'
                            },{
                                type: 'textbox',
                                name: 'cclass',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[progressbar value="' + e.data.val + '" label="' + e.data.label + '" custom_class="' + e.data.cclass + '"]');
                            }
                        });
                    }
                },
				// End Progressbar
				// Drop Cap
						   {
                    text: 'Drop Cap',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Drop Cap Shortcode',
                            body: [{
                                type: 'listbox',
                                name: 'cclass',
								tooltip: 'Choose CSS class.',
                                label: 'Css Class',
                                'values': [
                                    {text: 'normal', value: 'normal'},
                                    {text: 'black', value: 'bl'},
                                    {text: 'white', value: 'wh'},
									{text: 'border right', value: 'whbr'},
									{text: 'border', value: 'whb'}
                                ]
                            }],
                            onsubmit: function( e ) {
							content = editor.selection.getContent();
                                editor.insertContent( '[dropcap custom_class="' + e.data.cclass + '"]'+content+'[/dropcap]');
                            }
                        });
                    }
                },
				// End Drop Cap
				// Button
						   {
                    text: 'Button',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Button Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'btxt',
                                label: 'Button Text',
								tooltip: 'Enter the text for button.'
  
                            },{
                                type: 'textbox',
                                name: 'iconame',
                                label: 'Icon name',
								tooltip: 'Enter the name of the icon. Example: icon-shopping-cart. Complete list of the icons you will find in Documentation/Icons/demo.html file.'
  
                            },{
                                type: 'textbox',
                                name: 'btlink',
                                label: 'Button Link',
								tooltip: 'Enter the link for button. (e.g. http://demolink.org)'
  
                            },{
                                type: 'listbox',
                                name: 'style',
								tooltip: 'Choose button style.',
                                label: 'Style',
                                'values': [
								    {text: 'default', value: 'default'},
                                    {text: 'primary', value: 'primary'},
                                    {text: 'success', value: 'success'},
                                    {text: 'info', value: 'info'},
									{text: 'warning', value: 'warning'},
									{text: 'danger', value: 'danger'},
									{text: 'link', value: 'link'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'size',
								tooltip: 'Choose button size.',
                                label: 'Size',
                                'values': [
                                    {text: 'mini', value: 'xs'},
                                    {text: 'small', value: 'sm'},
                                    {text: 'normal', value: 'normal'},
									{text: 'large', value: 'lg'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'target',
								tooltip: 'The target attribute specifies a window or a frame where the linked document is loaded.',
                                label: 'Target',
                                'values': [
                                    {text: '_blank', value: '_blank'},
                                    {text: '_self', value: '_self'},
                                    {text: '_parent', value: '_parent'},
									{text: '_top', value: '_top'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'display',
								tooltip: 'Choose between inline and block display options.',
                                label: 'Display',
                                'values': [
                                    {text: 'inline', value: 'inline'},
                                    {text: 'block', value: 'block'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'class',
                                label: 'Class',
								tooltip: 'Any CSS classes you want to add'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[button text="' + e.data.btxt + '" link="' + e.data.btlink + '" style="' + e.data.style + '" size="' + e.data.size + '" target="' + e.data.target + '" display="' + e.data.display + '" class="' + e.data.class + '" icon="' + e.data.iconame + '"]');
                            }
                        });
                    }
                },
				// End Button
								// Icon
						   {
                    text: 'Icon',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Iocn Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'iconame',
                                label: 'Icon name',
								tooltip: 'Enter the name of the icon. Example: icon-shopping-cart. Complete list of the icons you will find in Documentation/Icons/demo.html file.'
  
                            },{
                                type: 'listbox',
                                name: 'align',
								tooltip: 'Choose icons align.',
                                label: 'Align',
                                'values': [
                                    {text: 'left', value: 'left'},
                                    {text: 'right', value: 'right'},
                                    {text: 'center', value: 'center'},
									{text: 'none', value: 'none'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'size',
								tooltip: 'Choose icons size.',
                                label: 'Size',
                                'values': [
                                    {text: 'icon-1x', value: 'icon-1x'},
                                    {text: 'icon-2x', value: 'icon-2x'},
                                    {text: 'icon-3x', value: 'icon-3x'},
									{text: 'icon-4x', value: 'icon-4x'},
									{text: 'icon-5x', value: 'icon-5x'},
									{text: 'icon-6x', value: 'icon-6x'},
									{text: 'icon-7x', value: 'icon-7x'},
									{text: 'icon-8x', value: 'icon-8x'},
									{text: 'icon-9x', value: 'icon-9x'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'icocolor',
                                label: 'Icon color',
								tooltip: 'Enter icons color'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[icon icons="' + e.data.iconame + '" align="' + e.data.align + '" size="' + e.data.size + '" color="' + e.data.icocolor + '"]');
                            }
                        });
                    }
                },
				// End Icon
           ]
		   },
		   // End Elements
			// Lists
			{
                    text: 'Lists',
            menu: [
										{
            		text: 'Unstyled', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[list_un]' + content + '[/list_un]'); }
           		},
								{
            		text: 'Check List 1', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[check_list]' + content + '[/check_list]'); }
           		},
							{
            		text: 'Check List 2', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[check2_list]' + content + '[/check2_list]'); }
           		},
						{
            		text: 'Arrow list 1', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[arrow_list]' + content + '[/arrow_list]'); }
           		},
							{
            		text: 'Arrow list 2', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[arrow2_list]' + content + '[/arrow2_list]'); }
           		},
				{
            		text: 'Circle List', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[circle_list]' + content + '[/circle_list]'); }
           		},
				{
            		text: 'Plus List', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[plus_list]' + content + '[/plus_list]'); }
           		},
				{
            		text: 'Minus List', value: '', onclick: function() {content = editor.selection.getContent();editor.insertContent('[minus_list]' + content + '[/minus_list]'); }
           		}
					
           ]
		   },
		   // End Lists
		   		   			// Start Grid
			{
                    text: 'Grid',
            menu: [
				{
            		text: 'container', value: '[container fluid="false" custom_class=""][/container]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'row', value: '[row-b custom_class=""][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-1', value: '[col-md-1][/col-md-1]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-2', value: '[col-md-2][/col-md-2]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-3', value: '[col-md-3][/col-md-3]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-4', value: '[col-md-4][/col-md-4]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-5', value: '[col-md-5][/col-md-5]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-6', value: '[col-md-6][/col-md-6]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-7', value: '[col-md-7][/col-md-7]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-8', value: '[col-md-8][/col-md-8]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-9', value: '[col-md-9][/col-md-9]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-10', value: '[col-md-10][/col-md-10]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-11', value: '[col-md-11][/col-md-11]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'col-md-12', value: '[col-md-12][/col-md-12]', onclick: function() {editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End Grid
		   // Start Grid Examples
			{
                    text: 'Grid Examples',
            menu: [
            	{
            		text: '1/2 - 1/2', value: '[row-b custom_class=""][col-md-6] ... [/col-md-6][col-md-6] ... [/col-md-6][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/3 - 1/3 - 1/3', value: '[row-b custom_class=""][col-md-4] ... [/col-md-4][col-md-4] ... [/col-md-4][col-md-4] ... [/col-md-4][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/3 - 2/3', value: '[row-b custom_class=""][col-md-4] ... [/col-md-4][col-md-8] ... [/col-md-8][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/4 - 1/4 - 1/4 - 1/4', value: '[row-b custom_class=""][col-md-3] ... [/col-md-3][col-md-3] ... [/col-md-3][col-md-3] ... [/col-md-3][col-md-3] ... [/col-md-3][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/4 - 3/4', value: '[row-b custom_class=""][col-md-3] ... [/col-md-3][col-md-9] ... [/col-md-9][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6', value: '[row-b custom_class=""][col-md-2] ... [/col-md-2][col-md-2] ... [/col-md-2][col-md-2] ... [/col-md-2][col-md-2] ... [/col-md-2][col-md-2] ... [/col-md-2][col-md-2] ... [/col-md-2][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/6 - 5/6', value: '[row-b custom_class=""][col-md-2] ... [/col-md-2][col-md-10] ... [/col-md-10][/row-b]', onclick: function() {editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End Grid Examples
		   // Video
		   {
                    text: 'Video',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Video Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'fileURL',
                                label: 'File URL',
								tooltip: 'Enter the url to the video file. YouTube example: http://youtube.com/watch?v=3H8bnKdf654. Vimeo example: http://vimeo.com/9679622'
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[videos file="' + e.data.fileURL + '"][/videos]');
                            }
                        });
                    }
                },
				// End Video
				// Review
				{
            		text: 'Review', value: '[hercules_review id=""]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Review
				// Add image
		   {
                    text: 'Add image',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Add image',
                            body: [
														{
    type: 'button',
	label: 'Select image',
    name: 'selectimagee',
    text: 'Select Image',
								classes: 'selectimage',

},{
                            type: 'textbox',
                            name: 'url',
                            label: 'Selected image',
                            value: '',
                            classes: 'my_input_full_image',
							disabled: true
                        },{
                            type: 'textbox',
                            name: 'id',
							hidden: true,
                            classes: 'my_input_full_image_id'
                        },
						{
                            type: 'textbox',
                            name: 'width',
							hidden: true,
                            classes: 'my_input_full_image_width'
                        },
						{
                            type: 'textbox',
                            name: 'height',
							hidden: true,
                            classes: 'my_input_full_image_height'
                        },{
                                type: 'listbox',
                                name: 'fullwidth',
								tooltip: 'Enable fullwidth mode ?',
                                label: 'Fullwidth',
                                'values': [
                                    {text: 'no', value: 'no'},
                                    {text: 'yes', value: 'yes'}
                                ]
                            }],
                            onsubmit: function( e ) {
							 if ( 'yes' === e.data.fullwidth ) {
							 editor.insertContent( '<div class="fullwidth-image"><img class="alignnone wp-image-' + e.data.id + '" src="' + e.data.url + '" width="' + e.data.width + '" height="' + e.data.height + '" /></div>');
							 }else{
                                editor.insertContent( '<img class="alignnone wp-image-' + e.data.id + '" src="' + e.data.url + '" width="' + e.data.width + '" height="' + e.data.height + '" />');
								}
                            }
                        });
                    }
                },
				// End Add image
				// Table
				{
            		text: 'Table', value: '[table td1="#" td2="Title" td3="Value"] [td1] 1 [/td1] [td2] some title 1 [/td2] [td3] some value 1 [/td3] [/table]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Table
				// Accordion
				{
            		text: 'Accordion', value: '[accordions] [accordion title="title1" visible="yes"] tab content [/accordion] [accordion title="title2"] another content tab [/accordion] [/accordions]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Accordion
				// Tabs
				{
            		text: 'Tabs', value: '[tabs tab1="Title #1" tab2="Title #2" tab3="Title #3"] [tab1] Tab 1 content... [/tab1] [tab2] Tab 2 content... [/tab2] [tab3] Tab 3 content... [/tab3] [/tabs]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Tabs
								// Underline links
				{
						text   : 'Underline links',
						onclick: function () {
						content = editor.selection.getContent();
							editor.insertContent( '[underline]' + content + '[/underline]');
						}
					},
				// End Intro text
		   ] 
//End
        });
    });
})(jQuery);

jQuery(document).ready(function($){
$(document).on('click', '.mce-selectimage', supload_image_tinymce);
  var mediaUploader;
 
  function supload_image_tinymce(e) {
    e.preventDefault();
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
	  var $input_field = $('.mce-my_input_full_image');
	  var $input_id = $('.mce-my_input_full_image_id');
	  var $input_width = $('.mce-my_input_full_image_width');
	  var $input_height = $('.mce-my_input_full_image_height');
      $input_field.val(attachment.url);
	  $input_id.val(attachment.id);
      $input_width.val(attachment.width);
	  $input_height.val(attachment.height);
    });
    // Open the uploader dialog
    mediaUploader.open();
  };





    $(document).on('click', '.mce-my_upload_button', upload_image_tinymce);
 
    function upload_image_tinymce(e) {
        e.preventDefault();
        var input_field = $('.mce-my_input_image');
		
var frame = wp.media.frames.file_frame = wp.media({
title:      'Select images',
multiple : true,
button : { text : 'Select' }
});

frame.on('open', function(){
var imgIDs = input_field.val().split(',');
						var selection = frame.state().get('selection');
						if (imgIDs && imgIDs.length) {
				$.each(imgIDs, function(idx, val) {
					attachment = wp.media.attachment(val);
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : [] );
				});
}
});
					
      frame.on( 'select',function() {
	  var selection = frame.state().get('selection'),
imageIDs = [],
newImages = '';

			selection.map( function( attachment ) { 
				var image = attachment.toJSON();
//imageURL = (image.sizes && image.sizes['thumbnail'])? image.sizes['thumbnail'].url: image.url;
				if (image.id) {
					//newImages += '<div class="image-container" data-imageid="'+image.id+'"><div data-imageid="'+image.id+'" class="image-inner"><img src="'+imageURL+'" /><a class="remove-image" href="#" title=" ">&#61826;</a></div></div>';
					imageIDs.push(image.id);
				}
			});
			if (imageIDs.length) {
				input_field.val(imageIDs.join(','));
				//$input_field.append(newImages);
			} 			
});
        frame.open();
    }
});