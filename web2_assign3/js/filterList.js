$(function()
{
    $('#loader').hide();
 
    $("select").change(function ()
    {
        $('.item#card').transition('slide left', '2500', function()
        {
            $("#loader").show();
        });
                 
        setTimeout(function () 
        {
            $("form").submit();
        }, 500);
                 
        setTimeout(function () 
        {
            $('.item#card').transition('slide right', '2500');
        }, 500 );
    });         
});






        
         // $("select#artist").on('change', function() 
    //      {
    //          $('.item#card').fadeOut('slow', function()
    //          {
    //              $("form").submit();
    //              $('.item#card').fadeIn('slow');
    //          });
    //      });
    // $("select#museum").on('change', function() 
    //      {
    //          $("form").submit();
    //      });
    // $("select#shape").on('change', function() 
    //      {
    //          $("form").submit();
    //      });
     