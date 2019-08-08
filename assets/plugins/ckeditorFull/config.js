/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    config.language = 'pt-br';
    // config.uiColor = '#367FA9';
    // config.resize_enabled = false;

    config.removeButtons = 'NewPage,About,Scayt,Save,Flash,Iframe,Language,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,HorizontalRule,Smiley,PageBreak,ShowBlocks';
    config.removePlugins = "elementspath,wsc,scayt";
};
