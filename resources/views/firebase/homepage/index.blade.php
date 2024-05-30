@extends('firebase.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if(session('userName'))
                <h1 class="greeting" style="font-family: 'Helvetica', sans-serif; font-weight:550; font-size:30px">
                    Halo, {{ session('userName') }}! Selamat datang kembali di GraDian. Semoga hari Anda menyenangkan!
                </h1>
            @else
                <h1 class="dashboard" style="font-family: 'Roboto', sans-serif;">
                    Welcome to your dashboard.
                </h1>
            @endif
        </div>
    </div>
    
    <div class="row">
        <!-- Sensor Humidity Panel -->
        <div class="row">
            <!-- Sensor Humidity Panel -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Sensor Humidity
                    </div>
                    <div class="card-body text-center">
                        <p class="fw-bold mb-0" style="font-size: 3rem; color:#4d5155;" id="humidity">N/A</p>
                    </div>
                </div>
            </div>
            <!-- Sensor Temperature Panel -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Sensor Temperature
                    </div>
                    <div class="card-body text-center">
                        <p class="fw-bold mb-0" style="font-size: 3rem; color:#4d5155;" id="temperature">N/A</p>
                    </div>
                </div>
            </div>
            <!-- Sensor LDR Panel -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Sensor LDR
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                        <p class="fw-bold mb-0" style="font-size: 3rem; color:#4d5155;" id="ldrValue">N/A</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <canvas id="myChart" width="800" height="400"></canvas>
        </div>
    </div>
</div>

<script>
    // Prepare data for chart
    var dates = [];
    var humidityData = [];
    var temperatureData = [];
    var ldrData = [];
    @for($i = 0; $i < min(count($dataSiram), count($dataLdr)); $i++)
        dates.push("{{ $dataSiram[$i]['logDate'] }}");
        humidityData.push({{ $dataSiram[$i]['humidity'] }});
        temperatureData.push({{ $dataSiram[$i]['temperature'] }});
        ldrData.push({{ $dataLdr[$i]['ldrValue'] }});
    @endfor

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Humidity (%)',
                data: humidityData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Temperature (°C)',
                data: temperatureData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'LDR Value',
                data: ldrData,
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Function to update data
    function updateData() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                updateChart(data);
            }
        };
        xhttp.open("GET", "/sensor-data", true);
        xhttp.send();
    }

   /* function updateChart(data) {
        myChart.data.labels.push(data.logDate);
        myChart.data.datasets[0].data.push(data.humidity);
        myChart.data.datasets[1].data.push(data.temperature);
        myChart.data.datasets[2].data.push(data.ldrValue);
        myChart.update();
    }*/

    setInterval(updateData, 10000);

    // Function to update humidity and temperature
    function updateHumidityAndTemperature() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                updateHumidity(data.humidity);
                updateTemperature(data.temperature);
                updateLdrValue(data.ldrValue);
            }
        };
        xhttp.open("GET", "/sensor-data", true);
        xhttp.send();
    }

    function updateHumidity(humidity) {
        var humidityElement = document.getElementById("humidity");
        humidityElement.textContent = humidity !== undefined ? humidity + "%RH" : "N/A";
    }

    function updateTemperature(temperature) {
        var temperatureElement = document.getElementById("temperature");
        temperatureElement.textContent = temperature !== undefined ? temperature + "°C" : "N/A";
    }

    function updateLdrValue(ldrValue) {
        var ldrValueElement = document.getElementById("ldrValue");
        ldrValueElement.textContent = ldrValue !== undefined ? ldrValue + " LDR" : "N/A";
    }

    setInterval(updateHumidityAndTemperature, 10000);
    updateHumidityAndTemperature();
</script>
@endsection
