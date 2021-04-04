/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//http://[tên miền của bạn]/ckfinder/ckfinder.html’
	config.filebrowserBrowseUrl = location.origin +'/public/admin/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = location.origin +'/public/admin/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = location.origin +'/public/admin/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = location.origin +'/public/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = location.origin +'/public/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = location.origin +'/public/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
