'use strict'

let hangar =  {
  modules:{}
} ;

hangar.modules.actions = (function()
{

  return {

    start()
    {
      let current_produit = "";

      $(".list_produit").click(function()
      {

          $(".info_produit").hide()
          $(this).children(".info_produit").show();

      });

    },
  }


})();

window.onload = hangar.modules.actions.start();