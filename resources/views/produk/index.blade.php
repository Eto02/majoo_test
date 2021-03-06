@extends('layouts.app')
@section('pageTitle','Kategori')
@section('content')
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        PRODUK
                    </div>
                    <div class="card-body">
                        <input type="search" id="search" class="k-textbox" style="width: 150px" placeholder="Nama produk"/>
                        <hr>
                         <div class="form-group">
                            <label for="nama" class="col-form-label">Limit Data:</label>
                           <input type="number" id='limitPage' name='perpage' class='k-textbox' value='5'>
                        </div>
                         <p style='color:red; text-decoration: underline;'><i>Note:Mohon melakukan refresh jika anda melakukan perubahan pada master kategori, dikarenakan select2 tidak mendukung preselect untuk ajax </i></p>
                        <button type="button" onclick='resetForm()'class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah
                        </button>
                        
                        <br>
                         
                        {{-- modal tambah --}}
                        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Tambah / Update Produk</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                   <div class="progress">
                                        <div class="progress-bar"></div>
                                    </div>
                                    
                                    <form id="target" action="{{ route('produk.storeProduk') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id='IsEdit' value='0'>
                                        <input type="hidden" id='url' value='0'>
                                        <div class="form-group">
                                          <label for="nama" class="col-form-label">Nama Produk:</label>
                                          <input type="text" class="form-control" id="nama" >
                                        </div>
                                        <div class="form-group">
                                            <label for="harga" class="col-form-label">Harga:</label>
                                            <input type="number" class="form-control" id="harga" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="select_kategori" class="col-form-label">Kategori:</label>
                                            <select class="js-example-responsive kategori" id="select_kategori" multiple="multiple" style="width: 75%"></select>
                                        </div>
                                        <div class="form-group">
                                            <label for="files" class="col-form-label">Foto:</label>
                                            <input name="files" class="form-control-file"  id="files" type="file" aria-label="files" accept="image/png, image/gif, image/jpeg" />
                                        </div>
                                        <div class="form-group">
                                          <label for="editor" class="col-form-label">Deskripsi:</label>
                                          <textarea class="form-control" id="editor"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" >Save changes</button>
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                         <hr>

                        <div id="grid"></div>   
                        <br>
                           <center> 
                           <div class="btn-group" role="group" aria-label="Third group">
                                <button class='btn btn-secondary' onclick='prevPage()'>Sebelumnya</button>
                                <button class='btn btn-info' id='halaman'></button>
                                <button class='btn btn-secondary' onclick='nextPage()'>Selanjutnya</button>
                            </div>
                            </center>
                                    {{-- <div className="text__page"><button class='btn btn-info' id='currentPage'></button>/<button class='btn btn-info'  id='totalPage'></button></div> --}}
                      
                        <div id="ItemDelete"></div>
                        <script type="text/x-kendo-template" id="deleteDialogTemplateitem">
                        Anda yakin ingin menghapus <strong>#= Nama_Produk #</strong>?
                        </script>

                    </div>
                </div>
              </div>
          </div>
      </div>
  
  </section>
  <script type="text/javascript">
    var currentPage;
    var totalPage;
    var perPage;
    var search;
    function resetForm(){
        $("#editor").data("kendoEditor").value('');
        $('#IsEdit').val('0')
        $('#target')[0].reset();
        $("#select_kategori").val(0).trigger('change');
    }
    function nextPage(){
        currentPage=parseInt(currentPage);
        currentPage=parseInt((currentPage<totalPage?currentPage+1:currentPage));
        $('#grid').data("kendoGrid").dataSource.read();
    }
    function prevPage(){
        currentPage=parseInt(currentPage);
        currentPage=parseInt((currentPage>1?currentPage-1:1));
        $('#grid').data("kendoGrid").dataSource.read();
    }
     $("#limitPage").keyup(function(){
        val= $("#limitPage").val();
        perPage=  ($("#limitPage").val()!=''?parseInt(val):0)
        $('#grid').data("kendoGrid").dataSource.read();
        $('#grid').data('kendoGrid').refresh();
            
    });
    function generateTemplate(ReportList) {
        var template = "<ul>";
        for (var i = 0; i < ReportList.length; i++) {
        template = template + "<li>" + ReportList[i].Id_Kategori + "</li>";
        }
    }
       
    $("#search").keyup(function() {
        search = $('#search').val();
        $('#grid').data("kendoGrid").dataSource.read();
        $('#grid').data('kendoGrid').refresh();
    });
    $(document).ready(function(){
      
    
            $.ajax({
                    
                    url:'{{ route("kategori.getKategori") }}',
                    dataType: 'json',
                    type: "GET",
                    success:function(data){
                        // the next thing you want to do 
                        $('#select_kategori').select2({
                            width: 'resolve' ,
                        });
                            
                        data.data.map(function(res){
                            var newOption = new Option(res.Nama_Kategori, res.Id_Kategori, false, false);
                            $('#select_kategori').append(newOption).trigger('change'); 
                        });
                    }
            });

        
      

        deleteDialogTemplateitem = kendo.template($("#deleteDialogTemplateitem").html());

        $('#grid').kendoGrid({
            dataSource: {
               transport: {
                   read: function(options){
                       $.ajax({
                           dataType:'json',
                           url:'{{route("produk.getProduk")}}',
                           type:'get',
                           data:{
                               search:search,
                               currentPage:currentPage,
                               perPage:perPage
                           },
                           success: function (res) {

                                options.success(res);
                                currentPage=res.currentPage;
                                perPage=res.perPage;
                                totalPage=Math.ceil(res.total/res.perPage);
                                $('#halaman').text(res.currentPage+'/'+ Math.ceil(res.total/res.perPage))

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
                   },

               },
               schema:{
                 data:'data',
                 total:'total',
                 model: {
                     id: "Id_Produk",
                     fields: {
                        Id_Produk: { defaultValue: null },
                        Nama_Produk: { type: "string" ,validation: { required: true,}},
                        Kode_Kategori: { type: "string", validation: { required: true,}},
                     }
                 }
               },
              
           },
            
            noRecords: true,
           
           columns: [ {
               field: "Nama_Produk",
               title: "Nama Produk",
               width: 100
           }, {
               field: "Harga_Produk",
               title: "Harga Produk",
               width: 100,
           },{
               title: "Kategori",
               width: 100,
               template:function(data_field) {
                // res=data_field.produk_kategoris;
                var template = "<ul>";
                for (var i = 0; i < data_field.produk_kategoris.length; i++) {
                
                    if(data_field.produk_kategoris[i]!=null ){
                        template = template + "<li>" +data_field.produk_kategoris[i].mstr_kategori.Nama_Kategori+ "</li>";
                    }
                }
                return template;
                },
           },{
               field: "Foto_Produk",
               title: "Foto Produk",
               width: 100,
               template:function(data_field) {
                        var foto=data_field.Foto_Produk
                        if(foto==null){
                            return 'Foto Kosong'
                        }
                         var res = foto.replace("public", "storage");
                        return '<img src={{ url("") }}/'+res+' width=150px />'
                }
           },
           {
               field: "Deskripsi_Produk",
               title: "Deskirpsi Produk",
               width: 100,
               template:function(data_field) {
                    var res=data_field.Deskripsi_Produk
                    return ''+res+'';
                }
           },{
               headerTemplate: "<span class='k-icon k-i-gear'></span>",
               headerAttributes: {
                   class: "table-header-cell",
                   style: "text-align: center"
               },
               attributes: {
                   class: "table-cell",
                   style: "text-align: center"
               },
               command: [
                   {
                       name: "ubah",
                       iconClass: "k-icon k-i-close",
                       text: "Edit",
                       className: "btn btn-danger btn-sm",
                       click: getClick
                   },
                    {
                       name: "hapus",
                       iconClass: "k-icon k-i-close",
                       text: "Hapus",
                       className: "btn btn-danger btn-sm",
                       click: deleteData
                   },

               ],
               width: "150px"
           }
        ],
           edit:function(e){
               e.container.parent().find('.k-window-title').text(e.model.Id_Produk == "" || e.model.Id_Produk == null ? "Tambah Prodi" : "Edit Prodi")


           }
       })//end grid
   
       function decodeEntities(encodedString) {
            var translate_re = /&(nbsp|amp|quot|lt|gt);/g;
            var translate = {
                "nbsp":" ",
                "amp" : "&",
                "quot": "\"",
                "lt"  : "<",
                "gt"  : ">"
            };
            return encodedString.replace(translate_re, function(match, entity) {
                return translate[entity];
            }).replace(/&#(\d+);/gi, function(match, numStr) {
                var num = parseInt(numStr, 10);
                return String.fromCharCode(num);
            });
        }

        function getClick(e) {
            var detailRow = e.detailRow;
            e.preventDefault();
            var tr = $(e.target).closest("tr"),
            data = this.dataItem(tr);
            var id_select=[];
            data.produk_kategoris.map(function(res){
                id_select.push(res.Id_Kategori);
            });
            $(".progress-bar").width('0%');
            $(".progress-bar").html('');
            $('#IsEdit').val('0')
            $('#target')[0].reset();
            $("#editor").data("kendoEditor").value('');
            $('#exampleModal').modal('show');

            $("#harga").val(data.Harga_Produk);
            $("#nama").val(data.Nama_Produk);
            $("#IsEdit").val(data.Id_Produk);
            $("#select_kategori").val(id_select).trigger('change');
       
            $("#editor").data("kendoEditor").value(data.Deskripsi_Produk);
        }  

        function deleteData(e) { //start delete item
            var detailRow = e.detailRow;
            e.preventDefault();
            var tr = $(e.target).closest("tr"),
                data = this.dataItem(tr);
            var deleteDialog = $("#ItemDelete").kendoDialog({
                width: "350px",
                title: "Hapus Data",
                visible: false,
                buttonLayout: "stretched",
                actions: [{
                    text: "Hapus",
                    primary: true,
                    action: function (e) {

                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            },
                            url: '{{route("produk.deleteProduk")}}',
                            type: "post",
                            data: {
                                Id_Produk: data.Id_Produk
                            },
                            dataType: "json",
                            success: function (e) {
                                currentPage=1;
                                $('#grid').data("kendoGrid").dataSource.read();
                                swal('', e['message'], "info");
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

                        });
                    }
                },
                    {
                        text: "Batal"
                    }
                ]
            }).data("kendoDialog");
            deleteDialog.content(deleteDialogTemplateitem(data));
            deleteDialog.open();
        } //end delete funtion
        var editor = $(".editor").kendoEditor();
        var editor = $("#editor").kendoEditor({
                tools: [
                    "bold",
                    "italic",
                    "underline",
                    "justifyLeft",
                    "justifyCenter",
                    "justifyRight",
                    "insertUnorderedList",
                    "createLink",
                    "unlink",
                    "insertImage",
                    "tableWizard",
                    "createTable",
                    "addRowAbove",
                    "addRowBelow",
                    "addColumnLeft",
                    "addColumnRight",
                    "deleteRow",
                    "deleteColumn",
                    "mergeCellsHorizontally",
                    "mergeCellsVertically",
                    "splitCellHorizontally",
                    "splitCellVertically",
                    "tableAlignLeft",
                    "tableAlignCenter",
                    "tableAlignRight",
                    "formatting",
                    {
                        name: "fontName",
                        items: [
                            { text: "Andale Mono", value: "\"Andale Mono\"" }, // Font-family names composed of several words should be wrapped in \" \"
                            { text: "Arial", value: "Arial" },
                            { text: "Arial Black", value: "\"Arial Black\"" },
                            { text: "Book Antiqua", value: "\"Book Antiqua\"" },
                            { text: "Comic Sans MS", value: "\"Comic Sans MS\"" },
                            { text: "Courier New", value: "\"Courier New\"" },
                            { text: "Georgia", value: "Georgia" },
                            { text: "Helvetica", value: "Helvetica" },
                            { text: "Impact", value: "Impact" },
                            { text: "Symbol", value: "Symbol" },
                            { text: "Tahoma", value: "Tahoma" },
                            { text: "Terminal", value: "Terminal" },
                            { text: "Times New Roman", value: "\"Times New Roman\"" },
                            { text: "Trebuchet MS", value: "\"Trebuchet MS\"" },
                            { text: "Verdana", value: "Verdana" },
                        ]
                    },
                    "fontSize",
                    "foreColor",
                    "backColor",
                ]
            });
            function removeTags(str) {
                if ((str===null) || (str===''))
                    return false;
                else
                    str = str.toString();
                    
                // Regular expression to identify HTML tags in 
                // the input string. Replacing the identified 
                // HTML tag with a null string.
                return str.replace( /(<([^>]+)>)/ig, '');
            }
           
  
            $( "#target" ).submit(function( event ) {
                event.preventDefault();
                tag= $("#select_kategori");
                var tags= $("#select_kategori").val();
      
                if (tag.val() ==null) {
                    swal('','Kategori harus dipilih', "warning");
                    return false;
                }
                decode=decodeEntities($('#editor').val());
                removTag=removeTags(decode);
                if(  removTag==null||removTag==''){
                    swal('','Deskripsi harus diisi', "warning");
                    return false;
                    
                }
                var tags= $("#select_kategori").val();
                formdata = new FormData();
                formdata.append('nama', $('#nama').val());
                formdata.append('harga', $('#harga').val());
                formdata.append('id_produk', $('#IsEdit').val());
                formdata.append('kategori', JSON.stringify(tags));
                formdata.append('foto',$('#files')[0].files[0]);
                formdata.append('deskirpsi',  decodeEntities($('#editor').val()));
            
                if( $('#IsEdit').val()==='0'){
                      if($('#files')[0].files[0]===undefined){
                            swal('','Foto harus diisi', "warning");
                            return false;
                        }
                
                       $.ajax({
                            xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = ((evt.loaded / evt.total) * 100);
                                    $(".progress-bar").width(percentComplete + '%');
                                    $(".progress-bar").html(percentComplete+'%');
                                }
                            }, false);
                            return xhr;
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url: '{{route("produk.storeProduk")}}',
                        data: formdata,
                        type: 'POST',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false,
                         beforeSend: function(){
                            $(".progress-bar").width('0%');
                        },
                        success: function (e) {
                            $(".progress-bar").width('0%');
                            $(".progress-bar").html('');
                            $("#select_kategori").val(0).trigger('change');
                            $('#target')[0].reset();
                            $("#editor").data("kendoEditor").value('');
                            $('#grid').data("kendoGrid").dataSource.read();
                          
                            swal('',  e.message, "info");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $('#target')[0].reset();
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

                    });
                }else{
                       $.ajax({
                            xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = ((evt.loaded / evt.total) * 100);
                                    $(".progress-bar").width(percentComplete + '%');
                                    $(".progress-bar").html(percentComplete+'%');
                                }
                            }, false);
                            return xhr;
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url: '{{route("produk.updateProduk")}}',
                        data: formdata,
                        type: 'POST',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false,
                          beforeSend: function(){
                            $(".progress-bar").width('0%');
                        },
                        success: function (e) {
                            $(".progress-bar").width('0%');
                            $(".progress-bar").html('');
                            $("#editor").data("kendoEditor").value('');
                            $('#IsEdit').val('0')
                            $('#exampleModal').modal('hide'); 
                            $('#target')[0].reset();
                            $('#grid').data("kendoGrid").dataSource.read();
                            swal('', e['message'], "info");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $('#target')[0].reset();
                            $('#IsEdit').val('0')
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

                    });
                }
                $("#editor").data("kendoEditor").value('');
                $('#IsEdit').val('0')
                $('#target')[0].reset();
              
        });
    })
</script>
@endsection
