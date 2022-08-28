const errorHandler = (errors) => {
	$.each(errors, function (key, value) {
		// console.log(key, value);
		$(`#${key}-error`).html(value);
		$(`#${key}`).addClass("error");
	});
};

const removeFormError = () => {
	$(".form-error").html("");
	$(".form-control").removeClass("error");
};
