$("#wrapper #page-wrapper .container-fluid .row .col-md-12 .white-box .table-responsive .table tbody tr td .logout").click(function(){
	var rec = $(this).attr('data');
	var me = $(this);
	$.post('php/change.php',{record:rec},function(data){
		if(data == '1'){
			me.parent().html('LOGOUT');
			alert("Changes Successfully Updated.");
		}else{
			alert("Changes Failed to Update!.");
		}
	})
});