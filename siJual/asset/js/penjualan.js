$(document).ready(function(){
	  
});

function backbutton(){
	document.location='penjualan.php';
}
function inputbarang(kode,maks){
	qty = $('#qty_'+kode).val();
	//alert(qty);
	qtymaks = maks;
	//alert(qtymaks);
	if($.isNumeric(qty)){
		if(parseInt(qty)<=parseInt(qtymaks)){
		$.post(baseurl+'pages/transaksipenjualan/ajax.php',{req:'brg',id:kode},function(data){
			harga = data.harga;
			kdbrg = data.idbarang;
			qty2 = parseInt(qty);
			totalharga = harga * qty2; 
			hidqty = parseInt($('#hidqty').val()) + qty2;
			hidgrandtotal = parseInt($('#hidgrandtotal').val()) + totalharga;
			$('#hidgrandtotal').val(hidgrandtotal);
			$('#hidqty').val(hidqty);
			if($("#listbrg_"+kdbrg).length > 0) {
			//if exists remove first
			$("#listbrg_"+kdbrg).remove();
			}
			row = '<tr id="listbrg_'+kdbrg+'" class="datalistbarang">';
			row += '<td>'+data.idbarang+'<input type="hidden" name="kdbrg[]" value="'+kdbrg+'" readonly></td>';
			row += '<td>'+data.nama+'</td>';
			row += '<td><input type="text" size="4" name="qtyx[]" class="qty" id="qty_'+kdbrg+'" value="'+qty2+'" class="maskangka text-right"></td>';
			row += '<td><input type="text" width="10" class="harga" name="harga[]" id="harga_'+kdbrg+'" value="'+harga+'" class="maskangka text-right"></td>';
			row += '<td class=text-right><span id="spantotalblj_'+kdbrg+'" class="totalblj">'+totalharga+'</span></td>';
			row += '<td><a href="#linkdata" onclick=hapuslist("'+kdbrg+'")><i class="fa fa-trash"></i></a>&nbsp;<a href="#linkdata" onclick=savelist("'+kdbrg+'")><i class="fa fa-save"></i></a></td>';
			row += '</tr>';
		//alert(row);
			$('#tabeldata tbody').append(row);
				hitungulang();
		},'json');
	}else{
		alert('Qty yang Anda input melebihi qty di  : '+maks);
		$('#qty').val('').focus();
	}
	}else{
		alert('Qty harus berupa angka');
		$('#qty').val('').focus();
	}

} 
function popbarang(){
	$('#divpopbarang').modal('show');
}
function hapuslist(id){
	if(confirm('Apakah anda yakin akan menghapus data?')){
		idrow = "listbrg_"+id;
		$('#'+idrow).hide().remove();
		hitungulang();
	}
}
function savelist(id){
	idrow = "listbrg_"+id;
	harga = $('#harga_'+id).val();
	qty2 = parseInt($('#qty_'+id).val());
	totalharga = harga * qty2;
	$('#spantotalblj_'+id).html(totalharga);
	hitungulang();
}
function cekdata(){
	//cek ada barang gak?
	if($('.datalistbarang').length>0){
		return true;
	}else if($('#tgljual').val()==''){
		alert('Tanggal Jual belum diisi');
		return false;
	}else{
		alert('Data barang masih kosong. Silakan diisi terlebih dahulu');
		return false;
	}
}
function hitungulang(){
	totalqty = 0;
	totalblj = 0;
	$('.qty').each(function(){
		if($.isNumeric(this.value)){
			totalqty = totalqty + parseInt(this.value);
		 }
	});
	$('#totalqty').html(totalqty);	
	$('.totalblj').each(function(){
	a = $(this).text();
	po = a;
		if($.isNumeric(po)){
			totalblj = totalblj + parseInt(po);
		 }
	});
	$('#grandtotal').html(totalblj);
}