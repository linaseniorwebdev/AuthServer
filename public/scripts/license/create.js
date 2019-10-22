
$(document).ready(function() {

});

$("#users").change(function() {
	$("#userid").val($(this).val());
});

$("#generate").click(function() {
	let userid = $("#userid").val();
	
	if (userid.length < 1) { return; }
	
	$.post(
		$("#baseurl").val(),
		{
			userid : userid
		},
		function (respond) {
			respond = JSON.parse(respond);
			$("#license").val(respond.hash);
			swal("", "ライセンスを生成しました。保存してください。", "success");
		}
	);
});