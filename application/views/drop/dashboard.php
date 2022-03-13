<div class="border container bg-light">
    <div class="pl-4 row bg-secondary">
        <h5 class="p-3">Drop Your File</h5>
    </div>
    <div class="row p-3">
        <div class="fordropzone m-auto w-50 ">
            <form class="dropzone rot" onmousedown="party.confetti(this)">
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
                <button onmousedown="party.confetti(this)" id="gass" type="button" class="btn btn-success">Gass</button>
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
Dropzone.autoDiscover = false;
$(document).ready(function () {
    var table = $('#mytable').DataTable({
        ajax: {
            url: '/drop/show',
            dataSrc: ''
        },
        columns: [
            {data: 'no'},
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
    /**
        handle Message Success
     */

     $('form.dropzone').dropzone({
         url: '<?php echo site_url('drop/upload') ?>',
         success: (file, response) => {
            table.ajax.reload()
         }
     })

     /**
	 * Get information about device
	 */
	function getOS() {
		var userAgent = window.navigator.userAgent,
			platform = window.navigator.platform,
			macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
			windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
			iosPlatforms = ['iPhone', 'iPad', 'iPod'],
			os = null;
	  
		if (macosPlatforms.indexOf(platform) !== -1) {
			  os = 'Mac OS';
		} else if (iosPlatforms.indexOf(platform) !== -1) {
			  os = 'iOS';
		} else if (windowsPlatforms.indexOf(platform) !== -1) {
			  os = 'Windows';
		} else if (/Android/.test(userAgent)) {
			  os = 'Android';
		} else if (!os && /Linux/.test(platform)) {
			  os = 'Linux';
		}
	  
		return os;
	}

    /**
	 * Get Cookie
	 */
	function check_cookie_name(name) 
    {
      var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      if (match) {
		return match[2];
      }
      else{
           return false;
      }
   }

	/**
	 * Send Note to Server and set OS
	 */
	$("#gass").click(function (e) { 
		e.preventDefault();
		var id = check_cookie_name("MarkYeaahYT");
		var note = $("#note").val();
		var os = getOS();

		$.ajax({
			type: "POST",
			url: "/drop/save",
			data: {
				id: id,
				note: note,
				os: os
			},
			dataType: "JSON",
			success: function (response) {
				$(".success").show();			
			}
		});
        
	});

	/**
	 * Hide message Success
	 */
	$(".success").click(function (e) { 
		e.preventDefault();
		$(this).hide();
	});
    
});
$(".success").hide();

</script>
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