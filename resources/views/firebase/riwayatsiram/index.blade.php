@extends("firebase.app")

@section('content')
<main>
    <div class="col-10" style="font-family: 'Open sans', sans-serif; font-size: 1.2rem; font-weight:900; color:#4d5155; margin: 20px;">Data Suhu dan Kelembapan</div>
    <div class="table-responsive" style="margin: 20px;">
        <table class="table table-striped table-bordered" >
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
                @foreach($data as $document)
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

</main>
        </div>
@endsection
