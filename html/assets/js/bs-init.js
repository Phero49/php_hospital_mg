
const data = [
	"0",
	"10000",
	"5000",
	"15000",
	"10000",
	"20000",
	"15000",
	"25000"
 ];
const setting = {
	"type":"line",
	"data":{
	   "labels":[
		  "Jan",
		  "Feb",
		  "Mar",
		  "Apr",
		  "May",
		  "Jun",
		  "Jul",
		  "Aug"
	   ],
	   "datasets":[
		  {
			 "label":"Earnings",
			 "fill":true,
			 "data":data,
			 "backgroundColor":"rgba(78, 115, 223, 0.05)",
			 "borderColor":"rgba(78, 115, 223, 1)"
		  }
	   ]
	},
	"options":{
	   "maintainAspectRatio":false,
	   "legend":{
		  "display":false,
		  "labels":{
			 "fontStyle":"normal"
		  }
	   },
	   "title":{
		  "fontStyle":"normal"
	   },
	   "scales":{
		  "xAxes":[
			 {
				"gridLines":{
				   "color":"rgb(234, 236, 244)",
				   "zeroLineColor":"rgb(234, 236, 244)",
				   "drawBorder":false,
				   "drawTicks":false,
				   "borderDash":["2"],
				   "zeroLineBorderDash":["2"],
				   "drawOnChartArea":false
				},
				"ticks":{
				   "fontColor":"#858796",
				   "fontStyle":"normal",
				   "padding":20
				}
			 }
		  ],
		  "yAxes":[
			 {
				"gridLines":{
				   "color":"rgb(234, 236, 244)",
				   "zeroLineColor":"rgb(234, 236, 244)",
				   "drawBorder":false,
				   "drawTicks":false,
				   "borderDash":["2"],
				   "zeroLineBorderDash":["2"]
				},
				"ticks":{
				   "fontColor":"#858796",
				   "fontStyle":"normal",
				   "padding":20
				}
			 }
		  ]
	   }
	}
 }
 

 onload = (evt)=>{
	const canvas =  document.querySelector('canvas')
	console.log(canvas)
	new Chart(canvas, {
		type: 'bar',
		data: {
		  labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
		  datasets: [{
			label: '# of Votes',
			data: [12, 19, 3, 5, 2, 3],
			borderWidth: 1
		  }]
		},
		options: {
		  scales: {
			y: {
			  beginAtZero: true
			}
		  }
		}
	  });
 }