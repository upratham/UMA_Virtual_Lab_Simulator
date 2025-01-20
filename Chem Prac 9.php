<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.html");
    exit();
}
$practical_number = "C9"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Profile Section with Styling -->
    <style>
        .user-profile {
            position: fixed;
            top: 10px;
            right: 10px;
            text-align: right;
            z-index: 1000;
        }

        .user-profile .user-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .user-profile .dropdown {
            position: relative;
            display: inline-block;
        }

        .user-profile .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .user-profile .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .user-profile .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .user-profile .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>

    <div class="user-profile">
        <div class="user-name">Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></div>
        <div class="dropdown">
            <span>Profile ▼</span>
            <div class="dropdown-content">
                <a href="#" onclick="openModal('changePasswordModal')">Change Password</a>
                <a href="logout.php">Log Out</a>
                <?php if ($_SESSION['role'] === 'director'): ?>
                    <a href="#" onclick="openModal('addStudentModal')">Add Student</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica de química 9: Reglas de seguridad en el laboratorio</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex; /* Changes display to flex to help with the layout */
            flex-direction: column; /* Stack elements vertically */
        }

        .practical-header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: row;
            margin: 0;
            width: 100%;
            height: 100%;
            min-height: 100vh;
        }

        /* Sidebar (Shortcuts/Contents) */
        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            position: sticky;
            top: 0; /* Sticks at the top of the viewport */
            align-self: flex-start; /* Ensures sidebar stays at the top when scrolling */
            overflow-y: auto; 
            padding: 10px;
            height: 100vh;
            float:left;
        }
        .sidebar a {
            text-decoration: none; 
            color: #333;
            display: block;
            margin: 10px 0;
        }
        .sidebar a:hover {
            background-color: #ddd;
            padding-left: 10px;
        }

        .sidebar h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .sidebar ul li a:hover {
            color: #007BFF;
        }

        /* Main Content Section */
        #practical-content {
            flex-grow: 1;
            flex: 1; /* Takes the remaining space */
            padding: 20px;
            overflow-y: auto; /* Allows the main content to scroll */
            display: inline-block;
        }

        h1 {
            font-size: 24px;
        }

        h2 {
            font-size: 20px;
            margin-top: 20px;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        /* Images styling */
        .image-container {
            text-align: left;
        }

        .anatomical-image {
            max-width: 100%;
            height: auto;
        }

        .label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .practical-header {
            position: sticky;
            top: 0;
            background-color: white; /* Ensures the logo background stays clean when sticky */
            z-index: 100; /* Ensures it stays above the rest of the content */
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd; /* Optional: Adds a bottom border to the header */}
        
            .styled-button {
            padding: 12px 24px; /* Larger padding for a bigger button */
            background-color: #E40D5E;
            color: white;
            border: black;
            border-radius: 8px; /* Larger border radius for a smoother look */
            cursor: pointer;
            font-size: 18px; /* Larger font size */
            transition: background-color 0.3s ease;
            margin-left: 20px; /* Adds space between the text and the button */
            justify-content: center; /* Centers both the text and the button */
            align-items: center;
            display: flex;
            width: 80%;
        }

        .styled-button:hover {
        background-color: #0e0d07; /* Darker color on hover */
        }
}

    </style>
