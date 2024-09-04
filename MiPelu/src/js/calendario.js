var a;

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "timeGridWeek",
    locale: "es",
    editable: false,
    selectable: false,
    allDaySlot: false,
    events: "./mostrarCita.php",
    dateClick: function (info) {
      a = info.dateStr;
     
      const fechaCadena = a;
      var numeroDia = new Date(fechaCadena).getDay();
      var numeroMes = new Date(fechaCadena).getMonth();

      var numeroHora = new Date(fechaCadena).getHours();
      var numerominutos = new Date(fechaCadena).getMinutes();
      var nombresMeses = [
        "Enero", "Febrero", "Marzo", "Abril",
        "Mayo", "Junio", "Julio", "Agosto",
        "Septiembre", "Octubre", "Noviembre", "Diciembre"
      ];
     
      var dias = ["Martes", "Miercoles", "jueves", "viernes", "Sabado"];
      if (
        numeroHora < 9 ||
        numeroHora > 17 ||
        numeroDia == 0 ||
        numeroDia == 1
      ) {
        alert("Establecimiento cerrado");
      } else {
        $("#modal_reservas").modal("show");
        numReal = numeroDia - 2;
        
        $("#diaSemana").html(dias[numReal] + " " + numeroDia+"-"+nombresMeses[numeroMes]+-+numeroHora+":"+numerominutos);
      }
      
    },
  });
  calendar.render();
});
console.log(a);
