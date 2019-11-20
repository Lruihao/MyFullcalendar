$(function () {
  $('#calendar').fullCalendar({
//    plugins: ['interaction', 'dayGrid', 'timeGrid'],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    events: 'json.php',
    dayClick: function (date, allDay, jsEvent, view) {
      var selDate = $.fullCalendar.formatDate(date, 'yyyy-MM-dd');
      $.fancybox({
        'type': 'ajax',
        'href': 'event.php?action=add&date=' + selDate
      });
    },
    eventClick: function (calEvent, jsEvent, view) {
      $.fancybox({
        'type': 'ajax',
        'href': 'event.php?action=edit&id=' + calEvent.id
      });
    }
  });
});


