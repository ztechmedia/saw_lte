const setLoading = (className, text = null) => {
	$(className).attr("disabled", "disabled");
	$(className).html(text);
};

const setFinish = (className, text = null) => {
	$(className).removeAttr("disabled", "disabled");
	$(className).html(text);
};

const loading = (target = ".content-admin") => {
	$(target).html(
		'<div class="content-wrapper">' +
		'<div class="row">' +
		'<div class="col-md-12 w-100 d-flex justify-content-center">' +
		'<div class="loader">Loading...</div>' +
		"</div>" +
		"</div>" +
		"</div>"
	);
};
