document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "timeGridWeek",
    locale: "es",
    editable: false,
    selectable: false,
    allDaySlot: false,
    events: "./mostrarCita.php",
    eventMaxStack: 3, // Aquí puedes ajustar el número según tu preferencia
    dateClick: function (info) {
      a = info.dateStr;
      const fechaCadena = a;
      var dateObj = new Date(fechaCadena);
      var numeroDia = dateObj.getDay();
      var numeroMes = dateObj.getMonth();
      var numeroHora = dateObj.getHours();
      var numerominutos = dateObj.getMinutes();

      var nombresMeses = [
        "Enero", "Febrero", "Marzo", "Abril",
        "Mayo", "Junio", "Julio", "Agosto",
        "Septiembre", "Octubre", "Noviembre", "Diciembre"
      ];

      var dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
      
      if (numeroHora < 9 || numeroHora > 19 || numeroDia === 0 || numeroDia === 1) {
        alert("Establecimiento cerrado");
      } else {
        $("#modal_reservas").modal("show");
        var displayHour = numeroHora < 10 ? '0' + numeroHora : numeroHora;
        var displayMinutes = numerominutos < 10 ? '0' + numerominutos : numerominutos;
        hora = displayHour + ":" + displayMinutes;
        
        $("#diaSemana").html(dias[numeroDia] + " " + dateObj.getDate() + " de " + nombresMeses[numeroMes] + " a las " + hora);
      }
    },
    eventClick: function (info) {
      // Extraer la hora de inicio del evento
      var eventStart = new Date(info.event.start);
      var eventHour = eventStart.getHours();
      var eventMinutes = eventStart.getMinutes();
      var displayHour = eventHour < 10 ? '0' + eventHour : eventHour;
      var displayMinutes = eventMinutes < 10 ? '0' + eventMinutes : eventMinutes;
      var eventTime = displayHour + ":" + displayMinutes;
    
      // Mostrar los detalles del evento en el modal
      $("#modal_show").modal("show");
      
      // Obtener el contenedor donde se mostrarán los detalles del evento
      var modalBody = $("#modal_show").find(".modal-body");
    
      // Construir el contenido del modal con los detalles del evento
      var eventDetails = "<p>Fecha: " + info.event.start.toLocaleDateString() + "</p>";
      eventDetails += "<p>Hora: " + eventTime + "</p>";
      eventDetails += "<p>Observaciones: " + info.event.title + "</p>";
    
      // Actualizar el contenido del modal con los detalles del evento
      modalBody.html(eventDetails);
    
      // Opcionalmente, cambiar el color del borde del evento clicado
      info.el.style.borderColor = 'red';
    }
    
  });
  calendar.render();
});
