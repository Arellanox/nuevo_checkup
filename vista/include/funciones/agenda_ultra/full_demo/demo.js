$(document).ready(async function () {
   var MyCalendar = $('#calendar');
   var CalendarItems = {
      events: []
   };

   await getDataAjax();
   async function getDataAjax() {
      $.ajax({
         url: `${localStorage.getItem('http')}${localStorage.getItem('servidor')}/${localStorage.getItem('appname')}/api/agenda_api.php`,
         data: {
            api: 3,
            area_id: localStorage.getItem('areaActual'),
         },
         dataType: 'json',
         type: 'POST',
         success: function (data) {
            data = data.response.data;

            for (const key in data) {
               if (Object.hasOwnProperty.call(data, key)) {
                  const element = data[key];
                  CalendarItems['events'].push({
                     "id": parseInt(element.ID_AGENDA),
                     "start": new Date(element.CITA),
                     "end": new Date(element.FINALIZA),
                     "title": "Paciente: " + element.PACIENTE,
                     readOnly: true
                  });
               }
            }

            calendar(CalendarItems);
         },
         error: function (jqXHR, exception, data) {
            console.log(jqXHR, exception, data)
         },
      });
   }

   function calendar(data = CalendarItems) {
      MyCalendar.weekCalendar({
         timeslotsPerHour: 4,
         allowCalEventOverlap: true,
         overlapEventsSeparate: true,
         firstDayOfWeek: 1,
         businessHours: {start: 7, end: 18, limitDisplay: true},
         daysToShow: 6,
         readonly: true,
         height: function ($calendar) {
            return $(window).height() - $("h1").outerHeight() - 1;
         },
         eventRender: function (calEvent, $event) {
            console.log(calEvent)
            console.log('===========')
            console.log($event)
            if (calEvent.end.getTime() < new Date().getTime()) {
               $event.css("backgroundColor", "#aaa");
               $event.find(".wc-time").css({
                  "backgroundColor": "#999",
                  "border": "1px solid #888"
               });
            }
         },
         draggable: function (calEvent, $event) {
            return calEvent.readOnly != true;
         },
         resizable: function (calEvent, $event) {
            return calEvent.readOnly != true;
         },
         data: data ?? CalendarItems
      });
   }

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }

   function getEventData() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var day = new Date().getDate();

      return {
         events: [
            {
               "id": 1,
               "start": new Date(year, month, day, 12),
               "end": new Date(year, month, day, 13, 30),
               "title": "Lunch with Mike",
               readOnly: true
            },
            {
               "id": 2,
               "start": new Date(year, month, day, 14),
               "end": new Date(year, month, day, 14, 45),
               "title": "Dev Meeting",
               readOnly: true
            },
            {
               "id": 3,
               "start": new Date(year, month, day + 1, 17),
               "end": new Date(year, month, day + 1, 17, 45),
               "title": "Hair cut",
               readOnly: true
            },
            {
               "id": 4,
               "start": new Date(year, month, day - 1, 8),
               "end": new Date(year, month, day - 1, 9, 30),
               "title": "Team breakfast",
               readOnly: true
            },
            {
               "id": 5,
               "start": new Date(year, month, day + 1, 14),
               "end": new Date(year, month, day + 1, 15),
               "title": "Product showcase",
               readOnly: true
            },
            {
               "id": 6,
               "start": new Date(year, month, day, 10),
               "end": new Date(year, month, day, 11),
               "title": "I'm read-only",
               readOnly: true
            }

         ]
      };
   }

   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function () {
      var startTime = $(this).find(":selected").val();
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
          $endTimeOptions.filter(function () {
             return startTime < $(this).val();
          })
      );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function () {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });


   var $about = $("#about");

   $("#about_button").click(function () {
      $about.dialog({
         title: "About this calendar demo",
         width: 600,
         close: function () {
            $about.dialog("destroy");
            $about.hide();
         },
         buttons: {
            close: function () {
               $about.dialog("close");
            }
         }
      }).show();
   });

   function formatoFecha2(fecha, optionsDate = [3, 1, 2, 2, 1, 1, 1], formatMat = 'best fit') {
      if (fecha == null)
         return '';
      // //console.log(fecha)
      let options = {
         hour12: true,
         timeZone: 'America/Mexico_City'
      } // p.m. - a.m.

      switch (optionsDate[0]) { //Dia de la semana
         case 1:
            options['weekday'] = "narrow";
            break; // S
         case 2:
            options['weekday'] = "short";
            break; // Sáb
         case 3:
            options['weekday'] = "long";
            break; // Sábado
      }
      switch (optionsDate[1]) { //año
         case 1:
            options['year'] = "numeric";
            break; // 2022
         case 2:
            options['year'] = "2-digit";
            break; // 22
      }
      switch (optionsDate[2]) { //Mes
         case 1:
            options['month'] = "narrow";
            break; // N
         case 2:
            options['month'] = "short";
            break; // Nov
         case 3:
            options['month'] = "long";
            break; // Noviembre
         case 4:
            options['month'] = "numeric";
            break; // /11/
         case 5:
            options['month'] = "2-digit";
            break; // 11
      }
      switch (optionsDate[3]) { //Dia
         case 1:
            options['day'] = "numeric";
            break;
         case 2:
            options['day'] = "2-digit";
            break;
      }
      switch (optionsDate[4]) { //Hora
         case 1:
            options['hour'] = "numeric";
            break;
         case 2:
            options['hour'] = "2-digit";
            break;
      }
      switch (optionsDate[5]) { //Minutos
         case 1:
            options['minute'] = "numeric";
            break;
         case 2:
            options['minute'] = "2-digit";
            break;
      }
      switch (optionsDate[6]) { //Segundos
         case 1:
            options['seconds'] = "numeric";
            break;
         case 2:
            options['seconds'] = "2-digit";
            break;
      }
      let date;
      if (fecha.length == 10) {
         date = new Date(fecha + 'T00:00:00')
      } else {
         date = new Date(fecha)
      }

      // //console.log(date)
      return date.toLocaleDateString('es-MX', options)
   }
});