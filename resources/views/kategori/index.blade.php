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
                        KATEGORI
                    </div>
                    <div class="card-body">
                        <input type="search" id="search" class="k-textbox" style="width: 150px" placeholder="Nama kategori"/>
                        <hr>
                        <div id="grid"></div>
                        <div id="ItemDelete"></div>
                        <script type="text/x-kendo-template" id="deleteDialogTemplateitem">
                        Anda yakin ingin menghapus <strong>#= Nama_Kategori #</strong>?
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
                    field: "Nama_Kategori",
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
                           url:'{{route("kategori.getKategori")}}',
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

               create:function (options) {

                   $.ajax({

                       headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
                       url: '{{route("kategori.storeKategori")}}',
                       type: "post",
                       data: options.data,
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
               },
               update:function(options){

                   $.ajax({
                       headers: {
                           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                       },
                       url: '{{route("kategori.updateKategori")}}',
                       type: "post",
                       data: options.data,
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
               },
               },
               schema:{
                 data:'data',
                 total:'total',
                 model: {
                     id: "Id_Kategori",
                     fields: {
                        Id_Kategori: { defaultValue: null },
                        Nama_Kategori: { type: "string" ,validation: { required: true,}},
                        Kode_Kategori: { type: "string", validation: { required: true,}},
                     }
                 }
               },
               pageSize: 20
           },
            toolbar:[{name:'create', text:'Tambah Data'}],
            noRecords: true,
            sortable: true,
            pageable: {
                pageSizes: true,
                numeric: false,
                input: true,
                refresh: true
            },
            editable: {
                mode: "popup",
            },
           columns: [ {
               field: "Nama_Kategori",
               title: "Nama Kategori",
               width: 100
           }, {
               field: "Kode_Kategori",
               title: "Kode Kategori",
               width: 100,
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
                   'edit',
                   {
                       name: "hapus",
                       iconClass: "k-icon k-i-close",
                       text: "Hapus",
                       click: deleteData
                   },

               ],
               width: "150px"
           }
        ],
           edit:function(e){
               e.container.parent().find('.k-window-title').text(e.model.Id_Kategori == "" || e.model.Id_Kategori == null ? "Tambah Prodi" : "Edit Prodi")


           }
       })//end grid
       function formatDate(date) {
        var d = new Date(date),
              month = "" + (d.getMonth() + 1),
              day = "" + d.getDate(),
              year = d.getFullYear(),
              hour = "" + d.getHours(),
              minute = "" + d.getMinutes(),
              second = "" + d.getSeconds();

          if (month.length < 2) month = "0" + month;
          if (day.length < 2) day = "0" + day;
          if (hour.length < 2) hour = "0" + hour;
          if (minute.length < 2) minute = "0" + minute;
          if (second.length < 2) second = "0" + second;

          return ([year, month, day].join("-"));
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
                            url: '{{route("kategori.deleteKategori")}}',
                            type: "post",
                            data: {
                                Id_Kategori: data.Id_Kategori
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
    })
</script>
@endsection
