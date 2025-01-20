<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulación del Experimento de Separación de Arena y Sal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, .slider {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .slider {
            -webkit-appearance: none;
            height: 15px;
            background: #d3d3d3;
            outline: none;
            border-radius: 5px;
        }
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #007bff;
            cursor: pointer;
            border-radius: 50%;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .translate-btn {
            background: #ff9800;
            margin-bottom: 20px;
        }
        .translate-btn:hover {
            background: #e68900;
        }
        .result {
            padding: 10px;
            background: #e7f4e8;
            border: 1px solid #b6e0b6;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Translate Button -->
        <button class="translate-btn" id="translateBtn" onclick="toggleLanguage()">Cambiar a Inglés</button>

        <h1 id="title">Simulación del Experimento de Separación de Arena y Sal</h1>
        <p id="description">Seleccione las masas iniciales y las eficiencias de recuperación para simular la separación de arena y sal y calcular errores experimentales.</p>
        
        <!-- Form for Input -->
        <form method="POST" action="">
            <label for="initial_sand" id="sand_label">Masa Inicial de Arena (g)</label>
            <input type="number" id="initial_sand" name="initial_sand" placeholder="Ingrese la masa inicial de arena" required>
            
            <label for="initial_salt" id="salt_label">Masa Inicial de Sal (g)</label>
            <input type="number" id="initial_salt" name="initial_salt" placeholder="Ingrese la masa inicial de sal" required>
            
            <label for="sand_efficiency" id="sand_eff_label">Eficiencia de Recuperación de Arena (%)</label>
            <input type="range" id="sand_efficiency" name="sand_efficiency" class="slider" min="0" max="100" value="50" oninput="updateValue('sandValue', this.value)">
            <span id="sandValue">50%</span>
            
            <label for="salt_efficiency" id="salt_eff_label">Eficiencia de Recuperación de Sal (%)</label>
            <input type="range" id="salt_efficiency" name="salt_efficiency" class="slider" min="0" max="100" value="50" oninput="updateValue('saltValue', this.value)">
            <span id="saltValue">50%</span>
            
            <button type="submit" name="simulate">Simular</button>
        </form>

        <!-- PHP Code to Handle Form Submission -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simulate'])) {
            // Retrieve Inputs
            $initial_sand = floatval($_POST['initial_sand']);
            $initial_salt = floatval($_POST['initial_salt']);
            $sand_efficiency = floatval($_POST['sand_efficiency']);
            $salt_efficiency = floatval($_POST['salt_efficiency']);

            // Perform Calculations
            $recovered_sand = $initial_sand * ($sand_efficiency / 100);
            $recovered_salt = $initial_salt * ($salt_efficiency / 100);

            $sand_abs_error = $recovered_sand - $initial_sand;
            $sand_rel_error = ($sand_abs_error / $initial_sand) * 100;

            $salt_abs_error = $recovered_salt - $initial_salt;
            $salt_rel_error = ($salt_abs_error / $initial_salt) * 100;

            // Display Results
            echo "<div class='result'><strong>Resultados de Arena:</strong> <br> Arena Recuperada: " . number_format($recovered_sand, 2) . " g, 
                    Error Absoluto: " . number_format($sand_abs_error, 2) . " g, 
                    Error Relativo: " . number_format($sand_rel_error, 2) . "%</div>";
            echo "<div class='result'><strong>Resultados de Sal:</strong> <br> Sal Recuperada: " . number_format($recovered_salt, 2) . " g, 
                    Error Absoluto: " . number_format($salt_abs_error, 2) . " g, 
                    Error Relativo: " . number_format($salt_rel_error, 2) . "%</div>";
        }
        ?>
    </div>

    <script>
        let isSpanish = true;

        // Toggle between Spanish and English
        function toggleLanguage() {
            isSpanish = !isSpanish;
            document.getElementById('translateBtn').textContent = isSpanish ? "Cambiar a Inglés" : "Switch to Spanish";
            document.getElementById('title').textContent = isSpanish
                ? "Simulación del Experimento de Separación de Arena y Sal"
                : "Sand and Salt Separation Experiment Simulation";
            document.getElementById('description').textContent = isSpanish
                ? "Seleccione las masas iniciales y las eficiencias de recuperación para simular la separación de arena y sal y calcular errores experimentales."
                : "Select the initial masses and recovery efficiencies to simulate the separation of sand and salt and calculate experimental errors.";
            document.getElementById('sand_label').textContent = isSpanish
                ? "Masa Inicial de Arena (g)"
                : "Initial Mass of Sand (g)";
            document.getElementById('salt_label').textContent = isSpanish
                ? "Masa Inicial de Sal (g)"
                : "Initial Mass of Salt (g)";
            document.getElementById('sand_eff_label').textContent = isSpanish
                ? "Eficiencia de Recuperación de Arena (%)"
                : "Sand Recovery Efficiency (%)";
            document.getElementById('salt_eff_label').textContent = isSpanish
                ? "Eficiencia de Recuperación de Sal (%)"
                : "Salt Recovery Efficiency (%)";
        }

        // Update slider values
        function updateValue(spanId, value) {
            document.getElementById(spanId).textContent = value + "%";
        }
    </script>
</body>
</html>
