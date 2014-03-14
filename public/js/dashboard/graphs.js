$(function() {
  var today = new Date();

  defaultMinDate = new Date(2014, today.getMonth() - 1, 1);
  defaultMaxDate = new Date(2014, today.getMonth(), today.getDate());
  var dateFrom = defaultMinDate.getFullYear() + "-" + (defaultMinDate.getMonth() + 1) + "-" + defaultMinDate.getDate();
  var dateTo = defaultMaxDate.getFullYear() + "-" + (defaultMaxDate.getMonth() + 1) + "-" + defaultMaxDate.getDate();
  updateGraphs(dateFrom, dateTo);

  var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
  $('#date-slider').dateRangeSlider(
          {
            bounds: {
              min: new Date(today.getFullYear() - 1, today.getMonth(), 1),
              max: new Date(today.getFullYear(), today.getMonth(), today.getDate())
            },
            defaultValues: {
              min: defaultMinDate,
              max: defaultMaxDate
            },
            wheelMode: "scroll",
            scales: [{
                first: function(value) {
                  return value;
                },
                end: function(value) {
                  return value;
                },
                next: function(value) {
                  var next = new Date(value);
                  return new Date(next.setMonth(value.getMonth() + 1));
                },
                label: function(value) {
                  return months[value.getMonth()];
                }
              }]
          });

  $("#date-slider").bind("valuesChanged", function(e, d) {
    var dateFrom = new Date(d.values.min);
    var dateTo = new Date(d.values.max);
    var dateFromStr = dateFrom.getFullYear() + "-" + (dateFrom.getMonth() + 1) + "-" + dateFrom.getDate();
    var dateToStr = dateTo.getFullYear() + "-" + (dateTo.getMonth() + 1) + "-" + dateTo.getDate();
    updateGraphs(dateFromStr, dateToStr);
  });



});

function updateGraphs(dateFromStr, dateToStr)
{
  var ps = "dateFrom=" + dateFromStr + "&dateTo=" + dateToStr;
  $.ajax({
    url: "/api/v1/commits?" + ps,
    success: function(data) {
      var xkey = data['xkey'];
      var ykeys = data['ykeys'];
      var labels = data['labels'];
      var xs = data['xs'];
      $("#commit-chart-wrapper").empty();
      $("#commit-chart-wrapper").append('<div id="commit-chart"></div>');
      Morris.Area({
        element: 'commit-chart',
        data: xs,
        xkey: xkey,
        ykeys: ykeys,
        labels: labels,
        pointSize: 2,
        hideHover: 'auto',
        resize: true
      });
    }
  });
  $.ajax({
    url: "/api/v1/stats?" + ps,
    success: function(data) {
      var a = data['ave'];
      var v = data['var'];
      var m = data['max'];
      var s = data['sum'];
      $('#s_val_ave').text(a);
      $('#s_val_var').text(v);
      $('#s_val_max').text(m);
      $('#s_val_sum').text(s);
    }
  });
}
