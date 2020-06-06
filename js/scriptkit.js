function pengaduan() {
	document.getElementById('daftar').style.display = 'none';
	document.getElementById('pengaduan').style.display = 'block';
	document.getElementById('pengaduan').style.transition = '500ms';
}

function daftar() {
	document.getElementById('daftar').style.display = 'block';
	document.getElementById('pengaduan').style.display = 'none';
}

var submenuBtn = document.querySelectorAll(".dropdown");
submenuBtn.forEach(function(subbtn) {
	subbtn.onclick = function() {
		var submenu = subbtn.getAttribute("dropdown-target");
		var submenuId = document.getElementById(submenu);

		if (submenuId.style.display === "block") {
			document.getElementById(submenu).style.display = "none";
		}else {
			document.getElementById(submenu).style.display = "block";
		}
	};
})

