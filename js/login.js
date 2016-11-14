$(document).ready(function(){
				
	$(".submit-btn").on("click",masuk);
	
	function masuk(){
		
		var namaUser = document.getElementById("username").value;
		var kataKunci = document.getElementById("password").value;
		
		login(namaUser,kataKunci);
		
	}
	
	function login(namaUser, kataKunci){
		$.ajax({
			url: "http://localhost/uts/services/cv.php",
			datatype: "json",
			data: { perintah : "login", user : namaUser, password : kataKunci },
			method: "POST"
		}).done(function(obj){
			var result = JSON.parse(obj);
			if(result.status === "ok"){
				var nama = result.nama;
				var user = result.user;
				sessionStorage.setItem("nama",nama);
				sessionStorage.setItem("npm",user);
				alert("Login Berhasil !");
				window.location = "home.html";
			}else if (result.status === "gagal"){
				alert("username tidak ditemukan atau password tidak sesuai");
			}
		});
	}
	
});