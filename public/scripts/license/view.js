
function remove(url) {
	swal({
		title: "本気ですか？",
		icon: "info",
		buttons: {
			cancel: {
				text: "いいえ",
				value: null,
				visible: true,
				className: "",
				closeModal: true,
			},
			confirm: {
				text: "はい",
				value: true,
				visible: true,
				className: "",
				closeModal: false
			}
		}
	}).then(isConfirm => {
		if (isConfirm) {
			location.href = url;
		}
	});
}