function tambahTeman(){
	
	var npmSaya = sessionStorage.getItem("npm");
	
	var npmTeman = document.getElementById("connect-btn").getAttribute("npm");
	
	/*
	Fungsi untuk menghandle teman yang sama namun belum berhasil
	*/
	
	if (arrTeman == null){
		var arrTeman = localStorage.getItem("arr");
	}else {
		if (arrTeman.indexOf(npmTeman)){
			alert("Teman sudah ada");
			return;
		}else {
			arrTeman.push(npmTeman);
			localStorage.setItem("arr",arrTeman);
		}
	}
	
	$.ajax({
		url: "http://localhost/uts/services/cv.php",
		datatype: "json",
		data: { perintah : "tambah", user : npmSaya , userteman : npmTeman },
		method: "POST"
	}).done(function(data){
		hasil = JSON.parse(data);
		if(hasil.status === "ok"){
			alert("Tambah Teman Berhasil !");
			window.location = "home.html";
		}else if (hasil.status === "gagal"){
			alert("username tidak ditemukan");
		}
	});
	
}

$(document).ready(function(){
				
	$("#logout-btn").on("click",keluar);
	$("#update-btn").on("click",update);
	
	function keluar(){
		
		sessionStorage.clear();
		window.location = "index.html";
		
	}
	
	function update(){
		$("#editor").fadeIn("slow");
		$("#update-btn").hide();
		
		$("#submit-btn").on("click",validasi);
		
	}
	
	function validasi(){
		
		var nama = document.getElementById("namaBaru").value;
	
		var alamat = document.getElementById("alamat").value;
		
		var flag = false;
		
		if (nama == ""){
			alert("silahkan ketik nama");
		}else if (alamat == ""){
			alert("silahkan ketik email");
		}else {
			flag = true;
		}
		
		var keahlian = document.getElementById("keahlian").value;
		
		if (flag){
			$("#namaOrang").html(nama);
			localStorage.setItem("namaBaru",nama);
			$("#alamatBaru").html(alamat);
			localStorage.setItem("alamatBaru",alamat);
			
			if (keahlian !== ""){
				$("#keahlianBaru").html(keahlian);
				localStorage.setItem("keahlianBaru",keahlian);
			}
			
			$("#editor").fadeOut("slow");
			$("#update-btn").show();
		}
		
	}
	
	$("#cari").on("click", function(){
							
		var temp = $("#npmQuery").val();
		
		$.ajax({
			url: "http://localhost/uts/services/cv.php",
			datatype: "json",
			data: { perintah : "cari", nama : temp },
			method: "POST"
		}).done(function(obj){
			var temp = JSON.parse(obj);
			var result = temp.users;
			$("#searchresult").html("");
			for (var i = 0; i < result.length; i++){
				$("#searchresult").html($("#searchresult").html()+"<br>"+ result[i].user + " - " + result[i].nama + "<br>" +"<input type='button' value='connect' onclick='tambahTeman()' id='connect-btn' npm='" + result[i].user + "'>");
			}
		});
		
	});
	
	$(function() {
		
		if (sessionStorage.getItem("nama") !== null){
			$("#namaOrang").html(sessionStorage.getItem("nama"));
		}
		if (sessionStorage.getItem("npm") !== null){
			$("#nomorOrang").html(sessionStorage.getItem("npm"));
		}
		if (localStorage.getItem("namaBaru") !== null){
			$("#namaOrang").html(localStorage.getItem("namaBaru"));
		
		}
		if (localStorage.getItem("alamatBaru") !== null){
			$("#alamatBaru").html(localStorage.getItem("alamatBaru"));
		}
		if (localStorage.getItem("keahlianBaru") !== null){
			$("#keahlianBaru").html(localStorage.getItem("keahlianBaru"));
		}
		
		var npmKita = sessionStorage.getItem("npm");
		
		$.ajax({
			url: "http://localhost/uts/services/cv.php",
			datatype: "json",
			data: { perintah : "teman", user : npmKita },
			method: "POST"
		}).done(function(object){
			tmp = JSON.parse(object);
			listTeman = tmp.users;
			for (var i = 0; i < listTeman.length; i++){
				$("#friendlist").html($("#friendlist").html()+"<br>"+ listTeman[i].user + " - " + listTeman[i].nama);
			}
		});
		
	});
	
});