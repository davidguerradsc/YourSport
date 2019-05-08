
$(function() {

    // GetJSON
    $.getJSON('https://ipapi.co/json/', function(data) {
        // console.log( data );
        $(`
                    <div class="ipapi">
                    <p>
                        Tout abus du formulaire de contact pourra entraîner un ban IP.<br />
                        Votre IP : ${data.ip}
                        <br/> ${data.city} - ${data.region}
                    </p>
                    </div>
                `)
            .css({ 'color':'grey', 'font-size':'15px'})
            .appendTo( $('form[name=contact_form]') );
    });

});