$(document).ready(function(){

	// tạo sự kiện click nút edit
	$("body").on("click", ".btn-edit", function(){
		$this = $(this);
		$modal = $("#EditModal");
		// lấy id
		var id = $this.data("id");
		// ajax lay data tu id
		$.ajax({
			url: "http://localhost/quanlynhanvien/nhanvienapi.php?id=" + id,
			type: "json"
		}).done(function(resp){
			// neu thanh cong
			if(resp.result){
				// fill data lay tu api
				$modal.find("input[name=hoten]").val(resp.data.hoten);
				$modal.find("input[name=diachi]").val(resp.data.diachi);
				$modal.find("input[name=sdt]").val(resp.data.sdt);
				$modal.find("input[name=email]").val(resp.data.email);
				$modal.find("input[name=id]").val(resp.data.id);
				$modal.find("select[name=phongban]").val(resp.data.mapb);
				$modal.find("input[name=username]").val(resp.data.username);
				$modal.find("input[name=password]").val(resp.data.password);
				$modal.find("input[name=luong]").val(resp.data.luong);
				// hien modal
				$modal.modal("show");
			}else{
				alert(resp.message);
			}
			
		}).fail(function(err){
			// thong bao loi
			// code in here
			// alert()
		});
		
	});
})