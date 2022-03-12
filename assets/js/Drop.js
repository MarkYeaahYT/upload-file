$(document).ready(function () {
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
  