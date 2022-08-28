$(document.body).on("click", ".action-delete", function (e) {
	const el = $(this);
	const url = el.data("url");
	const message = el.data("message");
	swal(
		{
			title: "Hapus",
			text: message,
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Ya, Hapus!",
			closeOnConfirm: false,
		},
		function () {
			reqJson(url, "GET", {}, (err, response) => {
				if (response) {
					if (!$.isEmptyObject(response.errors)) {
						swal("Oops..!", response.errors, "error");
					} else {
						swal.close();
						row = el.closest("tr");
						row.fadeOut(200, function () {
							el.remove();
						});
					}
				} else {
					console.log("Error: ", err);
				}
			});
		}
	);
});

$(document.body).on("submit", ".action-create-formdata", function (e) {
	e.preventDefault();
	const el = $(this);
	const url = el.data("action-url");
	const data = new FormData(this);

	const btnName = $(".btn-submit").html();
	setLoading(".btn-submit", "Loading...");

	reqFormData(url, "POST", data, (err, response) => {
		if (response) {
			removeFormError();
			if ($.isEmptyObject(response.errors)) {
				swal("Sukses", response.message, "success");
				this.reset();
			} else {
				errorHandler(response.errors);
			}

			setFinish(".btn-submit", btnName);
		} else {
			console.log("Error: ", err);
		}
	});
});

$(document.body).on("submit", ".action-update-formdata", function (e) {
	e.preventDefault();
	const el = $(this);
	const url = el.data("action-url");
	const data = new FormData(this);
	const redirect = el.data("redirect");
	const classTarget = el.data("class-target");

	const btnName = $(".btn-submit").html();
	setLoading(".btn-submit", "Loading...");

	reqFormData(url, "POST", data, (err, response) => {
		if (response) {
			removeFormError();

			if ($.isEmptyObject(response.errors)) {
				swal("Sukses", response.message, "success");
				if (redirect && classTarget) {
					loadView(redirect, classTarget);
				}
			} else {
				errorHandler(response.errors);
			}

			setFinish(".btn-submit", btnName);
		} else {
			console.log("Error: ", err);
		}
	});
});

const formSelect = (target = ".select") => {
	if ($(target).length > 0) {
		$(target).selectpicker();

		$(target).on("change", function () {
			if ($(this).val() === "" || null === $(this).val()) {
				if (!$(this).attr("multiple"))
					$(this)
						.val("")
						.find("option")
						.removeAttr("selected")
						.prop("selected", false);
			} else {
				$(this)
					.find("option[value=" + $(this).val() + "]")
					.attr("selected", true);
			}
		});
	}
};
