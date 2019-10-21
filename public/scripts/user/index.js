let table, user, status;

$(document).ready(function () {
	table = $('#users').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "user/api/list",
			type: "POST",
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
			}
		},
		columnDefs: [
			{
				targets: [0],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [1],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [2],
				className: 'text-center',
				render: function(data, type, row) {
					if (parseInt(data) === 0) {
						return '<span class="badge badge-secondary">なし</span>';
					}
					return '<a href="licenses/view/' + data + '" class="badge badge-primary">BBBBB</a>';
				},
				orderable: false
			},
			{
				targets: [3],
				className: 'text-center',
				render: function(data, type, row) {
					if (parseInt(data) === 1) {
						return '<i class="ti-check text-success"></i>';
					}
					return '<i class="ti-close text-danger"></i>';
				},
				orderable: false
			},
			{
				targets: [4],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [5],
				className: 'text-center',
				orderable: false
			},
			{
				targets: [6],
				className: 'text-center',
				render: function(data, type, row) {
					let buffer = '<input type="hidden" value="' + row[7] + '" />';
					if (parseInt(row[3]) === 1) {
						buffer += ('<button type="button" class="btn btn-sm btn-secondary mr-1" onclick="modifyUser(this, ' + row[3] + ')">無効にする</button>');
					} else {
						buffer += ('<button type="button" class="btn btn-sm btn-success mr-1" onclick="modifyUser(this, ' + row[3] + ')">有効にする</button>');
					}
					buffer += ('<button type="button" class="btn btn-sm btn-primary mr-1" onclick="changePass(this)">パスワード変更</button>');
					if (parseInt(row[2]) === 0) {
						buffer += ('<button type="button" class="btn btn-sm btn-warning" onclick="generate(this)">ライセンス生成</button>');
					}
					return buffer;
				},
				orderable: false
			}
		],
		language: {
			"decimal":        ",",
			"emptyTable":     "テーブルにデータがありません",
			"info":           " _TOTAL_ 件中 _START_ から _END_ まで表示",
			"infoEmpty":      " 0 件中 0 から 0 まで表示",
			"infoFiltered":   "（全 _MAX_ 件より抽出）",
			"infoPostFix":    "",
			"lengthMenu":     "_MENU_ 件表示",
			"loadingRecords": "読み込み中...",
			"processing":     "処理中...",
			"search":         "検索:",
			"zeroRecords":    "一致するレコードがありません",
			"paginate": {
				"first":      "先頭",
				"last":       "最終",
				"next":       "次",
				"previous":   "前"
			},
			"aria": {
				"sortAscending":  ": 列を昇順に並べ替えるにはアクティブにする",
				"sortDescending": ": 列を降順に並べ替えるにはアクティブにする"
			}
		}
	});
});

function modifyUser(obj, value) {
	user  = obj.previousElementSibling.value;
	status = 1 - parseInt(value);
	
	$.post(
		'user/api/update',
		{
			id    : user,
			status: status
		},
		function (respond) {
			table.ajax.reload( null, false );
			swal({
				title: "変更成功!",
				icon: "success",
				timer: 3000
			});
		}
	);
}

function changePass(obj) {
	user = obj.previousElementSibling.previousElementSibling.value;
	
	$("#userid").val(user);
	
	$("#passwordModal").modal();
}

function generate(obj) {
	user  = obj.previousElementSibling.previousElementSibling.previousElementSibling.value;
	console.log(user);
}

function changePassAction() {

}