jQuery( document ).ready(function() {
    jQuery('#date_listevents').daterangepicker({
        locale: {
            format:         'DD/MM/YYYY',
            applyLabel:     'Buscar',
            cancelLabel:    'Cancelar',
            daysOfWeek: [
                "Do",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            monthNames: [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
        }
    });

    getEvents();

    jQuery('#date_listevents').on('apply.daterangepicker', function(ev, picker) {
        getEvents();
    });
});

function getEvents(){
    jQuery('.list_spaces').html('');
    jQuery('#loading').show('fast');

    var date_listevents = jQuery('#date_listevents').data('daterangepicker');

    var url = jQuery('#date_listevents').data('url')                 +
        '&@from='   + date_listevents.startDate.format('YYYY-MM-DD') +
        '&@to='     + date_listevents.endDate.format('YYYY-MM-DD');

    console.log(url);

    jQuery('#date_listevents span').html(date_listevents.startDate.format('DD/MM/YYYY') + ' - ' + date_listevents.endDate.format('DD/MM/YYYY'));

    jQuery.ajax({
        url: url,
        type: 'GET',
        data: {},
        success: function(response) {
            console.log(response);
            showEvents(response);
        }
    });
}

function showEvents(events){
    jQuery('#loading').hide('fast');

    html = '';
    for (var i = 0; i < events.length; i++) {
        if(typeof events[i]['@files:avatar.avatarBig'] != 'undefined')
            thumb = '<img src="' + events[i]['@files:avatar.avatarBig'].url + '" style="float: left;">';
        else
            thumb = '';

        spaces = new Array();

        html += `<div class="list_events_item">
            <h3>` + events[i].name + `</h3>
            <p>` + thumb + events[i].shortDescription + `</p>`;

            for (var y = 0; y < events[i].occurrences.length; y++) {

                console.log(events[i].occurrences[y].space.id + '-' +events[i].occurrences[y].space.name);
                //spaces.push[events[i].occurrences[y].space.id]

                html += `<div>
                            <strong>` + events[i].occurrences[y].space.name + `</strong>` +
                                `<ul><li>` +
                             events[i].occurrences[y].space.endereco +
                            `</li><li>` +
                             events[i].occurrences[y].rule.description + `, ` + events[i].occurrences[y].rule.price +
                        `</li></ul></div>`;
            }

            html += `</ul></div>`;

    }

    jQuery('.list_spaces').append(html);
}
