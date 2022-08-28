$(document.body).on("submit", ".auth-action", function (e) {
	e.preventDefault();
	const element = $(this);
	const url = element.data("action-url");
	const btnName = element.data("btn-name");
	const data = new FormData(this);
	setLoading(".btn-submit", "Loading...");
	reqFormData(url, "POST", data, (err, response) => {
		removeFormError();
		if (response) {
			if (!$.isEmptyObject(response.errors)) {
				errorHandler(response.errors);
			} else {
				if (response.success) {
					switch (response.type) {
						case "login":
							if (response.role !== "member") {
								localStorage.setItem("menu", ".dashboard");
								localStorage.setItem("currentUrl", response.currentUrl);
								window.location = response.redirect;
							}
							break;
						case "send-link-forgot":
							swal("Sukses", "Link reset password berhasil dikirim", "success");
							break;
						case "reset-password":
							swal("Sukses", "Password berhasil di reset", "success");
							localStorage.setItem("menu", ".dashboard");
							localStorage.setItem("currentUrl", response.currentUrl);
							window.location = response.redirect;
							break;
					}
				} else {
					swal("Error", "Terjadi kesalahan", "error");
				}
			}

			setFinish(".btn-submit", btnName);
		} else {
			console.log("Error: ", err);
		}
	});
});
