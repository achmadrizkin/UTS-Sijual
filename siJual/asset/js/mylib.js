function NilaiRupiah(jumlah) 
{ 
    var titik = ".";
    var nilai = new String(jumlah); 
    var pecah = []; 
    while(nilai.length > 3) 
    { 
        var a = nilai.substr(nilai.length-3); 
        pecah.unshift(a); 
        nilai = nilai.substr(0, nilai.length-3); 
    } 
    if(nilai.length > 0) { pecah.unshift(nilai); } 
    nilai = pecah.join(titik);
    return nilai; 
}