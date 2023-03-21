var data = document.getElementById('pie');

function vb(vb) {
	return data.getAttribute("data-" + vb);
}
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
	labels: [vb("rezl1"), vb("rezl2"), vb("rezl3"), vb("rezl4"), vb("rezl5")],
	datasets: [{
	  data: [vb("rezp1"), vb("rezp2"), vb("rezp3"), vb("rezp4"), vb("rezp5")],
	  backgroundColor: ['#0066ff', '#ff6600', '#66ff33', '#cc00cc', '#cc00cc'],
	  hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#17a63', '#2c9af'],
	  hoverBorderColor: "rgba(234, 236, 244, 1)",
	}],
  },
  options: {
	maintainAspectRatio: false,
	tooltips: {
	  backgroundColor: "rgb(255,255,255)",
	  bodyFontColor: "#858796",
	  borderColor: '#dddfeb',
	  borderWidth: 1,
	  xPadding: 15,
	  yPadding: 15,
	  displayColors: false,
	  caretPadding: 5,
	},
	legend: {
	  display: false
	},
	cutoutPercentage: 30,
  },
});
