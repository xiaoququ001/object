
function myweb_app(form){
	var data = $(form).serialize();

	// console.log(data);
	url = $(form).attr('url');
	$.post(url,data,function(res){
		if(res.code==0){
			layer.msg(res.msg,{icon:5,time:2000});
		}else if(res.code==1){
			self.location = res.data.jump_url;
		}
	},'JSON');
}