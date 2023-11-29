
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
 

 onload =  async (evt)=>{
	

const res = await	   fetch('../php/getRecords.php')
console.log(res)
	const data = await res.json();
	const labels = [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"May",
		"Jun",
		"Jul",
		"Aug",
		"Sep",
		"Oct",
		"Nov",
		"Dec"
	  ];
	  
console.log(data)

var ChartData = Array.from({length:12},(_)=>0)
for (let index = 0; index < 12; index++) {
			const record = data[index]
			
			
if(record != undefined ){
const month = parseInt(record['month']) -1
ChartData[month] = parseInt(record['count'])

console.log(ChartData[month])
}

	
}



	
	console.log(ChartData)
	const canvas =  document.querySelector('canvas')
	console.log(canvas)
	new Chart(canvas, {
		type: 'bar',
		data: {
		  labels: labels,
		  datasets: [{
			label: 'total monthly visits',
			data: ChartData,
			borderWidth: 1
		  }]
		},
		
		options: {
		  scales: {
			y: {
				title: {
					display: true,
					text: 'visits'
				  },
			  beginAtZero: true,
			  ticks: {
				// forces step size to be 50 units
				stepSize: 1
			  }
			},
			
	
		  }
		}
	  });
 }