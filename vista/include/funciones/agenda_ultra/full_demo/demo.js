$(document).ready(function () {


   var $calendar = $('#calendar');
   var id = 10;

   $calendar.weekCalendar({
      timeslotsPerHour: 4,
      allowCalEventOverlap: true,
      overlapEventsSeparate: true,
      firstDayOfWeek: 1,
      businessHours: { start: 8, end: 18, limitDisplay: true },
      daysToShow: 7,
      readonly: true,
      height: function ($calendar) {
         return $(window).height() - $("h1").outerHeight() - 1;
      },
      eventRender: function (calEvent, $event) {
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
      eventNew: function (calEvent, $event) {
      },
      eventDrop: function (calEvent, $event) {
         return false
      },
      eventResize: function (calEvent, $event) {
         return false
      },
      eventClick: function (calEvent, $event) {

      },
      eventMouseover: function (calEvent, $event) {
      },
      eventMouseout: function (calEvent, $event) {
      },
      noEvents: function () {

      },
      data: async function (start, end, callback) {
         callback(await getEventData());
      }
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }

   async function getEventData() {
      return new Promise(resolve => {
         var year = new Date().getFullYear();
         var month = new Date().getMonth();
         var day = new Date().getDate();

         //Ajax


         resolve({
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
         }
         )
      })





      return {

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


});