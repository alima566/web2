$(function()
{
     
xOffset = 250; // Offsets to calculate mousepointer distance
yOffset = 30; // Offsets to calculate mousepointer distance

$('.prompt').on('input', searchListener); // Checks for changes in "search" field
$('#loader').hide(); 

var url = 'service-painting.php';

/*
Detects change in "Artist" filter (dropdown) list and performs transition(s) to replace old content
with newly fetched content via "JSON Web Service"
*/
  $("select#artist").change(function ()
    {
       var selectedArtist = $('select#artist').find(":selected").val()
         setTimeout(function () 
                {
                     $('.item#card').transition('slide left', '2000')
                }, 100);
                
          $.get(url + '?artist=' +  selectedArtist + '&museum=0' + '&shape=0')
          .done(function (data)
            {
                $('#loader').show();
              setTimeout(function () 
                {
                  outputPaintings (data);
                  $('.item#card').hide();
                  $('#loader').hide();
                  $('.item#card').transition('slide right', '2000');
                  $('.item#card').show();
                }, 750);
            });
    });
    
/*
Detects change in "Museum" filter (dropdown) list and performs transition(s) to replace old content
with newly fetched content via "JSON Web Service"
*/
      $("select#museum").change(function ()
    {
       var selectedMuseum = $('select#museum').find(":selected").val()
         setTimeout(function () 
                {
                     $('.item#card').transition('slide left', '2500')
                }, 100);
       
          $.get(url + '?artist=0'  + '&museum=' + selectedMuseum + '&shape=0')
          .done(function (data)
            {
                $('#loader').show();
               setTimeout(function () 
                {
                   outputPaintings (data);
                   $('.item#card').hide();
                   $('#loader').hide();
                   $('.item#card').transition('slide right', '2500');
                   $('.item#card').show();
                }, 750);
            });
    });
    
/*
Detects change in "Shape" filter (dropdown) list and performs transition(s) to replace old content
with newly fetched content via "JSON Web Service"
*/
       $("select#shape").change(function ()
    {
       var selectedShape = $('select#shape').find(":selected").val()
         setTimeout(function () 
                {
                     $('.item#card').transition('slide left', '2500')
                }, 200);
       
          $.get(url + '?artist=0'  + '&museum=0' +  '&shape=' + selectedShape)
          .done(function (data)
            {
                $('#loader').show();
               setTimeout(function () 
                {
                   outputPaintings (data);
                   $('.item#card').hide();
                   $('#loader').hide();
                   $('.item#card').transition('slide right', '2500');
                   $('.item#card').show();
                }, 750);
            });
    });
/*
Checks current query string to determine whether to print all (top 20) paintings or use 'searched for' terms to display
searched paintings
*/
    if (getUrlVars().search == undefined)
    {
        $.get(url)
        .done(function (data)
        {
            var subtitle = $('<h4/>').addClass('ui header').html('ALL PAINTINGS [TOP 20]');
            $('#header').after(subtitle);
            outputPaintings (data);
        });
    }
    else
    {
        $.get(url + '?search=' + getUrlVars().search)
        .done(function (data)
        {
            var subtitle = $('<h4/>').addClass('ui header').append('SEARCH RESULTS FOR: ' + getUrlVars().search.toUpperCase());
            $('#header').after(subtitle);
            outputPaintings (data);
        });
    }
});

