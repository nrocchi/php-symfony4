$('#ad_image').click(function(){
    // On récup l'index du champ à créer
    const index = +$('#widgets_counter').val();

    //on récup le data prototype et on replace le name par l'index du champ à créer
    const tmpl = $('#ad_images').data('prototype').replace(/__name__/g, index);

    // On injecte le champ à la suite des autres champs images
    $('#ad_images').append(tmpl);

    // On init le counter du champ caché
    $('#widgets_counter').val(index + 1);

    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function() {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#ad_images div.form-group').length;
    $('#widgets_counter').val(count);
}

updateCounter();
handleDeleteButtons();