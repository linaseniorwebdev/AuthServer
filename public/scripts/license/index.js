let table;

$(document).ready(function () {
	table = $('#licenses').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		autoWidth: false,
		order: [],
		ajax: {
			url : "licenses/api/list",
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
				orderable: false
			},
			{
				targets: [6],
				className: 'text-center',
				render: function(data, type, row) {
					return '';
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
