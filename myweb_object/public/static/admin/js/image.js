$(function() {
	$("#file_upload").uploadify({
		swf           : swf,
		uploader      : image_upload_url,
		'buttonText' : '请上传',
		'buttonClass' : 'some-class',
		'width'    : 100,
		'fileTypeDesc' : 'Image files',
		'fileObjName' : 'file',
		'fileTypeExts' : '*.gif; *.jpg; *.png',
		'onUploadSuccess' : function(file, data, response) {
            if(response){
            	var obj = JSON.parse(data);
            	$("#upload_org_code_img").attr('src',obj.data);
            	$("#file_upload_image").attr('value',obj.data);
            	$("#upload_org_code_img").show();
            }
        }
	});
});
