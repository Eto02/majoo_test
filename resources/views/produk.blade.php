@extends('layouts.app')
@section('pageTitle','Kategori')
@section('content')
    <div class="mt-5 ml-5"><H1>Produk</H1></div>
    <div class=".container-lg  p-5" id='show' style="display: flex;flex-wrap: wrap;  ;
    justify-content: space-evenly;">
        
       
    </div>
  </section>
  <script>

$(document).ready(function(){
    $.ajax({
            dataType:'json',
            url:'{{route("produk.getProdukShow")}}',
            type:'get',
       
            success: function (res) {

              res.data.map(function(data){
                  console.log(data)
                var foto=data.Foto_Produk;
                url='';
                deskripsi='white-space: normal'
                if(foto!=null){
                    deskripsi=data.Deskripsi_Produk.replace("white-space:pre", "white-space:normal")
                    url='{{ url('') }}/'+foto.replace("public", "storage");
                }
                    var img = $("<img src='{{ url('') }}"+url+"' />");

                    if(!imageExists(url)){
                        url='https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg'
                    }
                    console.log(url);
                html=   '<div class="">'+
                        '<div class="card flex " style="width: 18rem;margin:15px;height:500px" ;>'+
                        '<img class="card-img-top" src="'+url+'" alt="Card image cap">'+
                            '<div class="card-body  d-flex flex-column" style="word-wrap: break-word;">'+
                            '<h5 class="card-title "style="text-align:center">'+data.Nama_Produk+'</h5>'+
                            '<h5 class="card-title "style="text-align:center ">'+formatRupiah(data.Harga_Produk.toString(), 'Rp. ')+'</h5>'+
                            '<div class="card-text" style=" word-wrap: break-word; overflow-y:scroll; ;">'+deskripsi+'</div>'+
                            '<a href="#" class="btn btn-primary mt-auto" "style="text-align:center">Beli</a>'+
                       ' </div>'+
                       ' </div>';
               $("#show").append(html);
              });
            

            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal({
                        title: thrownError,
                        text: 'Error!! ' + xhr.status,
                        type: "error",
                        confirmButtonColor: "#02991a",
                        confirmButtonText: "Refresh Serkarang",
                        cancelButtonText: "Tidak, Batalkan!",
                        closeOnConfirm: false,
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            window.location.reload(true) // submitting the form when user press yes
                        }
                    });
            }
        })
})
function imageExists(image_url){

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();

    return http.status != 404;

}
function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

  </script>
  @endsection