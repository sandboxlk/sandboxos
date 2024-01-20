$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        navLinks: true, 
        editable: true,
        eventLimit: true,
        events: 'fetch-events.php' // PHP script to fetch the events
    });
});
        




