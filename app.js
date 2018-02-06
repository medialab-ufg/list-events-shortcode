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
        html += '<div class="list_events_item"><h3>' + events[i].name + '</h3>';
        html += '<p>' + events[i].shortDescription + '</p>';
        html += '<span>Local: ' + events[i].occurrences[0].space.name + events[i].occurrences[0].space.endereco + '</span>';
        html += '<hr></div>';
    }

    jQuery('.list_spaces').append(html);
}
