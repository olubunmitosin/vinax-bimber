/* global window */
/* global document */
/* global jQuery */
/* global wp */
/* global g1 */
/* global bimber_themecustomizer */
/* global bimber_headerbuilder */

// TODO modularize this into Font Control and Header Builder

/*************
 *
 * Live preview callbacks
 *
 *************/
(function ($) {
    'use strict';

    var config = $.parseJSON(bimber_themecustomizer);

    var getStyle = function (option, mediaQuery, disableAttributes) {
        option = $.parseJSON(option);
        var style = option.selector + '{';
        //handle generic attributes.
        $.each(option, function (index, value) {
            if (index in config.attributes && 'template' in config.attributes[index] && config.attributes[index]['media-query'] === mediaQuery && value !== '') {
                var template = config.attributes[index].template;
                template = template.replace('%val%', value);
                style += template;
            }
        });
        //handle font-family and add if needed.
        if ('font-family' in option && typeof option['font-family'] === 'string'){
            var font        = option['font-family'];
            var fontConfig  = config.fonts[font];
            var link        = '<link rel="stylesheet" id="bimber-google-fonts-customized-css" href="' + fontConfig.css_link + '" type="text/css" media="all">';
            var $container  = $('#bending-cat-google-fonts-live');
            style += 'font-family:' + fontConfig.css_value + ';';
            if ($container.html().indexOf(link) < 0){
                $container.append(link);
            }
        }
        //handle font-style.
        if ('font-style' in option && typeof option['font-style'] === 'string'){
            var fontStyle = option['font-style'];
            fontStyle = fontStyle.replace('regular', '400');
            if(fontStyle.indexOf('italic') > -1){
                fontStyle = fontStyle.replace('italic','');
                style += 'font-style:italic;';
            }
            if(fontStyle.length > 0){
                style += 'font-weight:' + fontStyle + ';';
            }
        }
        style += '}';

        if (mediaQuery === 'desktop') {
            style = '@media only screen and (min-width: 1025px){' + style + '}';
        }
        if (mediaQuery === 'tablet') {
            style = '@media only screen and (min-width: 768px) and (max-width: 1023px){' + style + '}';
        }
        if (mediaQuery === 'mobile') {
            style = '@media only screen and (max-width: 767px){' + style + '}';
        }
        return style;
    };

    var getButtonsFontSizes = function(option) {
        option = $.parseJSON(option);
        var style = '';
        if ('font-size' in option && option['font-size'] > 0) {
            style += getCalculatedButtonsFontSizes(option['font-size']);
        }
        if ('font-size-tablet' in option && option['font-size-tablet'] > 0) {
            style += '@media only screen and (min-width: 768px) and (max-width: 1023px){' + getCalculatedButtonsFontSizes(option['font-size-tablet']) + '}';
        }
        if ('font-size-mobile' in option && option['font-size-mobile'] > 0) {
            style += '@media only screen and (max-width: 767px){' + getCalculatedButtonsFontSizes(option['font-size-mobile']) + '}';
        }
        return style;
    };

    var getCalculatedButtonsFontSizes = function(sizeM) {
        sizeM = parseInt(sizeM, 10);
        var sizeXS = sizeM - 4;
        var sizeS = sizeM - 2;
        var sizeL = sizeM + 2;
        var sizeXL = sizeM + 4;
        var output = '.g1-button-xs{\
                font-size:' + sizeXS + 'px;\
            }\
            .g1-button-s{\
                font-size:' + sizeS + 'px;\
            }\
            .g1-button-m{\
                font-size:' + sizeM + 'px;\
            }\
            .g1-button-l{\
                font-size:' + sizeL + 'px;\
            }\
            .g1-button-xl{\
                font-size:' + sizeXL + 'px;\
        }';
        return output;
    };

/*
    wp.customize('bimber_theme[page_width]', function (value) {
        value.bind(function (newval) {
            var template = '<style type="text/css" media="screen">@media only screen and (min-width: 801px){.g1-row-inner{max-width:' + newval + 'px}}</style>';
            $('#g1-bending-cat-page-width').html(template);
        });
    });
*/
    $.each(config.selectors, function (index, setting) {
        wp.customize('bimber_theme[' + setting + ']', function (value) {
            value.bind(function (newval) {
                var disableAttributes = [];
                if (setting === 'typo_button'){
                    disableAttributes.push('font-size');
                    disableAttributes.push('font-size-tablet');
                    disableAttributes.push('font-size-mobile');
                }
                if ($('#g1-bending-cat-' + setting).length < 1) {
                    $('#bending-cat-customizer').append('<div id="g1-bending-cat-' + setting + '"></div>');
                }
                var template = '<style type="text/css" media="screen">' + getStyle(newval, 'all',disableAttributes) + getStyle(newval, 'desktop',disableAttributes) + getStyle(newval, 'tablet',disableAttributes) + getStyle(newval, 'mobile',disableAttributes);
                if (setting === 'typo_button'){
                    template  += getButtonsFontSizes(newval);
                }
                template  += '</style>';
                $('#g1-bending-cat-' + setting).html(template);
            });
        });
    });

    var generateHeaderPreview = function(values, headerName) {
        var output = '';
        var layout = values[headerName];
        var stickyStarted = false;
        var stickyClosed = false;
        $.each(layout, function(rowIndex,row) {
            if('on' === row.sticky && ! stickyStarted){
                stickyStarted = true;
                output+= '<div class="g1-sticky-top-wrapper g1-hb-row-' + rowIndex + '">';
            }
            if('on' !== row.sticky && stickyStarted && ! stickyClosed){
                stickyClosed = true;
                output+= '</div>';
            }
            var rowLetter = row.letter;
            var rowClass = 'g1-hb-row g1-hb-row-' + headerName + ' g1-hb-row-' + rowLetter + ' g1-hb-' + row.style +  ' g1-hb-row-' + rowIndex;
            if ('on' === row.sticky){
                rowClass+= ' g1-hb-sticky-on';
            } else{
                rowClass+= ' g1-hb-sticky-off';
            }
            if ('on' === row.shadow){
                rowClass+= ' g1-hb-shadow-on';
            } else{
                rowClass+= ' g1-hb-shadow-off';
            }
            output+= '<div class="g1-row g1-row-layout-page '+ rowClass + '"><div class="g1-row-inner"><div class="g1-column g1-dropable">';

            $.each(row.cols, function(colIndex, col){
                var colClass = 'g1-bin-' + colIndex;
                var alignClass = 'g1-bin ' + 'g1-bin-align-' + col.align;
                if ('on' === col.grow){
                    colClass+= ' g1-bin-grow-on';
                } else{
                    colClass+= ' g1-bin-grow-off';
                }
                output+= '<div class="' + colClass + '">';
                output+= '<div class="' + alignClass + '">';
                col.elements.forEach(function(element) {
                    var elementHTML = $('#g1-hb-preview-elements .g1-hb-preview-element-' + element)[0].innerHTML;
                    output+= elementHTML;
                });
                output+= '</div>';
                output+= '</div>';
            });

            output+= '</div></div><div class="g1-row-background"></div></div>';
        });
        if (stickyStarted && ! stickyClosed){
            stickyClosed = true;
            output+= '</div>';
        }
        $('#g1-hb-preview-elements').after(output);
    };

    var generateCanvasPreview = function(values) {
        $('.g1-canvas-content').html('');
        var layout = values['canvas'];
        var output = '<a class="g1-canvas-toggle" href="#"></a>';
        $.each(layout[1]['cols'][1]['elements'], function(elementIndex, element) {
            var elementHTML = $('#g1-hb-preview-elements-canvas .g1-hb-preview-canvas-element-' + element)[0].innerHTML;
            output+= elementHTML;
        });
        $('.g1-canvas-content').html(output);
        g1.canvas();
    };

    wp.customize('bimber_theme[header_builder]', function (value) {
        value.bind(function (newval) {
            if (typeof newval === 'undefined' || newval === 'workaround'){
                return;
            }
            $('.g1-hb-row').remove();
            $('.g1-sticky-top-wrapper').remove();
            generateHeaderPreview(newval, 'normal');
            generateHeaderPreview(newval, 'mobile');
            generateCanvasPreview(newval);
        });
    });

    var setupRowRefresh = function(rowLetter) {
        var rowSettings = [
            'header_builder_' + rowLetter +'_text_color',
            'header_builder_' + rowLetter +'_accent_color',
            'header_builder_' + rowLetter +'_background_color',
            'header_builder_' + rowLetter +'_gradient_color',
            'header_builder_' + rowLetter +'_border_color',
            'header_builder_' + rowLetter +'_button_background',
            'header_builder_' + rowLetter +'_button_text'
        ];
        $.each(rowSettings, function (index, setting) {
            wp.customize('bimber_theme[' + setting + ']', function (value) {
                value.bind(function (newval) {
                    refreshRowCSS(rowLetter);
                });
            });
        });
    }
    setupRowRefresh('a');
    setupRowRefresh('b');
    setupRowRefresh('c');

    var refreshRowCSS = function(rowLetter) {
        var customizerValues = wp.customize.get();
        var text       		    = customizerValues['bimber_theme[header_builder_' + rowLetter + '_text_color]'];
	    var accent  	   		= customizerValues['bimber_theme[header_builder_' + rowLetter + '_accent_color]'];
	    var background       	= customizerValues['bimber_theme[header_builder_' + rowLetter + '_background_color]'];
	    var gradient       	    = customizerValues['bimber_theme[header_builder_' + rowLetter + '_gradient_color]'];
	    var border	       	    = customizerValues['bimber_theme[header_builder_' + rowLetter + '_border_color]'];
	    var button_bg       	= customizerValues['bimber_theme[header_builder_' + rowLetter + '_button_background]'];
        var button_text     	= customizerValues['bimber_theme[header_builder_' + rowLetter + '_button_text]'];

        var newCSS = '/*customizer_preview_' + rowLetter + '_row*/';

        newCSS += ' .g1-hb-row-' + rowLetter + ' .menu-item > a,\
                    .g1-hb-row-' + rowLetter + ' .g1-hamburger,\
                    .g1-hb-row-' + rowLetter + ' .g1-drop-toggle,\
                    .g1-hb-row-' + rowLetter + ' .g1-socials-item-link{\
                    color:' + text+ ';\
                    }';

        newCSS += '.g1-hb-row-' + rowLetter + ' .g1-row-background {';
        if(border) {
            newCSS += ' border-bottom: 1px solid  ' + text+ ';\
                        border-color: ' + border + ';';
        }
        newCSS += 'background-color: ' + background + ';';

        if(gradient) {
            newCSS += ' background-image: -webkit-linear-gradient(to right, ' + background + ', ' + gradient + ');\
                        background-image:    -moz-linear-gradient(to right, ' + background + ', ' + gradient + ');\
                        background-image:      -o-linear-gradient(to right, ' + background + ', ' + gradient + ');\
                        background-image:         linear-gradient(to right, ' + background + ', ' + gradient + ');';
        }
        newCSS += '}'

        newCSS += ' .g1-hb-row-' + rowLetter + ' .menu-item:hover > a,\
                    .g1-hb-row-' + rowLetter + ' .current-menu-item > a,\
                    .g1-hb-row-' + rowLetter + ' .current-menu-ancestor > a,\
                    .g1-hb-row-' + rowLetter + ' .menu-item-object-post_tag > a:before,\
                    .g1-hb-row-' + rowLetter + ' .g1-socials-item-link:hover {\
                    color:' + accent + ';\
                    }';

        newCSS += ' .g1-hb-row-' + rowLetter + ' .g1-drop-toggle-badge,\
                    .g1-hb-row-' + rowLetter + ' .snax-button-create,\
                    .g1-hb-row-' + rowLetter + ' .snax-button-create:hover {\
                    border-color: ' + button_bg + ';\
                    background-color: ' + button_bg + ';\
                    color: ' + button_text + ';\
                    }';

        newCSS += '/*customizer_preview_' + rowLetter + '_row_end*/';

        var $style = $('#g1-dynamic-styles');
        var regEx = new RegExp('\/\\*customizer_preview_' + rowLetter + '_row.*customizer_preview_' + rowLetter + '_row_end\\*\/', 's');
        $style.html($style.html().replace(regEx,newCSS));
    };

    var submenuSettings = [
        'header_submenu_background_color',
        'header_submenu_text_color',
        'header_submenu_accent_color',
    ];
    $.each(submenuSettings, function (index, setting) {
        wp.customize('bimber_theme[' + setting + ']', function (value) {
            value.bind(function (newval) {
                refreshSubmenuCSS();
            });
        });
    });

    var refreshSubmenuCSS = function() {
        var customizerValues = wp.customize.get();

        var text       		    = customizerValues['bimber_theme[header_submenu_text_color]'];
        var accent  	   		= customizerValues['bimber_theme[header_submenu_accent_color]'];
        var background       	= customizerValues['bimber_theme[header_submenu_background_color]'];

        var newCSS = '/*customizer_preview_submenu*/';

        newCSS += ' .g1-hb-row .sub-menu {\
            border-color: ' + background + ';\
            background-color: ' + background + ';\
        }';

        newCSS += '.g1-hb-row .sub-menu .menu-item > a {\
            color: ' + text + ';\
        }';

        newCSS += '.g1-hb-row .g1-link-toggle {\
            color: ' + background + ';\
        }';

        newCSS += ' .g1-hb-row .sub-menu .menu-item:hover > a,\
                    .g1-hb-row .sub-menu .current-menu-item > a,\
                    .g1-hb-row .sub-menu .current-menu-ancestor > a {\
                        color: ' + accent + ';\
        }';

        newCSS += '/*customizer_preview_submenu_row_end*/';

        var $style = $('#g1-dynamic-styles');
        var regEx = new RegExp('\/\\*customizer_preview_submenu.*customizer_preview_submenu_row_end\\*\/', 's');
        $style.html($style.html().replace(regEx,newCSS));
    };

    var marginSettings = [
        'header_mobile_logo_margin_top',
        'header_mobile_logo_margin_bottom',
        'header_logo_margin_top',
        'header_logo_margin_bottom',
        'header_quicknav_margin_top',
        'header_quicknav_margin_bottom',
        'header_primary_nav_margin_top',
        'header_primary_nav_margin_bottom',
    ];
    $.each(marginSettings, function (index, setting) {
        wp.customize('bimber_theme[' + setting + ']', function (value) {
            value.bind(function (newval) {
                refreshMarginCSS();
            });
        });
    });

    var refreshMarginCSS = function() {
        var customizerValues = wp.customize.get();

        var logoTop     		= customizerValues['bimber_theme[header_logo_margin_top]'];
        var logoBottom 	   		= customizerValues['bimber_theme[header_logo_margin_bottom]'];
        var mobileLogoTop     	= customizerValues['bimber_theme[header_mobile_logo_margin_top]'];
        var mobileLogoBottom 	= customizerValues['bimber_theme[header_mobile_logo_margin_bottom]'];
        var quicknavTop       	= customizerValues['bimber_theme[header_quicknav_margin_top]'];
        var quicknavBottom     	= customizerValues['bimber_theme[header_quicknav_margin_bottom]'];
        var primarynavTop       = customizerValues['bimber_theme[header_primary_nav_margin_top]'];
        var primarynavBottom    = customizerValues['bimber_theme[header_primary_nav_margin_bottom]'];

        var newCSS = '/*customizer_preview_margins*/';

        if (logoTop === 0) {
            newCSS += ' .g1-hb-row-normal .g1-id ,\
                .g1-header .g1-id {\
                    margin-top: 0;\
                }';
       }

       if (logoBottom === 0) {
            newCSS += ' .g1-hb-row-normal  .g1-id ,\
                .g1-header .g1-id {\
                    margin-bottom: 0;\
                }';
        }

        if (mobileLogoTop === 0) {
            newCSS += ' .g1-hb-row-mobile .g1-id ,\
                .g1-header .g1-id {\
                    margin-top: 0;\
                }';
       }

       if (mobileLogoBottom === 0) {
            newCSS += '.g1-hb-row-mobile  .g1-id ,\
                .g1-header .g1-id {\
                    margin-bottom: 0;\
                }';
        }

        newCSS += ' .g1-hb-row-mobile  .g1-id ,\
        .g1-header .g1-id {\
            margin-top: '+ mobileLogoTop +'px;\
            margin-bottom: '+ mobileLogoBottom +'px;\
        }';

        newCSS += ' .g1-hb-row-normal  .g1-primary-nav {\
            margin-top: '+ primarynavTop +'px;\
            margin-bottom: '+ primarynavBottom +'px;\
        }';

        newCSS += ' @media only screen and ( min-width: 801px ) {\
                .g1-hb-row-normal  .g1-id ,\
                .g1-header .g1-id {\
                    margin-top: '+ logoTop +'px;\
                    margin-bottom: '+ logoBottom +'px;\
                }\
                .g1-hb-row  .g1-quick-nav ,\
                .g1-header .g1-quick-nav {\
                    margin-top: '+ quicknavTop +'px;\
                    margin-bottom: '+ quicknavBottom +'px;\
                }\
            }'

        newCSS += '/*customizer_preview_margins_end*/';
        var $style = $('#g1-dynamic-styles');
        var regEx = new RegExp('\/\\*customizer_preview_margins.*customizer_preview_margins_end\\*\/', 's');
        $style.html($style.html().replace(regEx,newCSS));
    };


    var elementsSettings = {
        'header_builder_element_label_mobile_menu' : '.g1-hamburger-label',
        'header_builder_element_size_create_button' : '.snax-button-create',
        'header_builder_element_size_search' : '.g1-hb-row .g1-hb-search-form',
        'header_builder_element_size_search_dropdown' : '.g1-drop-the-search',
        'header_builder_element_size_mobile_menu' : '.g1-hamburger',
        'header_builder_element_size_social_icons_full' : '.g1-socials-hb-list, .g1-socials-items-tpl-grid',
        'header_builder_element_size_social_icons_dropdown'  : '.g1-drop-the-socials',
        'header_builder_element_size_user_menu' : '.g1-drop-the-user',
        'header_builder_element_size_cart' : '.g1-drop-the-cart',
        'header_builder_element_size_newsletter' : '.g1-drop-the-newsletter'
    };
    $.each(elementsSettings, function (index, selector) {
        wp.customize('bimber_theme[' + index + ']', function (value) {
            value.bind(function (newval) {
                $(selector).removeClass('g1-hamburger-label-hidden g1-hamburger-s g1-hamburger-m g1-socials-s g1-form-s g1-drop-l g1-drop-s g1-drop-m g1-button-m g1-button-s');
                if (newval !== 'standard') {
                    $(selector).addClass(newval);
                }
            });
        });
    });

    elementsSettings = {
        'header_builder_element_type_search_dropdown' : '.g1-drop-the-search',
        'header_builder_element_type_social_icons_dropdown'  : '.g1-drop-the-socials',
        'header_builder_element_type_user_menu' : '.g1-drop-the-user',
        'header_builder_element_type_cart' : '.g1-drop-the-cart',
        'header_builder_element_type_newsletter' : '.g1-drop-the-newsletter'
    };
    $.each(elementsSettings, function (index, selector) {
        wp.customize('bimber_theme[' + index + ']', function (value) {
            value.bind(function (newval) {
                $(selector).removeClass('g1-drop-icon g1-drop-text');
                if (newval !== 'standard') {
                    $(selector).addClass(newval);
                }
            });
        });
    });


    var canvasSettings = [
    'header_builder_canvas_text_color',
	'header_builder_canvas_accent_color',
	'header_builder_canvas_background_color',
	'header_builder_canvas_gradient_color',
	'header_builder_canvas_background_image',
	'header_builder_canvas_background_repeat',
	'header_builder_canvas_background_size',
    'header_builder_canvas_background_opacity',
    'header_builder_canvas_button_background',
    'header_builder_canvas_button_text',
    'header_builder_canvas_background_position',
    ];
    $.each(canvasSettings, function (index, setting) {
        wp.customize('bimber_theme[' + setting + ']', function (value) {
            value.bind(function (newval) {
                refreshCanvasCSS();
            });
        });
    });
    var refreshCanvasCSS = function() {
        var customizerValues = wp.customize.get();
        var textColor = customizerValues['bimber_theme[header_builder_canvas_text_color]'];
        var accentColor = customizerValues['bimber_theme[header_builder_canvas_accent_color]'];
        var bgColor = customizerValues['bimber_theme[header_builder_canvas_background_color]'];
        var gradientColor = customizerValues['bimber_theme[header_builder_canvas_gradient_color]'];
        var bgImage = customizerValues['bimber_theme[header_builder_canvas_background_image]'];
        var bgRepeat = customizerValues['bimber_theme[header_builder_canvas_background_repeat]'];
        var bgSize = customizerValues['bimber_theme[header_builder_canvas_background_size]'];
        var bgOpacity = customizerValues['bimber_theme[header_builder_canvas_background_opacity]'];
        var buttonBg = customizerValues['bimber_theme[header_builder_canvas_button_background]'];
        var buttonText = customizerValues['bimber_theme[header_builder_canvas_button_text]'];
        var bgPosition = customizerValues['bimber_theme[header_builder_canvas_background_position]'];

        var newCSS = '/*customizer_preview_canvas*/';

        newCSS += ' .g1-canvas-content,\
                    .g1-canvas-toggle,\
                    .g1-canvas-content .menu-item > a,\
                    .g1-canvas-content .g1-hamburger,\
                    .g1-canvas-content .g1-drop-toggle,\
                    .g1-canvas-content .g1-socials-item-link{\
                        color:'+ textColor + '\
                    }';

        newCSS +=  '.g1-canvas-content .menu-item:hover > a,\
                    .g1-canvas-content .current-menu-item > a,\
                    .g1-canvas-content .current-menu-ancestor > a,\
                    .g1-canvas-content .menu-item-object-post_tag > a:before,\
                    .g1-canvas-content .g1-socials-item-link:hover {\
                        color:'+ accentColor + '\
                    }';

        newCSS +=  '.g1-canvas-global {\
                        background-color: '+ bgColor + ';';
        if (gradientColor) {
            newCSS +=  'background-image: -webkit-linear-gradient(to bottom, '+ bgColor + ', '+ gradientColor + ');\
                        background-image:    -moz-linear-gradient(to bottom, '+ bgColor + ', '+ gradientColor + ');\
                        background-image:      -o-linear-gradient(to bottom, '+ bgColor + ', '+ gradientColor + ');\
                        background-image:         linear-gradient(to bottom, '+ bgColor + ', '+ gradientColor + ');';
        }
        newCSS += '}';

        newCSS +=  '.g1-canvas-background {';
        if (bgImage) {
            newCSS +=  'background-image: 	url('+ bgImage + ');\
                        background-size: 	'+ bgSize + ';\
                        background-repeat: 	'+ bgRepeat + ';\
                        background-position: '+ bgPosition + ';';
        }
        newCSS +=  'opacity: '+ bgOpacity * 0.01 + ';';
        newCSS += '}';

        newCSS += '.g1-canvas-content .snax-button-create {\
            border-color: '+ buttonBg + ';\
            background-color: '+ buttonBg + ';\
            color: '+ buttonText + ';\
        }';

        newCSS += '/*customizer_preview_canvas_end*/';

        var $style = $('#g1-dynamic-styles');
        var regEx = new RegExp('\/\\*customizer_preview_canvas.*customizer_preview_canvas_end\\*\/', 's');
        $style.html($style.html().replace(regEx,newCSS));
    };


    var footerSettings = [
	'footer_cs_1_background_color',
	'footer_cs_1_gradient_color',
	'footer_cs_1_background_image',
	'footer_cs_1_background_repeat',
	'footer_cs_1_background_size',
    'footer_cs_1_background_opacity',
    'footer_cs_1_background_position'
    ];
    $.each(footerSettings, function (index, setting) {
        wp.customize('bimber_theme[' + setting + ']', function (value) {
            value.bind(function (newval) {
                refreshFooterCSS();
            });
        });
    });
    var refreshFooterCSS = function() {
        var customizerValues = wp.customize.get();
        var bgColor = customizerValues['bimber_theme[footer_cs_1_background_color]'];
        var gradientColor = customizerValues['bimber_theme[footer_cs_1_gradient_color]'];
        var bgImage = customizerValues['bimber_theme[footer_cs_1_background_image]'];
        var bgRepeat = customizerValues['bimber_theme[footer_cs_1_background_repeat]'];
        var bgSize = customizerValues['bimber_theme[footer_cs_1_background_size]'];
        var bgOpacity = customizerValues['bimber_theme[footer_cs_1_background_opacity]'];
        var bgPosition = customizerValues['bimber_theme[footer_cs_1_background_position]'];

        var newCSS = '/*customizer_preview_footer*/';
        newCSS +=  '.g1-prefooter {\
            background-color: ' + bgColor + ';';
            if (gradientColor) {
                newCSS += ' background-image: -webkit-linear-gradient(to right, ' + bgColor + ', ' + gradientColor + ');\
                            background-image:    -moz-linear-gradient(to right, ' + bgColor + ', ' + gradientColor + ');\
                            background-image:      -o-linear-gradient(to right, ' + bgColor + ', ' + gradientColor + ');\
                            background-image:         linear-gradient(to right, ' + bgColor + ', ' + gradientColor + ');';
            }
        newCSS += '}';

        newCSS +=  '.g1-prefooter > .g1-row-background,\
                    .g1-prefooter .g1-current-background {\
	                 background-color: transparent;';
		if (bgImage) {
            newCSS +=  'background-image: 	url(' + bgImage + ');\
		            	background-size: 	' + bgSize + ';\
			            background-repeat: 	' + bgRepeat + ';\
			            background-position: ' + bgPosition + ';';
        }
        newCSS +=  'opacity: ' + bgOpacity * 0.01 + ';\
                    }';

        newCSS += '/*customizer_preview_footer_end*/';

        var $style = $('#g1-dynamic-styles');
        var regEx = new RegExp('\/\\*customizer_preview_footer.*customizer_preview_footer_end\\*\/', 's');
        $style.html($style.html().replace(regEx,newCSS));
    };

    $(document).ready(function() {
        wp.customize.preview.bind( 'bimber-try-opening-canvas', function() {
            g1.canvasInstance.open();
        } );
        wp.customize.preview.bind( 'bimber-try-closing-canvas', function() {
            g1.canvasInstance.close();
        } );
    });
})(jQuery);
