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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah
                        </button>

                        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    {{-- Form modal --}}
                                    <form id="target" action="{{ route('produk.storeProduk') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                          <label for="nama" class="col-form-label">Nama Produk:</label>
                                          <input type="text" class="form-control" id="nama" required>
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
                                            <input name="files" class="form-control-file"  id="files" type="file" aria-label="files" />
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
    $(document).ready(function(){

    
        $("#search").keyup(function() {
            var searchValue = $('#search').val();
            $("#grid").data("kendoGrid").dataSource.filter(
                {
                    field: "Nama_Produk",
                    operator: "Contains",
                    value: searchValue
                }
            );
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
                           data: options.data,
                           success: function (res) {
                               options.success(res);

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
               pageSize: 20
           },
            
            noRecords: true,
            sortable: true,
         
            editable: {
                mode: "popup",
            },
           columns: [ {
               field: "Nama_Produk",
               title: "Nama Produk",
               width: 100
           }, {
               field: "Harga_Produk",
               title: "Harga Produk",
               width: 100,
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
              var res=  decodeEntities(data_field.Deskripsi_Produk)
              console.log(res);
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
                       name: "hapus",
                    //    iconClass: "k-icon k-i-close",
                       text: "Hapus",
                       className: "btn btn-danger btn-sm",
                       click: getClick
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
            try {             //the name of your editor
                varTitle= $('<textarea />').html(data.Deskripsi_Produk).text();
                alert(document.write(varTitle));
                //Do Your stuff here 

            }
            catch (e) { }
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
                stylesheets: [
                    "../content/shared/styles/editor.css",
                ],
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
            $('.kategori').select2({
                width: 'resolve' ,
                ajax: {
                    url: '{{ route("kategori.getKategori") }}',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    processResults: function (data) {
                      console.log(data.data);
                      var res = data.data.map(function (item) {
                            return {id: item.Id_Kategori, text: item.Nama_Kategori};
                        });
                    return {
                        results: res
                    };
                    }
                }
            });
            $( "#target" ).submit(function( event ) {
                event.preventDefault();
                
                
                var tags= $("#select_kategori").val();
                formdata = new FormData();
                formdata.append('nama', $('#nama').val());
                formdata.append('harga', $('#harga').val());
                formdata.append('kategori', JSON.stringify(tags));
                formdata.append('foto',$('#files')[0].files[0]);
                formdata.append('deskirpsi', $('#editor').val());
                console.log(formdata);
                $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        url: '{{route("produk.storeProduk")}}',
                        data: formdata,
                        type: 'POST',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false,
                        success: function (e) {
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
            });
    })
</script>
@endsection
