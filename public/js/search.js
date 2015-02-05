var timer;

function up()
{
    timer = setTimeout(function()
    {
        var keywords = $('#search-input').val();

        if (keywords.length > 0)
        {
            $( ".hideElement" ).hide();
            $.post('http://localhost/laravel/MyProjectNew/public/executeSearch', {keywords: keywords}, function(markup)
            {
                $('#search-results').html(markup);
            });
        }
        else
        {
            $( ".hideElement" ).show();
            $('#search-results').html("");
        }
    }, 500);
}

function down()
{
    clearTimeout(timer);
}