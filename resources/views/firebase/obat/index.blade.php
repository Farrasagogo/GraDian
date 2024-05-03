@extends("firebase.app")

@section('content')
<main>
    <div class="container-fluid"style="margin-top: 20px;">
        <div class="row">
            <div class="col-8" style="font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:#4d5155;">KONTROLLING PENYIRAMAN OBAT</div>
            <div class="col-4" style="position: relative;">
                <a href="/riwayatobat" style="text-decoration: none;">
                    <button type="button" id="historyButton" style="position: absolute; top: 0; right: 0; border: none; background: #7d52a0; cursor: pointer; font-family: 'Open sans', sans-serif; font-size: 0.9rem; font-weight: 900; color: white;">Histori Penyiraman Obat &gt;&gt;&gt;</button>
                </a>
            </div>
        </div>
       
        <div class="row justify-content-center align-items-center" style="margin-top: 20px;">
            <!-- Panel 1 -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #7d52a0; color: white;">
                        Tombol Manual Penyiraman Obat
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                       
                        <button type="button" class="irrigation-button" id="pesti">
                            <span class="button-icon">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path fill="#FFFFFF" d="M217.109,373.244l-1.723-13.898c-6.512,0.629-12.857,0.783-19.515,0.48c-10.997-0.501-21.517-2.211-31.507-5.086
                                        l2.248,18.134l-43.076,104.55c-5.267,12.783,0.827,27.415,13.609,32.682c12.787,5.268,27.417-0.83,32.682-13.609l45.583-110.636
                                        C217.055,381.871,217.64,377.526,217.109,373.244z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path fill="#FFFFFF" d="M285.966,361.792l-3.971-30.402c-14.07,11.827-29.944,20.06-47.285,24.558l1.056,8.085l-24.934,117.74
                                        c-2.864,13.525,5.779,26.813,19.304,29.677c13.525,2.865,26.813-5.779,29.677-19.304l25.821-121.927
                                        C286.22,367.45,286.332,364.6,285.966,361.792z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path fill="#FFFFFF" d="M465.284,212.6c-1.291-6.885-7.914-11.419-14.805-10.13l-97.77,18.333c3.946,7.661,5.154,16.488,3.125,25.225
                                        l99.32-18.624C462.04,226.113,466.576,219.485,465.284,212.6z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <circle fill="#FFFFFF" cx="214.965" cy="45.423" r="45.423"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path fill="#FFFFFF" d="M323.338,216.027c-10.833-1.735-63.982-10.249-74.851-11.99l-24.681-54.145l32.716,40.221l16.239,2.601V135.12
                                        c0-16.945-13.736-30.682-30.682-30.682h-29.616c-30.808-10.273-56.321-4.761-73.152,2.395c-1.133,0.482-2.237,0.979-3.319,1.485
                                        c-3.756-8.497-12.253-14.43-22.14-14.43h-8.894V66.742h9.984c7.005,0,12.684-5.679,12.684-12.684
                                        c0-7.005-5.679-12.684-12.684-12.684c-16.376,0-28.959,0-45.335,0c-7.005,0-12.684,5.679-12.684,12.684
                                        c0,7.005,5.678,12.684,12.684,12.684h9.984v27.146h-8.895c-13.365,0-24.2,10.835-24.2,24.2v113.786
                                        c0,13.271,10.684,24.042,23.919,24.193c0.094,0.001,0.187,0.007,0.281,0.007h14.386c3.37,9.425,8.616,21.503,16.465,33.725
                                        c22.445,34.949,55.28,54.379,94.953,56.188c41.412,1.882,74.776-16.342,98.191-48.669c5.982-8.26,10.667-16.56,14.269-23.993
                                        l-26.413-4.231c-13.279,23.864-39.122,53.639-84.892,51.551c-31.292-1.426-56.304-16.197-74.341-43.901
                                        c-4.646-7.136-8.24-14.282-10.978-20.669h1.516c4.396,0,8.514-1.178,12.068-3.227c7.249-4.181,12.133-12.004,12.133-20.974
                                        v-95.889c5.002-3.086,11.293-6.212,18.688-8.471l-0.087,165.03c10.814,7.863,24.471,13.478,41.634,14.261
                                        c30.27,1.37,53.758-13.865,69.748-40.036l-40.459-6.481c-17.328-2.775-27.318-16.877-28.829-24.44l-12.525-62.731l27.254,59.791
                                        c3.044,6.675,9.224,11.387,16.475,12.55l86.453,13.848c11.81,1.893,23.171-6.094,25.104-18.173
                                        C343.425,229.181,335.289,217.941,323.338,216.027z"/>
                                    </g>
                                </g>
                            </svg>
                            </span>
                            <span class="button-text">Semportan Pestisida</span>
                          </button>
                          <script>
                            
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelector('#pesti.irrigation-button').addEventListener('click', function() {
                                    fetch("/update-firebaseobat", {
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
                                        alert('Semprotan Pestisida dihidupkan');
                                    })
                                    .catch(error => {
                                        console.error('There was an error with the fetch operation:', error);
                                        alert('Failed to update Firebase');
                                    });
                                });
                            });
                        </script>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                           
                            <button type="button" class="irrigation-button" id="fungi">
                                <span class="button-icon">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path fill="#FFFFFF" d="M217.109,373.244l-1.723-13.898c-6.512,0.629-12.857,0.783-19.515,0.48c-10.997-0.501-21.517-2.211-31.507-5.086
                                            l2.248,18.134l-43.076,104.55c-5.267,12.783,0.827,27.415,13.609,32.682c12.787,5.268,27.417-0.83,32.682-13.609l45.583-110.636
                                            C217.055,381.871,217.64,377.526,217.109,373.244z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path fill="#FFFFFF" d="M285.966,361.792l-3.971-30.402c-14.07,11.827-29.944,20.06-47.285,24.558l1.056,8.085l-24.934,117.74
                                            c-2.864,13.525,5.779,26.813,19.304,29.677c13.525,2.865,26.813-5.779,29.677-19.304l25.821-121.927
                                            C286.22,367.45,286.332,364.6,285.966,361.792z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path fill="#FFFFFF" d="M465.284,212.6c-1.291-6.885-7.914-11.419-14.805-10.13l-97.77,18.333c3.946,7.661,5.154,16.488,3.125,25.225
                                            l99.32-18.624C462.04,226.113,466.576,219.485,465.284,212.6z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <circle fill="#FFFFFF" cx="214.965" cy="45.423" r="45.423"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path fill="#FFFFFF" d="M323.338,216.027c-10.833-1.735-63.982-10.249-74.851-11.99l-24.681-54.145l32.716,40.221l16.239,2.601V135.12
                                            c0-16.945-13.736-30.682-30.682-30.682h-29.616c-30.808-10.273-56.321-4.761-73.152,2.395c-1.133,0.482-2.237,0.979-3.319,1.485
                                            c-3.756-8.497-12.253-14.43-22.14-14.43h-8.894V66.742h9.984c7.005,0,12.684-5.679,12.684-12.684
                                            c0-7.005-5.679-12.684-12.684-12.684c-16.376,0-28.959,0-45.335,0c-7.005,0-12.684,5.679-12.684,12.684
                                            c0,7.005,5.678,12.684,12.684,12.684h9.984v27.146h-8.895c-13.365,0-24.2,10.835-24.2,24.2v113.786
                                            c0,13.271,10.684,24.042,23.919,24.193c0.094,0.001,0.187,0.007,0.281,0.007h14.386c3.37,9.425,8.616,21.503,16.465,33.725
                                            c22.445,34.949,55.28,54.379,94.953,56.188c41.412,1.882,74.776-16.342,98.191-48.669c5.982-8.26,10.667-16.56,14.269-23.993
                                            l-26.413-4.231c-13.279,23.864-39.122,53.639-84.892,51.551c-31.292-1.426-56.304-16.197-74.341-43.901
                                            c-4.646-7.136-8.24-14.282-10.978-20.669h1.516c4.396,0,8.514-1.178,12.068-3.227c7.249-4.181,12.133-12.004,12.133-20.974
                                            v-95.889c5.002-3.086,11.293-6.212,18.688-8.471l-0.087,165.03c10.814,7.863,24.471,13.478,41.634,14.261
                                            c30.27,1.37,53.758-13.865,69.748-40.036l-40.459-6.481c-17.328-2.775-27.318-16.877-28.829-24.44l-12.525-62.731l27.254,59.791
                                            c3.044,6.675,9.224,11.387,16.475,12.55l86.453,13.848c11.81,1.893,23.171-6.094,25.104-18.173
                                            C343.425,229.181,335.289,217.941,323.338,216.027z"/>
                                        </g>
                                    </g>
                                </svg>
                                </span>
                                <span class="button-text">Semportan Fungisida</span>
                              </button>
                              <script>
                                
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.querySelector('#fungi.irrigation-button').addEventListener('click', function() {
                                        fetch("/update-firebaseobat2", {
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
                                            alert('Semprotan Fungisida dihidupkan');
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
            <div class="row">
                <div class="col-8" style="font-family: 'Open sans', sans-serif; font-size:  0.9rem; font-weight:900; color:#4d5155;">PENJADWALAN</div>
                <div class="col-4" style="position: relative;">
                    <a href="/riwayatpenyinaran" style="text-decoration: none;">
                        <button type="button" id="historyButton" style="position: absolute; top: 0; right: 0; border: none; background: #7d52a0; color: #000; cursor: pointer; font-family: 'Open sans', sans-serif; font-size: 0.9rem; font-weight: 900; color: white;">&gt;&gt;&gt;</button>
                    </a>
                </div>
            </div>
            
            <div class="row justify-content-center align-items-center" style="margin-top: 20px;">
                <!-- Panel 1 -->
                <div class="col-md-6">
                    <div class="card mb-4 " >
                        <div class="card-header" style="background-color: #7d52a0; color: white;">
                            Tombol Aktivasi Penjadwalan
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center" style="background-color: white;">
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                 var checkboxes = document.querySelectorAll('.switch_2');
                                 checkboxes.forEach(function(checkbox) {
                                     checkbox.addEventListener('change', function() {
                                         var isChecked = this.checked;
                                         var xhr = new XMLHttpRequest();
                                         xhr.open('POST', "/updateobatauto", true);
                                         xhr.setRequestHeader('Content-Type', 'application/json');
                                         xhr.onreadystatechange = function() {
                                             if (xhr.readyState === XMLHttpRequest.DONE) {
                                                 if (xhr.status === 200) {
                                                     console.log(xhr.responseText);                                            
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
                        <input type="checkbox" class="switch_2" <?php echo $isChecked ? 'checked' : ''; ?>>
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
        </div>
    </div>
</main>
</div>
@endsection