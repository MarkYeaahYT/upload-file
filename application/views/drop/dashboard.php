<div class="border container bg-light">
    <div class="pl-4 row bg-secondary">
        <h5 class="p-3">Drop Your File</h5>
    </div>
    <div class="row p-3">
        <div class="fordropzone m-auto w-50 ">
            <form action="<?php echo site_url('drop/upload') ?>" class="dropzone rot">
                <div class="d-flex">
                    <img class="m-auto" src="<?php echo base_url('assets/icon/upload.png'); ?>" width="25" height="25" alt="" srcset="">
                </div>
                <div class="fallback">
                    <input type="file" name="file" id="">
                </div>
            </form>
        </div>
    </div>
    <div class="row p-3">
        <div class="mycssnote m-auto w-50 border p-3">
            <div class="form-group">
                <label for="note">Note</label>
                <input id="note" type="text" class="form-control">
                <small class="form-text text-muted">note for this file</small>
            </div>
            <div class="form-group">
                <button id="gass" type="button" class="btn btn-success">Gass</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row p-3">
        <div class="container">
            <table id="mytable" class="table-striped">
                <thead class="bg-info">
                    <tr>
                        <th>No</th>
                        <th>File</th>
                        <th>IP</th>
                        <th>Country</th>
                        <th>Date</th>
                        <th>OS</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- JS -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="row p-3">
        <br>
        <hr>
        <div class="container">
            
        </div>
    </div>
</div>
<div class="success">
    <h6>Success ngeGass</h6>
</div>

<script type="text/javascript">
$(document).ready(function () {
    var table = $('#mytable').DataTable({
        ajax: {
            url: '/drop/show',
            dataSrc: ''
        },
        columns: [
            {data: 'id'},
            {render: function (data, type, row) {  
                return '<a href="/uploads/'+row.filename+'">'+row.filename+'</a>';
            }},
            {data: 'ip'},
            // {data: 'country'},
            {render: function (data, type, row) {  
                return "-";
            }},
            {data: 'date'},
            // {data: 'os'},
            {render: function (data, type, row) { 
                if(row.os == "Mac OS"){
                    return '<img src="<?php echo base_url("assets/icon/mac.png") ?>" alt="Mac OS" title="Mac OS" srcset="" width="25" height="25">';
                }else if(row.os == "IOS"){
                    return '<img src="<?php echo base_url("assets/icon/mac.png") ?>" alt="IOS" title="IOS" srcset="" width="25" height="25">';
                }else if(row.os == "Windows"){
                    return '<img src="<?php echo base_url("assets/icon/windows.png") ?>" alt="Windows" title="Windows" srcset="" width="25" height="25">';
                }else if(row.os == "Android"){
                    return '<img src="<?php echo base_url("assets/icon/android.png") ?>" alt="Android" title="Android" srcset="" width="25" height="25">';
                }else if(row.os == "Linux"){
                    return '<img src="<?php echo base_url("assets/icon/linux.png") ?>" alt="Linux" title="Linux" srcset="" width="25" height="25">';
                }else{
                    return 'Anonymous';
                }
            }},
            {data: 'note'}
        ]
    });
    table.on('order.dt search.dt', function(){
         table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) { 
             cell.innerHTML = i + 1;
          });
    })

    table.order([4, "desc"]).draw();
    /**
        handle Message Success
     */
    
});
$(".success").hide();

</script>
<script src="<?php echo base_url("assets/js/Drop.js"); ?>"></script>

<style>
    .fordropzone{
        border-style: dashed;
    }
    .rot:hover{
        transition: all 1.5s;
        /* rotate: 180deg; */
    }

    .mycssnote{
        border-radius: 10px;
        box-shadow: 1px 1px 8px 1px gray;
    }

    .success{
        color: white;
        background-color: gray;
        z-index: 100;
        top: 545px;
        position: fixed;
        width: 190px;
        border-radius: 0px 10px 10px 0px;
        box-shadow: 1px 1px 5px 1px gray;
        cursor: pointer;
    }

    .success > h6{
      margin: auto;
      padding: 20px 20px;
    }
    
</style>