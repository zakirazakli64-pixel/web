<?php
// ====== API DATA (jika dipanggil dengan ?data=true) ======
if(isset($_GET['data'])){
    header('Content-Type: application/json');

    $data = [
        "temperature" => rand(20, 35),
        "soil_moisture" => rand(30, 90),
        "rain" => rand(0, 1),
        "light" => rand(100, 1000)
    ];

    echo json_encode($data);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monitoring IoT</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 20px;
            margin: 15px;
            width: 220px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .card p {
            font-size: 26px;
            font-weight: bold;
        }

        .status-hujan {
            color: blue;
        }

        .status-tidak {
            color: green;
        }
    </style>
</head>
<body>

<h1>🌱 Monitoring Smart Garden (ALL-IN-ONE)</h1>

<div class="container">
    <div class="card">
        <h3>🌡 Suhu</h3>
        <p id="temp">-- °C</p>
    </div>

    <div class="card">
        <h3>🌿 Kelembaban Tanah</h3>
        <p id="soil">-- %</p>
    </div>

    <div class="card">
        <h3>🌧 Rain Sensor</h3>
        <p id="rain">--</p>
    </div>

    <div class="card">
        <h3>☀ Cahaya</h3>
        <p id="light">-- lux</p>
    </div>
</div>

<script>
function loadData() {
    fetch('?data=true')
    .then(res => res.json())
    .then(data => {
        document.getElementById('temp').innerText = data.temperature + " °C";
        document.getElementById('soil').innerText = data.soil_moisture + " %";
        document.getElementById('light').innerText = data.light + " lux";

        let rainText = document.getElementById('rain');

        if(data.rain == 1){
            rainText.innerText = "Hujan";
            rainText.className = "status-hujan";
        } else {
            rainText.innerText = "Tidak Hujan";
            rainText.className = "status-tidak";
        }
    });
}

// pertama kali load
loadData();

// update tiap 3 detik
setInterval(loadData, 3000);
</script>

</body>
</html>