</head>
<body>
    <header class="practical-header">
        <img src="logo_UMA.png" alt="UMA Logo" class="practical-logo">
    </header>

    <div class="container">
        <!-- Left side (Shortcuts/Headings) -->
        <nav class="sidebar">
            <h3>Contenido</h3>
            <ul>
                <li><a href="#OBJETIVOS">OBJETIVOS</a></li>
                <li><a href="#FUNDAMENTOS TEÓRICOS">FUNDAMENTOS TEÓRICOS</a></li>
                <li><a href="#PROCEDIMIENTO">PROCEDIMIENTO</a></li>
                <li><a href="#CUESTIONARIO">CUESTIONARIO</a></li>
                <li><a href="#REFERENCIA">REFERENCIA</a></li>
            </ul>
        </nav>

        <!-- Right side (Main Content) -->
        <section id="practical-content">
            <div class="content">
                <h1>            PRÁCTICA N° 09: REACCIONES QUÍMICAS</h1>
                <a href=chem_sim_9.php       class="styled-button">Simulation</a>
                <h2 id="OBJETIVOS">1. OBJETIVOS</h2>
                <ul>
                    <li>1.1 Reconocer experimentalmente diferentes tipos de reacciones químicas.</li>
                </ul>
                
                <h2 id="FUNDAMENTOS TEÓRICOS">2. FUNDAMENTOS TEÓRICOS</h2>
                <p>De acuerdo a la manera como se combinan las sustancias (reactivos) para darorigen a otras nuevas, estas se pueden clasificar en:</p>

                <p><strong>2.1 Reacciones molecular:</strong>si todas las moléculas participantes tienen carácter neutro.Éstas pueden ser:</p>
                
                <p><strong>2.1.1 Reacciones de combinación:</strong>en estas reacciones dos o más sustancias secombinan para dar una nueva.</p>
                <li>A + B→ AB</li>

                <p><strong>2.1.2 Reacciones de descomposición:</strong>una sustancia se descompone para producir doso más sustancias nuevas.</p>
                <li>AB→ A + B</li>

                <p><strong>2.1.3 Reacciones de desplazamiento: </strong>en estas reacciones un elemento o más de losreactivos es reemplazado por otro u otros.</p>
                <li>A + BC→ AC + B</li>

                <p><strong>2.1.4 Reacción de doble desplazamiento: </strong>en estas reacciones ocurre un intercambioentre los átomos de los reactivos, a este grupo pertenecen las reacciones deprecipitación y neutralización.</p>
                <li>AB + CD→ AD + CB</li>

                <h4><span class="highlight">2.1.4.1 Precipitación:</span></h4>
                <p>Es la reacción que ocurre entre dos compuestos solubles que producen una sustancia soluble y una insoluble.</p>
                <p class="reaction">K<sub>2</sub>CrO<sub>4</sub>(ac) + Ba(NO<sub>3</sub>)<sub>2</sub>(ac) → KNO<sub>3</sub>(ac) + BaCrO<sub>4</sub>(s)</p>
            
                <h4>2.1.4.2 Neutralización:</h4>
                <p>Es una reacción entre un ácido y una base y producen una sal y agua.</p>
                <p class="reaction">H<sub>2</sub>S(ac) + NaOH(ac) → Na<sub>2</sub>S(s) + H<sub>2</sub>O(l)</p>
            
                <h4>2.2 Reacciones iónicas:</h4>
                <p>En estas reacciones algunas de las sustancias por todas se encuentran en estado iónico (iones positivos y iones negativos). Con frecuencia las reacciones de doble desplazamiento se escriben de esta forma.</p>
                <p class="reaction">HCl(ac) + NaOH(ac) → H<sup>+</sup>(ac) + Cl<sup>-</sup> + Na<sup>+</sup>(ac) + OH<sup>-</sup>(ac)</p>
            
                <p>
                    Puesto que los anteriores procesos no son directamente observables, es necesario tener en cuenta los criterios establecidos en la práctica referente a cambios químicos para determinar cuándo ha ocurrido una reacción química.
                </p>
                <p>
                    Es necesario aclarar que existen otras formas de clasificación de las reacciones químicas, teniendo en cuenta diversos criterios, <strong>como</strong> por ejemplo: reacciones endotérmicas y reacciones exotérmicas; reacciones con transferencia de electrones (reacciones de óxido-reducción) y reacciones sin transferencia de electrones; reacciones de neutralización; reacciones de precipitación, entre otras.
                </p>

                <h4>2.3 Reacciones de Óxido-Reducción:</h4>
    <p>
        En las reacciones Redox ocurre una transferencia de electrones entre los reactantes, se identifica por el cambio en el número de oxidación, mientras uno se oxida (aumenta) el otro se reduce (disminuye) simultáneamente.
    </p>
    <p><span class="highlight">Oxidación:</span> Es el proceso que implica pérdida de electrones y por tanto aumenta su número de oxidación.</p>
    <p><span class="highlight">Reducción:</span> Es el proceso que implica ganancia de electrones, por lo <strong>tanto</strong> disminuye su número de oxidación.</p>
    <p><span class="highlight">Agente oxidante:</span> Es la sustancia que se reduce o gana electrones.</p>
    <p><span class="highlight">Agente reductor:</span> Es la sustancia que fácilmente libera o cede electrones, se reduce.</p>

    <p class="highlight">Ejemplo:</p>
    <p class="reaction">Zn<sup>0</sup> + CuSO<sub>4</sub> → ZnSO<sub>4</sub> + Cu<sup>0</sup></p>
    <p class="reaction">Zn<sup>0</sup> - 2e<sup>-</sup> → Zn<sup>+2</sup> (oxidación, agente reductor)</p>
    <p class="reaction">Cu<sup>0</sup> + 2e<sup>-</sup> → Cu<sup>0</sup> (reducción, agente oxidante)</p>
       

    <table border="1">
        <thead>
            <tr>
                <th colspan="2">3. MATERIALES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>5 mechero de bunsen</td>
                <td>5 malla metálica con asbesto</td>
            </tr>
            <tr>
                <td>30 tubos de ensayo</td>
                <td>5 espátula metálica</td>
            </tr>
            <tr>
                <td>5 gradilla para tubos de ensayo</td>
                <td>5 pinza metálica para tubos de ensayo</td>
            </tr>
            <tr>
                <td>5 pipeta graduada de 10ml</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th colspan="2">4. Reactivos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Clorato de potasio (s)</td>
                <td>5 g</td>
            </tr>
            <tr>
                <td>Magnesio metálico en cinta</td>
                <td>5 g</td>
            </tr>
            <tr>
                <td>Zinc metálico en granallas</td>
                <td>5 g</td>
            </tr>
            <tr>
                <td>Ácido clorhídrico diluido (0.1 N)</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Solución de yoduro de potasio 0.5M</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Solución de nitrato de plomo 0.5M</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Solución de carbonato de sodio 0.1M</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Ácido clorhídrico 4.0N</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Solución de hidróxido de sodio al 0.1N</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Solución de cloruro de bario 0.1M</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Ácido sulfúrico 1.0M</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Fenolftaleína en solución</td>
                <td>5 g</td>
            </tr>
            <tr>
                <td>Acetato de plomo</td>
                <td>15 mL</td>
            </tr>
            <tr>
                <td>Sulfato de cobre (II) diluido</td>
                <td>15 mL</td>
            </tr>
        </tbody>
    </table>
    <br>

    <h3 id="PROCEDIMIENTO">3. PROCEDIMIENTO</h3>
    <h4>5.1 Reacciones de combinación (síntesis).</h4>
    <p>
        Tomar 1 cm de cinta de magnesio <strong>con</strong> una pinza para crisol sujetarla por un extremo y colocarla directamente a la <strong>llama</strong> del mechero. Cuando comience a producirse una luz blanca intensa (deslumbrante), retire la cinta del mechero y manténgala lejos de la cara mientras ocurra la reacción. Dejar enfriar y luego recoger en un vidrio de reloj el producto de <strong>la</strong> reacción y examinar su aspecto. Añadir de 3 a 5 gotas de agua y una gota de solución de fenolftaleína.
    </p>
    <p>
        Otro ejemplo de reacciones de combinación es cuando se combinan aluminio en polvo y azufre en polvo; Calentándola suavemente hasta que se inicie la reacción. (Consultar la ecuación química de la reacción).
    </p>

    <h4>5.2 Reacciones de descomposición.</h4>
    <p>
        Colocar 1g de clorato de potasio en un tubo de ensayo limpio y seco; sujetar con las pinzas el tubo de ensayo y calentar directamente en la llama del mechero (no dirigir la boca del tubo hacia su cara ni hacia la de los compañeros); cuando el clorato de potasio se funda y desprenda burbujas, acercar a la boca del tubo un palillo con un punto de ignición. Observe cuidadosamente el residuo y las paredes del tubo. Otro ejemplo de reacciones de descomposición es utilizando óxido de mercurio(II). (Consultar la ecuación química de la reacción).
    </p>

    <h4>5.3 Reacciones de desplazamiento.</h4>
    <p>
        Verter 3ml de solución de ácido clorhídrico 4.0 N en un tubo de ensayo y agregar una granalla de zinc. Recoger el gas que se produce en otro tubo de ensayo. Este se coloca invertido sobre el tubo en el cual se realiza la reacción; una vez que el tubo esté lleno de gas, en esa misma posición se lleva a la llama del mechero. Anote las observaciones.
    </p>

    <h4>5.4 Reacción de doble desplazamiento.</h4>
    <p>
        Colocar en un tubo de ensayo 1 ml de solución de yoduro de potasio 0.5M y en otro tubo 1 ml de solución de nitrato de plomo 0.5M. Mezclar el contenido de ambos tubos. En un tubo de ensayo limpio y seco vierta 3ml de agua y agregue unos cristalitos de acetato de plomo, agite hasta que los cristales se disuelvan completamente. Adicionar 1 ml de solución de yoduro de potasio 0.5M y agite. Otro ejemplo de este tipo de reacción es la combinación de nitrato de plata y cloruro de sodio. (Consultar la ecuación química de la reacción).
    </p>


    <h4>4.5 Estudio de otras reacciones.</h4>

    <div class="experience">
        <strong>Experiencia N° 1.</strong> En un tubo de ensayo colocar 5 ml de sulfato de cobre 1M y dejar caer limaduras de hierro (un clavo).
    </div>

    <div class="experience">
        <strong>Experiencia N° 2.</strong> En un tubo de ensayo colocar 2 ml de solución de permanganato de potasio 0.5M, acidular con 3 gotas de ácido sulfúrico concentrado y agregar unos cristales de sulfito de sodio agitar la solución.
    </div>

    <div class="experience">
        <strong>Experiencia N° 3.</strong> En un tubo de ensayo coloque 2 ml de ácido nítrico concentrado y deje caer en su interior un trocito de lámina de cobre.
    </div>

    <div class="experience">
        <strong>Experiencia N° 4.</strong> En un tubo de ensayo coloque 2 ml de solución de peróxido de hidrógeno, 5 gotas de ácido sulfúrico y 1 ml de yoduro de potasio 1M.
    </div>

    <div class="experience">
        <strong>Experiencia N° 5.</strong> En un tubo de ensayo coloque 2 ml de solución acuosa diluida de permanganato de potasio, le agregamos 5 gotas de ácido sulfúrico y la misma cantidad de gotas de solución de yoduro de potasio.
    </div>

    <div class="experience">
        <strong>Experiencia N° 6.</strong> En un tubo de ensayo coloque 2 ml de solución acuosa diluida de permanganato de potasio, le agregamos 5 gotas de solución al 10% de NaOH y la misma cantidad de gotas de solución de yoduro de potasio.
    </div>

    <div class="experience">
        <strong>Experiencia N° 7.</strong> En un tubo de ensayo coloque 1 ml de solución acuosa de Dicromato de Potasio, le agregamos 5 gotas de solución de ácido sulfúrico 6M y 10 gotas de etanol. Agitamos para homogenizar, y si no observamos ningún cambio lo calentamos.
    </div>

    <div class="experience">
        <strong>Experiencia N° 8.</strong> En un tubo de ensayo coloque 2 ml de ácido sulfúrico 0.5M 1 ml de yoduro de potasio 0.5M. A la disolución resultante se le añade gota a gota 1 ml de yodato de potasio 0.5M.
    </div>

                <h2 id="CUESTIONARIO">5. CUESTIONARIO</h2>
                <<form action="questionnaire.php" method="GET">
                        <!-- Pass the practical number as a GET parameter -->
                        <input type="hidden" name="practical_number" value="<?php echo htmlspecialchars($practical_number); ?>">
                        <button type="submit" class="styled-button">Ir al cuestionario</button>
                    </form>
                    <br>
                    <ol>
                        <li>Escriba las ecuaciones químicas (completas y balanceadas) representativas de cada una de las reacciones efectuada en el procedimiento.</li>
                        <li>Escriba mínimo otros dos ejemplos con su respectiva ecuación de cada uno de los tipos de reacciones estudiadas.</li>
                        <li>Clasifique cada una de las reacciones del experimento 5.</li>
                        <li>Las reacciones de desplazamiento se explican mediante la <strong>serie de actividad de los metales</strong>. Escriba en su orden la serie y dé explicaciones referentes a este caso.</li>
                        <li>Al agregar el magnesio se forma efervescencia. ¿A qué se debe?</li>
                        <li>¿Cómo se determina el estado de oxidación de un elemento o de un compuesto? Ponga tres ejemplos.</li>
                        <li>¿Cuántos métodos de balanceo conoce? Describa brevemente el procedimiento de cada método.</li>
                        <li>Balancear las siguientes reacciones:</li>

                        <ul>
                            <li>KBr + H<sub>2</sub>SO<sub>4</sub> → K<sub>2</sub>SO<sub>4</sub> + Br<sub>2</sub> + SO<sub>2</sub> + H<sub>2</sub>O</li>
                            <li>KI + H<sub>2</sub>SO<sub>4</sub> → K<sub>2</sub>SO<sub>4</sub> + I<sub>2</sub> + H<sub>2</sub>S + H<sub>2</sub>O</li>
                            <li>Cr<sub>2</sub>O<sub>3</sub> + Na<sub>2</sub>CO<sub>3</sub> + KNO<sub>3</sub> → NaCrO<sub>4</sub> + CO<sub>2</sub> + KNO<sub>2</sub></li>
                            <li>NH<sub>4</sub>OH + HCl → NH<sub>4</sub>Cl + H<sub>2</sub>O</li>
                            <li>HNO<sub>3</sub> + Zn → Zn(NO<sub>3</sub>)<sub>2</sub> + H<sub>2</sub></li>
                            <li>H<sub>2</sub>S + FeCl<sub>3</sub> → S + FeCl<sub>2</sub> + HCl</li>
                        </ul>
                    </ol>
                

                    
    
                <h2 id="REFERENCIA">REFERENCIA</h2>
                <p>Source: <a href="https://www.kenhub.com/es/library/anatomia-es/terminologia-anatomica-es">Kenhub - Terminología anatómica</a></p>
                
            </div>
        </section>
    </div>
</body>
</html>
