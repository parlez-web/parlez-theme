jQuery(document).ready(function ($) {
 
   $(document).on("click", ".upload_image", function (e) {
      e.preventDefault();
      var $button = $(this);
 
 
      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
         title: 'Select or upload image',
         library: { // remove these to show all
            type: 'image' // specific mime
         },
         button: {
            text: 'Select'
         },
         multiple: false  // Set to true to allow multiple files to be selected
      });
 
      // When an image is selected, run a callback.
      file_frame.on('select', function () {
         // We set multiple to false so only get one image from the uploader
 
         var attachment = file_frame.state().get('selection').first().toJSON();
 
         $button.siblings('input').val(attachment.url).change();

         $button.siblings('.preview').attr('src', attachment.url).change();
 
      });
 
      // Finally, open the modal
      file_frame.open();
   });

   // Toggle Thumbnails Container
   $(document).on("click", ".toggle-content", function (e) {
      $(this).next('.toggle').slideToggle();
   });


   // Save the TinyMCE editors content correctly
   // $( '.widget-control-save' ).click(
   //       function() {
   //             // grab the ID of the save button
   //              var saveID   = $( this ).attr( 'id' );

   //              // grab the 'global' ID
   //              var ID       = saveID.replace( /-savewidget/, '' );

   //              // create the ID for the random-number-input with global ID and input-ID
   //              var numberID = ID + '-the_random_number1';

   //              // grab the value from input field
   //              var randNum  = $( '#'+numberID ).val();

   //              // create the ID for the text tab
   //              var textTab  = ID + '-wp_editor_' + randNum + '-html';

   //              // trigger a click
   //              $( '#'+textTab ).trigger( 'click' );

   //          }
   //      );

});