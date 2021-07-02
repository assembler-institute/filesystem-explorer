window.onload = function() {

	let file_information = document.getElementById("file_container");

	let myFilesListening_information =
		file_information.querySelectorAll(".get_info_file");


	myFilesListening_information.forEach((element) => {
		element.addEventListener("click", read_file_information);
	});

	function read_file_information() {
		let myContainer_info = document.getElementById("my_info--container");
		let myId_info = event.target;
		let mySource_info = myId_info.dataset.relativesource;

		myContainer_info.style.opacity = "1";
		myContainer_info.style.display = "inline-block";

		// we create the coockie
		createCookie("gfg", mySource_info, "1");

		// funcion para pedir, mediante un POST ajax, una respuesta del archivo especificado.
		$.ajax({
			url: '../../php/navbar_file_information/file_info.php',
			type: 'post',
			data: "callFunc1",
			success: function(response) {
				myContainer_info.innerHTML = response;
				let myBtnClose = document.getElementById("btn__close--file--Information");
				myBtnClose.addEventListener("click", close_navbar_information);
			}
		});
	}

	// Function to create the cookie
	function createCookie(name, value, days) {
		var expires;

		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}

		document.cookie = escape(name) + "=" +
			escape(value) + expires + "; path=/";
	}

	function close_navbar_information() {
		let myContainer_info = document.getElementById("my_info--container");
		myContainer_info.style.display = "none";
		myContainer_info.style.opacity = "0";
	}
};