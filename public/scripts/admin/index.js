let table;

$(document).ready(function () {
	table = $('#admins').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "admin/api/list",
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
					if (parseInt(data) === 1) {
						return '<i class="ti-check text-success"></i>';
					}
					return '<i class="ti-close text-danger"></i>';
				},
				orderable: false
			},
			{
				targets: [3],
				className: 'text-center',
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
				render: function(data, type, row) {
					let buffer = '<input type="hidden" value="' + row[6] + '" />';
					if (parseInt(row[2]) === 1) {
						buffer += ('<button type="button" class="btn btn-sm btn-secondary mr-1" onclick="modifyAdmin(this, ' + row[2] + ')">無効にする</button>');
					} else {
						buffer += ('<button type="button" class="btn btn-sm btn-success mr-1" onclick="modifyAdmin(this, ' + row[2] + ')">有効にする</button>');
					}
					buffer += ('<button type="button" class="btn btn-sm btn-primary" onclick="changePass(this)">パスワード変更</button>');
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

function modifyAdmin(obj, value) {
	console.log(obj.previousElementSibling.value);
	console.log(value);
}

function changePass(obj) {
	console.log(obj.previousElementSibling.previousElementSibling.value)
}