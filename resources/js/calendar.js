import { Calendar } from '/node_modules/@fullcalendar/core';
import dayGridPlugin from '/node_modules/@fullcalendar/daygrid';
import interactionPlugin from '/node_modules/@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, interactionPlugin ],
        events: '/api/games-events',  // Ruta para obtener los eventos
        dateClick: function(info) {
            alert('Fecha seleccionada: ' + info.dateStr);
        },
    });

    calendar.render();
});