/*
    Function: uses JSON Data (fetched via the web service) to output paintings on screen
*/
function outputPaintings (data)
{
    var val;
    var main = $('<div/>').addClass('ui divided items');
    
    //var paintingData = jQuery.parseJSON(data);
    //console.log(data[0]);
    
    $.each(data, function (index, value)
    {
        var item = $('<div/>').addClass('item').attr('id', 'card');
        var paintingLink = $('<a/>').attr('href', 'single-painting.php?id=' + value.PaintingID).addClass('image').appendTo(item);
        var img = $('<img/>').attr({'src': 'images/art/works/square-medium/' + value.ImageFileName + '.jpg', 
                                    'title': value.Title, 'alt': value.Title, 
                                    'id': 'hover'}).appendTo(paintingLink);
        var classContent = $('<div/>').addClass("content").appendTo(item);
        var header = $('<a/>').attr('href', 'single-painting.php?id=' + value.PaintingID).addClass('header').html(value.Title).appendTo(classContent);
        var meta = $('<div/>').addClass('meta').appendTo(classContent);
        var name = $('<span/>').append(checkIfNull(value.FirstName) + ' ' + checkIfNull(value.LastName)).appendTo(meta);
        var description = $('<div/>').addClass('description').appendTo(classContent);
        var excerpt = $('<p/>').append(value.Excerpt).appendTo(description);
        var price = $('<p/>').append('$' + addCommas(parseInt(value.MSRP).toFixed(0))).appendTo(description);
        var anchor = $('<a/>').attr('href', "add-to-cart.php?id[]=" + value.PaintingID ).appendTo(description);
        var button = $('<button/>').addClass('ui compact icon orange button').attr({'data-tooltip': 'Add to Cart', 
                                                                                    'onclick' : 'change()' }               
                                                                                                        ).appendTo(anchor);
        var i = $('<i/>').addClass('shop icon').appendTo(button);
        var anchor2 = $('<a/>').attr('href', "add-to-favorites.php?pid=" + value.PaintingID ).appendTo(description);
        var button2= $('<button/>').addClass('ui compact icon button').attr('data-tooltip', 'Add to Favorites').appendTo(anchor2);
        var i2 = $('<i/>').addClass('heart icon').appendTo(button2);
        item.appendTo(main);
    });

    $('#items').html(main)
   
    mouseover();
}
/* 
    Function: Displays painting preview from thumbnail image. 
    This function is called when the user moves mouse cursor over smaller version (thumbnail)
    of a paintings on 'Browse Painting', 'Singel Genre', 'Single Artist' or 'Single Gallery' page
*/
function mouseover ()
{
    $("img#hover").mouseover(function ()
	{
	    var alt = $(this).attr('alt');
        var src = $(this).attr('src');
        var newSrc = src.replace('square-medium', 'average');
        var preview = $('<div/>').attr('id', 'preview');
        var image = $('<img/>').attr({'src': newSrc, 
                                      'alt': alt });

        preview.append(image);
        $("main").append(preview);
	    $('#preview').fadeIn(1250);
        $('#preview')
            .css("top",($(this).pageY - xOffset) + "px")
            .css("left",($(this).pageX + yOffset) + "px");
	});
	$('img#hover').on('mouseleave', removePreview);
    $('img#hover').on('mousemove', movePreview);
}

function removePreview ()
{
    $('#preview').remove();
}

function movePreview (e)
{
  $('#preview')
      .css("top",(e.pageY - xOffset) + "px")
      .css("left",(e.pageX + yOffset) + "px");
}

/* 
    Function: Simple Search is initiated when user enters >2 characters of text in teh search box
    The system will display paintings whose title begins with the entered text    
*/
function searchListener() {
    $.post('service-painting.php?searchField='+  $('.prompt').val(),
        function (data) 
        {
            var content = formatSearchResult(data);
            $('.ui.search').search({
                source: content,
                searchFields: 'title',
                searchFullText: true,
                minCharacters: 2,
                cache: false,
            });
        }
    );
}
/* 
    Function: A helper function to the function above which formats the dropdown paintings in a user friendly manner
*/
function formatSearchResult(data) {
    var len = data.length;
    var content = new Array(len);
    for (var index = 0; index < len; index++) {
        content[index] = {
            title: data[index].Title,
            description: checkIfNull(data[index].FirstName) + ' ' +checkIfNull(data[index].LastName),
            price: ('$' + addCommas(parseInt(data[index].MSRP).toFixed(0))),
            url: 'single-painting.php?id=' + data[index].PaintingID
        };
    }
    return content;
}

/*
    Function: Grabs the exisitng query string to parse parts of it to provide ID and value from it
    e.g "www.test.com?name=David" Can get you  getUrlVars().name -> David
*/
function getUrlVars ()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

/*
    Function:  Adds commas and formats the number passed in to it.
    e.g addCommas(1500.0000) will get you 1,500
*/
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

/*
    Function:Checks if the value passed to it is null, if so, returns an empty string, 
    otherwise returns the value itself.
*/

function checkIfNull (name)
{
    return (name == null) ? '' : name;
}


