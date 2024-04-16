@extends("firebase.app")

@section('content')
<main>
    <div class="container-fluid"style="margin-top: 20px;">
        <!-- Panels -->
        <div class="row">
            <div class="col-8" style="font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:#4d5155;">DATA SUHU DAN KELEMBAPAN</div>
            <div class="col-4" style="position: relative;">
                <a href="/riwayatsiram" style="position: absolute; top: 0; right: 0; text-decoration: none;">
                    <button type="button" id="historyButton" style="border: none; background: #7d52a0; color: white; cursor: pointer; font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight: 900;">&gt;&gt;&gt;</button>
                </a>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <!-- Panel 1 -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Sensor Humidity
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white a">
                        <p class="fw-bold mb-0" style="font-size: 3rem; color:#4d5155;" id="humidity"></p>
                    </div>
                    <script>
                    function updateHumidity() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var humidityData = JSON.parse(this.responseText);
                                var humidityElement = document.getElementById("humidity");
                                if (humidityData.hasOwnProperty("humidity")) {
                                    humidityElement.textContent = humidityData.humidity + "%RH";
                                } else {
                                    humidityElement.textContent = "N/A";
                                }
                            }
                        };
                        xhttp.open("GET", "/sensor-data", true);
                        xhttp.send();
                    }
                    setInterval(updateHumidity, 10000);
                    updateHumidity();
                    </script>
                </div>
            </div>
            <!-- Panel 2 -->
            <div class="col-md-6">
                <div class="card mb-4" >
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Sensor Temperature
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white a">
                        <p class="fw-bold mb-0" style="font-size: 3rem; color:#4d5155;" id="temperature"></p>
                    </div>
                    <script>
                        function updateTemperature() {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    var temperatureData = JSON.parse(this.responseText);
                                    var temperatureElement = document.getElementById("temperature");
                                    if (temperatureData.hasOwnProperty("temperature")) {
                                        temperatureElement.textContent = temperatureData.temperature+ "°C";
                                    } else {
                                        temperatureElement.textContent = "N/A";
                                    }
                                }
                            };
                            xhttp.open("GET", "/sensor-data", true);
                            xhttp.send();
                        }
                
                        setInterval(updateTemperature, 10000);
                
                        updateTemperature();
                    </script>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8" style="font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:#4d5155;">KONTROLING PENYIRAMAN</div>
            <div class="col-4" style="position: relative;">
                <a href="riwayatpenyiraman" style="text-decoration: none;">
                    <button type="button" id="historyButton" style="position: absolute; top: 0; right: 0; border: none; background: #7d52a0; color: white; cursor: pointer; font-family: 'Open sans', sans-serif; font-size: 0.9rem; font-weight: 900;">Histori Penyiraman&gt;&gt;&gt;</button>
                </a>
            </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">
            <!-- Panel 1 -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Tombol Manual Penyiraman
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                       
                        <button type="button" class="irrigation-button">
                            <span class="button-icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="24px" height="24px" viewBox="0 0 460.688 460.688" style="enable-background:new 0 0 460.688 460.688;"
                                    xml:space="preserve">
                                    <g>
                                        <path fill="#ffffff" d="M451.033,32.646c-15.09-28.506-44.849-36.768-74.349-21.143c-19.105,10.117-27.674,26.67-30.532,43.739l-10.48-18.484
                                            c-4.322-8.166-15.013-14.535-22.061-10.806l-140.406,74.32c-7.048,3.729-7.793,16.151-3.471,24.317l22.49,46.302l-118.642-22.51
                                            c-1.052-11.513-4.619-19.354-10.155-20.024c-7.956-0.966-16.208,14.296-18.57,33.794c-2.371,19.479,2.219,36.194,10.174,37.15
                                            c6.087,0.741,12.389-7.89,16.086-20.705l161.021,74.6l24.93,51.8c4.321,8.166,12.871,10.5,19.919,6.77l153.172-81.08
                                            c7.048-3.729,9.926-12.106,5.613-20.272l-15.177-26.192c4.169-21.085,13.005-38.03,21.277-55.243
                                            C456.58,98.331,470.694,69.777,451.033,32.646z M409.513,165.134L363.077,84.6c-3.156-17.27-3.634-45.068,21.42-58.331
                                            c21.64-11.456,41.052-6.005,51.953,14.573c15.711,29.682,4.695,52.622-9.247,81.664
                                            C421.007,135.396,414.438,149.375,409.513,165.134z"/>
                                        <path fill="#ffffff" d="M66.936,409.169c5.288,0,9.562-4.284,9.562-9.562V256.169c0-5.278-4.274-9.562-9.562-9.562s-9.562,4.283-9.562,9.562
                                            v143.438C57.374,404.885,61.648,409.169,66.936,409.169z"/>
                                        <path fill="#ffffff" d="M9.562,409.169c5.288,0,9.562-4.284,9.562-9.562V227.481c0-5.278-4.274-9.562-9.562-9.562S0,222.204,0,227.481v172.125
                                            C-0.001,404.885,4.273,409.169,9.562,409.169z"/>
                                        <path fill="#ffffff" d="M38.249,294.419c5.288,0,9.562-4.284,9.562-9.562v-57.375c0-5.278-4.274-9.562-9.562-9.562s-9.562,4.284-9.562,9.562
                                            v57.375C28.686,290.135,32.961,294.419,38.249,294.419z"/>
                                        <path fill="#ffffff" d="M38.249,370.919c5.288,0,9.562-4.284,9.562-9.562v-47.812c0-5.277-4.274-9.562-9.562-9.562s-9.562,4.285-9.562,9.562
                                            v47.812C28.686,366.635,32.961,370.919,38.249,370.919z"/>
                                        <path fill="#ffffff" d="M38.249,447.419c5.288,0,9.562-4.284,9.562-9.562v-47.812c0-5.278-4.274-9.562-9.562-9.562s-9.562,4.283-9.562,9.562
                                            v47.812C28.686,443.135,32.961,447.419,38.249,447.419z"/>
                                        <path fill="#ffffff" d="M57.374,447.419c0,5.279,4.274,9.562,9.562,9.562s9.562-4.284,9.562-9.562v-19.125c0-5.278-4.274-9.562-9.562-9.562
                                            s-9.562,4.284-9.562,9.562V447.419z"/>
                                        <path fill="#ffffff" d="M9.562,456.982c5.288,0,9.562-4.284,9.562-9.562v-19.125c0-5.278-4.274-9.562-9.562-9.562S0,423.016,0,428.294v19.125
                                            C-0.001,452.699,4.273,456.982,9.562,456.982z"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="button-text">Semportan Air</span>
                          </button>
                          <script>
                            
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelector('.irrigation-button').addEventListener('click', function() {
                                    fetch("/update-firebase", {
                                        method: 'PATCH',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        body: JSON.stringify({}),
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        alert('Semprotan air dihidupkan');
                                    })
                                    .catch(error => {
                                        console.error('There was an error with the fetch operation:', error);
                                        alert('Failed to update Firebase');
                                    });
                                });
                            });
                        </script>
                        </div>
                </div>
            </div>
            <!-- Panel 2 -->
            <div class="col-md-6">
                <div class="card mb-4" >
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Tombol Automatisasi Penyiraman
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                        <input type="checkbox" class="switch_1" <?php echo $isChecked ? 'checked' : ''; ?>>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                              var checkboxes = document.querySelectorAll('.switch_1');
                              checkboxes.forEach(function(checkbox) {
                                  checkbox.addEventListener('change', function() {
                                      var isChecked = this.checked;
                                      var xhr = new XMLHttpRequest();
                                      xhr.open('POST', "/updatesiramauto", true);
                                      xhr.setRequestHeader('Content-Type', 'application/json');
                                      xhr.onreadystatechange = function() {
                                          if (xhr.readyState === XMLHttpRequest.DONE) {
                                              if (xhr.status === 200) {
                                                  console.log(xhr.responseText);
                                                  var response = JSON.parse(xhr.responseText);
                                                  if (isChecked) {
                                                      var activationMessage = "Otomatisasi Diaktifkan";
                                                      if (response.alertMessage) {
                                                          activationMessage += "\n" + response.alertMessage;
                                                      }
                                                      alert(activationMessage);
                                                  } else {
                                                      alert("Otomatisasi Dinonaktifkan");
                                                  } 
                                              } else {
                                                  console.error('Request failed: ' + xhr.status);
                                              }
                                          }
                                      };
                                      xhr.send(JSON.stringify({ isChecked: isChecked }));
                                  });
                              });
                          });

                      </script>
                        <style>
                            
                        .wrapper{
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            width: 400px;
                            margin: 50vh auto 0;
                            -ms-flex-wrap: wrap;
                                flex-wrap: wrap;
                            -webkit-transform: translateY(-50%);
                                    transform: translateY(-50%);
                        }
                        
                        .switch_box{
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            max-width: 200px;
                            min-width: 200px;
                            height: 200px;
                            -webkit-box-pack: center;
                                -ms-flex-pack: center;
                                    justify-content: center;
                            -webkit-box-align: center;
                                -ms-flex-align: center;
                                    align-items: center;
                            -webkit-box-flex: 1;
                                -ms-flex: 1;
                                    flex: 1;
                        }
                        
                        /* Switch 1 Specific Styles Start */
                        
                        .box_1{
                            background: #eee;
                        }
                        
                        input[type="checkbox"].switch_1{
                            font-size: 30px;
                            -webkit-appearance: none;
                               -moz-appearance: none;
                                    appearance: none;
                            width: 3.5em;
                            height: 1.5em;
                            background: #ddd;
                            border-radius: 3em;
                            position: relative;
                            cursor: pointer;
                            outline: none;
                            -webkit-transition: all .2s ease-in-out;
                            transition: all .2s ease-in-out;
                          }
                          
                          input[type="checkbox"].switch_1:checked{
                            background: #7d52a0;
                          }
                          
                          input[type="checkbox"].switch_1:after{
                            position: absolute;
                            content: "";
                            width: 1.5em;
                            height: 1.5em;
                            border-radius: 50%;
                            background: #fff;
                            -webkit-box-shadow: 0 0 .25em rgba(0,0,0,.3);
                                    box-shadow: 0 0 .25em rgba(0,0,0,.3);
                            -webkit-transform: scale(.7);
                                    transform: scale(.7);
                            left: 0;
                            -webkit-transition: all .2s ease-in-out;
                            transition: all .2s ease-in-out;
                          }
                          
                          input[type="checkbox"].switch_1:checked:after{
                            left: calc(100% - 1.5em);
                          }
                            
                        /* Switch 1 Specific Style End */
                        
                        
                        </style>
                      </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
@endsection