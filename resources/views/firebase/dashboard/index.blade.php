@extends("firebase.app")

@section('content')
    <div class="container mt-5">
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
            

        <!-- Table - LDR Values -->
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal dan Waktu</th>
                            <th>LDR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1; @endphp
                        @foreach(array_slice($dataLdr, 0, 5) as $document)

                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $document['logDate'] }}</td>
                            <td>{{ $document['ldrValue'] }} LDR</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table - Humidity and Temperature Values -->
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal dan Waktu</th>
                            <th>Humidity</th>
                            <th>Temperature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1; @endphp
                        @foreach(array_slice($dataSiram, 0, 5) as $document)

                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $document['logDate'] }}</td>
                            <td>{{ $document['humidity'] }} %RH</td>
                            <td>{{ $document['temperature'] }}°C</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
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
