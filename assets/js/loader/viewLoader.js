const loadView = (url, div) => {
	$(div).load(url);
};

$(".side-menu").on("click", function (e) {
	const element = $(this);
	const url = element.data("url");
	const menu = element.data("menu");

	loading();
	setActiveMenu(menu);
	setActiveSub(null);
	localStorage.setItem("currentUrl", url);
	if (url) loadView(url, ".content-admin");
});

$(".side-submenu").on("click", function (e) {
	const element = $(this);
	const url = element.data("url");
	const menu = element.data("menu");
	const submenu = element.data("submenu");

	loading();
	setActiveMenu(menu);
	setActiveSub(submenu);
	localStorage.setItem("currentUrl", url);
	if (url) loadView(url, ".content-admin");
});

$(document.body).on("click", ".link-to", function (e) {
	e.preventDefault();
	const element = $(this);
	const to = element.data("to");
	const target = element.data("target");

	localStorage.setItem("currentUrl", to);

	target ? loading(target) : loading();
	target ? loadView(to, target) : loadView(to, ".content-admin");
});

$(document.body).on("click", ".link-to-tab-content", function (e) {
	e.preventDefault();
	const element = $(this);
	const to = element.data("to");
	const target = element.data("target");

	localStorage.setItem("tab-content", to);

	target ? loading(target) : loading();
	target ? loadView(to, target) : loadView(to, ".content-admin");
});

$(document.body).on("click", ".link-to-unsave", function (e) {
	e.preventDefault();
	const element = $(this);
	const to = element.data("to");
	const target = element.data("target");

	console.log(to, target);

	target ? loading(target) : loading();
	target ? loadView(to, target) : loadView(to, ".content-admin");
});

$(document.body).on("click", ".link-to-with-prev", function (e) {
	e.preventDefault();
	const element = $(this);
	const to = element.data("to");
	const target = element.data("target");

	const menu = element.data("menu");
	const submenu = element.data("submenu");

	if (menu) setActiveMenu(menu);
	if (submenu) setActiveSub(submenu);

	const prevUrl = localStorage.getItem("currentUrl");

	localStorage.setItem("currentUrl", to);
	localStorage.setItem("prevUrl", prevUrl);

	target ? loading(target) : loading();
	target ? loadView(to, target) : loadView(to, ".content-admin");
});

$(document.body).on("click", ".go-back", function (e) {
	e.preventDefault();
	const element = $(this);
	const target = element.data("target");

	const to = localStorage.getItem("prevUrl");
	localStorage.setItem("currentUrl", to);

	target ? loading(target) : loading();
	target ? loadView(to, target) : loadView(to, ".content-admin");
});

/*
	Sidebar
*/
const setCurrentNav = (defaultLink) => {
	loading();
	const menu = localStorage.getItem("menu");
	const submenu = localStorage.getItem("submenu");
	const currentUrl = localStorage.getItem("currentUrl");
	const secondaryUrl = localStorage.getItem("secondaryUrl");
	const secondaryTarget = localStorage.getItem("secondaryTarget");

	if (menu) $(menu).addClass("menu-open");
	if (submenu) $(submenu).addClass("active");
	if (currentUrl) {
		setTimeout(() => {
			loadView(currentUrl, ".content-admin");
			if (secondaryUrl) {
				setTimeout(() => {
					loadView(secondaryUrl, secondaryTarget);
				}, 100);
			}
		}, 200);
	} else {
		setTimeout(() => {
			loadView(defaultLink, ".content-admin");
		}, 200);
	}
};

const setActiveMenu = (menu) => {
	const activeMenu = localStorage.getItem("menu");
	if (activeMenu) $(activeMenu).removeClass("menu-open");

	localStorage.setItem("menu", menu);
	$(menu).addClass("menu-open");
};

const setActiveSub = (submenu) => {
	const activeSub = localStorage.getItem("submenu");
	if (activeSub) $(activeSub).removeClass("active");

	if (submenu) {
		localStorage.setItem("submenu", submenu);
		$(submenu).addClass("active");
	}
};

$(".x-navigation-minimize").on("click", function (e) {
	setSidebar();
	setTimeout(() => {
		window.location.reload();
	}, 1000);
});

const setSidebarOnLoad = () => {
	const sidebar = localStorage.getItem("sidebar");
	if (sidebar === "minimize") {
		setMaximize();
	} else if (sidebar === "maximize") {
		setMinimze();
	} else {
		localStorage.setItem("sidebar", "minimize");
	}
};

const setSidebar = () => {
	const sidebar = localStorage.getItem("sidebar");
	if (sidebar === "minimize") {
		localStorage.setItem("sidebar", "maximize");
		setMaximize();
	} else if (sidebar === "maximize") {
		localStorage.setItem("sidebar", "minimize");
		setMinimze();
	} else {
		localStorage.setItem("sidebar", "minimize");
		setMinimze();
	}
};

const setMinimze = () => {
	$(".page-container").addClass("page-navigation-toggled");
	$(".page-container").addClass("page-container-wide");
	$(".nav-customx").addClass("x-navigation-minimized");
};

const setMaximize = () => {
	$(".page-container").removeClass("page-navigation-toggled");
	$(".page-container").removeClass("page-container-wide");
	$(".nav-customx").removeClass("x-navigation-minimized");
};

const editModal = (url, title) => {
	$("#modal_basic").modal("show");
	$(".modal-title").html(title);
	loadView(url, ".modal-body");
};
