 const datai = {
    labels: [
      'Red',
      'Blue',
      'Yellow'
    ],
    datasets: [{
      label: 'My First Dataset',
      data: [300, 50, 100],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 4
    }]
  };


  onload = async (evt)=>{
    const res = await	   fetch('../php/getBalance.php')
	const data = await res.json();
    let labels = []
    let dataValue = []
   data.forEach(element => {
console.log(element)
    labels.push(element['service_name'])
    dataValue.push(element['total'])
   })
   const el =  document.querySelector('#total')
   const sum =dataValue.reduce((p,c)=>parseFloat( p)+ parseFloat(c),0)
   console.log(el)
   el.innerHTML = sum
    const canvas =  document.querySelector('canvas')
    new Chart(canvas, {
		type: 'bar',
		data: {
		  labels: labels,
		  datasets: [{
			label: 'total cost break down',
			data: dataValue,
			borderWidth: 1
		  }]
		},
		
		options: {
		  scales: {
			y: {
				title: {
					display: true,
					text: 'Total bill'
				  },
			  beginAtZero: true,
			  ticks: {
				// forces step size to be 50 units
				//stepSize: 1
			  }
			},x: {
				title: {
					display: true,
					text: 'services'
				  },
			  beginAtZero: true,
			  ticks: {
				// forces step size to be 50 units
				//stepSize: 1
			  }
			},
			
	
		  }
		}
	  });
  
  }

 