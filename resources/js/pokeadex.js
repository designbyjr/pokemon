$(document).ready(function() {
    // Initial AJAX call to load default Pokémon
    $.ajax({
        url: '/pokemon/default',
        method: 'GET',
        success: function(data) {
            displayPokemonInfo(data);
        },
        error: function() {
            $('#pokemon-info').html('<p>Default Pokemon not found</p>');
        }
    });

    // Search button click event
    $('#search-btn').click(function() {
        var pokemonName = $('#pokemon-name').val().toLowerCase();

        $.ajax({
            url: '/pokemon/' + pokemonName,
            method: 'GET',
            success: function(data) {
                displayPokemonInfo(data);
            },
            error: function() {
                $('#pokemon-info').html('<p>Pokemon not found</p>');
            }
        });
    });

    function displayPokemonInfo(data) {
        var infoHtml = '<h2>' + data.name + '</h2>';
        infoHtml += '<img src="' + data.image + '" alt="' + data.name + '">';
        infoHtml += '<p>Height: ' + data.height + '</p>';
        infoHtml += '<p>Weight: ' + data.weight + '</p>';
        infoHtml += '<p>Base Experience: ' + data.base_experience + '</p>';

        $('#pokemon-info').html(infoHtml);
    }
});
