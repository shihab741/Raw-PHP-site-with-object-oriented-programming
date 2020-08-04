/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'imageuploader';
	
	
	config.filebrowserBrowseUrl = 'admin/ckeditor/plugins/imageuploader/imgbrowser.php';
	config.filebrowserImageBrowseUrl = 'http://shihab-info.byethost7.com/oop-php/admin/ckeditor/plugins/imageuploader/imgbrowser.php?type=Images';
	//config.filebrowserFlashBrowseUrl = '/ckfinder/ckfinder.html?type=Flash';
};
