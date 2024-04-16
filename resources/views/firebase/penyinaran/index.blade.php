@extends("firebase.app")

@section('content')
<main>
    <div class="container-fluid"style="margin-top: 20px;">
        <!-- Panels -->
        <div class="row">
            <div class="col-8" style="font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:#4d5155;">DATA INTENSITAS CAHAYA</div>
            <div class="col-4" style="position: relative;">
                <button type="button" id="historyButton" style="position: absolute; top: 0; right: 0; border: none; background: #7d52a0; cursor: pointer; font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color: white;"> &gt;&gt;&gt;</button>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <!-- Panel 1 -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Sensor LDR
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                        <p class="fw-bold mb-0" style="font-size: 3rem; color:#4d5155;" id="ldrValue"></p>
                    </div>
                    <script>
                    function updateLdrValue() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var ldrValueData = JSON.parse(this.responseText);
                                var ldrValueElement = document.getElementById("ldrValue");
                                if (ldrValueData.hasOwnProperty("ldrValue")) {
                                    ldrValueElement.textContent = ldrValueData.ldrValue+ "LDR";
                                } else {
                                    ldrValueElement.textContent = "N/A";
                                }
                            }
                        };
                        xhttp.open("GET", "/sensor-data", true);
                        xhttp.send();
                    }
                    setInterval(updateLdrValue, 10000);
                    updateLdrValue();
                    </script>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8" style="font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:#4d5155;">KONTROLING PENYINARAN</div>
            <div class="col-4" style="position: relative;">
                <button type="button" id="historyButton" style="position: absolute; top: 0; right: 0; border: none; background: #7d52a0; color: #000; cursor: pointer; font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:white;">Histori Penyinaran&gt;&gt;&gt;</button>
            </div>
        </div>
        
        <div class="row" style="margin-top: 20px;">
            <!-- Panel 1 -->
            <div class="col-md-6">
                <div class="card mb-4 " >
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Tombol Manual Lampu
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                             var checkboxes = document.querySelectorAll('.switch_2');
                             checkboxes.forEach(function(checkbox) {
                                 checkbox.addEventListener('change', function() {
                                     var isChecked = this.checked;

                                     var xhr = new XMLHttpRequest();
                                     xhr.open('POST', "/updatesinar", true);
                                     xhr.setRequestHeader('Content-Type', 'application/json');
                                     xhr.onreadystatechange = function() {
                                         if (xhr.readyState === XMLHttpRequest.DONE) {
                                             if (xhr.status === 200) {
                                                 console.log(xhr.responseText);
                                                 if (isChecked) {
                                                        alert("Lampu UV dihidupkan");
                                                    } else {
                                                        alert("Lampu UV dimatikan");
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
                    <input type="checkbox" class="switch_2" <?php echo $isChecked2 ? 'checked' : ''; ?>>
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
               
               input[type="checkbox"].switch_2{
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
                 
                 input[type="checkbox"].switch_2:checked{
                   background: #FFFF99;
                 }
                 
                 input[type="checkbox"].switch_2:after{
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
                 
                 input[type="checkbox"].switch_2:checked:after{
                   left: calc(100% - 1.5em);
                 }
                   
               /* Switch 1 Specific Style End */
               
               
               </style>
                    </div>
                </div>
            </div>
            <!-- Panel 2 -->
            <div class="col-md-6">
                <div class="card mb-4" >
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Tombol Automatisasi Lampu
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">

                        <script>
                              document.addEventListener('DOMContentLoaded', function() {
                                var checkboxes = document.querySelectorAll('.switch_1');
                                checkboxes.forEach(function(checkbox) {
                                    checkbox.addEventListener('change', function() {
                                        var isChecked = this.checked;
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', "/updatesinarauto", true);
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
                             <input type="checkbox" class="switch_1" <?php echo $isChecked ? 'checked' : ''; ?>>
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