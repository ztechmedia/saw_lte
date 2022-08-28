const logoutHandler = () => {
	localStorage.removeItem("menu");
	localStorage.removeItem("submenu");
	localStorage.removeItem("currentUrl");
	localStorage.removeItem("prevUrl");
	localStorage.removeItem("sidebar");
};

$(".action-logout").on("click", function (e) {
	const element = $(this);
	const url = element.data("url");
	swal(
		{
			title: "Logout",
			text: "Yakin ingin keluar aplikasi ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Ya, Keluar!",
			closeOnConfirm: false,
		},
		function () {
			reqJson(url, "GET", {}, (err, response) => {
				if (response.success) {
					localStorage.removeItem("training");
					swal.close();
					logoutHandler();
					setTimeout(() => {
						window.location = response.redirect;
					}, 500);
				} else {
					console.log("Error: ", err);
				}
			});
		}
	);
});
