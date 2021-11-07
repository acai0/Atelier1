'use strict'

let lightbox =  {
	modules:{
	}
} ;


lightbox.modules.actions = (function()
{

	return {

		start()
		{
			let current_vignette = "";

			$(".vignette").click(function()
			{
				current_vignette = $(this);
				console.log(current_vignette)
				let small_image = $(this.innerHTML)[0];
				let big_image = smallToBig(small_image);
				$(".modal-img")[0].innerHTML = big_image;
				document.getElementById("myModal").style.display = "block";


			});

			$(document).keyup(function(e)
			{
     			if (e.key === "Escape")
     			{ // escape key maps to keycode `27`
        			document.getElementById("myModal").style.display = "none";
    			}
			});

			$(".close").click(function()
			{
  				document.getElementById("myModal").style.display = "none";
			});

			$("#previous").click(function()
			{
  				current_vignette.prev().click();
			});

			$("#next").click(function()
			{
				if (current_vignette == current_vignette.parent().lastChild)
				{
  					console.log("coucou")
  				}
  				else
  				{
  					current_vignette.next().click();
  					console.log(current_vignette.parent().last())
  				}
			});

			function smallToBig(img)
			{
				let str = img.outerHTML
				return str.replace("640", "1280").replace("small", "large");
			}
		},
	}


})();

lightbox.modules.app = (function()
{

	return {

		addElement()
		{
			let lightbox_container = document.createElement("div");
			let lightbox = document.createTextNode("")
			lightbox_container.appendChild(lightbox);
			lightbox_container.id = "lightbox_container"
			let gallery_container = document.getElementById('a')
			document.body.insertBefore(lightbox_container, gallery_container)
			$("#lightbox_container")[0].innerHTML = "<div id=\"myModal\" class=\"modal\"><div class=\"modal-content\"><span class=\"close\">&times;</span><div id=\"modal_display\"><span class=\"btn_nav\" id=\"previous\">&laquo;</span><div class=\"modal-img\"></div><span class=\"btn_nav\" id=\"next\">&raquo;</span></div></div></div>";
		},
	}


})();

window.onload = lightbox.modules.app.addElement()
window.onload = lightbox.modules.actions.start()

