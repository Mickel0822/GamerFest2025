import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

// Asegúrate de importar los estilos correctamente
import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const events = JSON.parse(calendarEl.dataset.events || '[]'); // Obtiene eventos desde data-events
        console.log("Eventos del calendario:", events);

        // Inicializar FullCalendar
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin], // Usa el nombre correcto del plugin
            initialView: 'dayGridMonth', // Vista inicial
            events: events, // Carga los eventos en el calendario
        });

        calendar.render(); // Renderiza el calendario
    }
});



