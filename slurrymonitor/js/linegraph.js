$(document).ready(function(){
	$.ajax({
		url : "followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var timestamp = [];
			var value1 = [];
			//var value2 = [];

			for(var i in data) {
				timestamp.push(data[i].time);
				value1.push(data[i].level);
				// value2.push(data[i].value2);
			}

			var chartdata = {
				labels: timestamp,
				datasets: [
					{
						label: "Slurry Store Level (mm)",
						fill: true,
						lineTension: 0.1,
						backgroundColor: "rgba(139, 69, 19, 0.75)",
						borderColor: "rgba(139, 69, 19, 1)",
						pointRadius: 0,
						pointHoverBackgroundColor: "rgba(139, 69, 19, 1)",
						pointHoverBorderColor: "rgba(139, 69, 19, 1)",
						data: value1
					},
	//				{
	//					label: "Humidity",
	//					fill: false,
	//					lineTension: 0.1,
	//					backgroundColor: "rgba(51, 153, 255, 0.75)",
	//					borderColor: "rgba(51, 153, 255,, 1)",
	//					pointRadius: 0,
	//					pointHoverBackgroundColor: "rgba(51, 153, 255, 1)",
	//					pointHoverBorderColor: "rgba(51, 153, 255, 1)",
	//					data: value2
	//				}
				]


			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
					scales: {
	            yAxes: [{
	                ticks: {
	                    suggestedMin: 0,
	                    suggestedMax: 2400
	                }
	            }]

	        },

        	title: {
            display: false,
            text: 'Slurry Store Level'
        },
				annotation: {
					annotations: [{
						type: 'line',
						mode: 'horizontal',
						scaleID: 'y-axis-0',
						value: 2400,
						borderColor: 'rgb(255, 0, 0)',
						borderWidth: 4,
						label: {
							enabled: true,
							content: 'Tank Capacity 2400mm'
										}
											}]
										}


    }
			});
		},
		error : function(data) {

		}
	});
});
