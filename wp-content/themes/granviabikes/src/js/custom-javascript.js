// Add your custom JS here.


var controller = new ScrollMagic.Controller();

(function($){
    $(document).ready(function($){

        $('article.card').each(function () {
            var card = $(this);
            var id = card.attr('id');
            // build scene
            new ScrollMagic.Scene({
                triggerElement: "#" + id,
                triggerHook: 0.7,
                offset: 50, // move trigger to center of element
            })
            .setClassToggle("#"+id, "visible") // add class toggle
            .addTo(controller);
        });

      //  if ($('#ctaModal').length > 0){
      //      setTimeout(function () {
      //          $('#ctaModal').modal('show');
      //      },3000);
      //  }
    });
})( jQuery );
    