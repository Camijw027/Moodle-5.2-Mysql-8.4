<?php
// Pagina principal del plugin Herramientas HVAC.

require('../../config.php');

require_login();

$context = context_system::instance();
$title = get_string('pluginname', 'local_hvactools');

$PAGE->set_url(new moodle_url('/local/hvactools/index.php'));
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->css(new moodle_url('/local/hvactools/styles.css'));

echo $OUTPUT->header();
?>

<section class="hvactools" aria-labelledby="hvactools-title">
    <div class="hvactools-hero">
        <div>
            <p class="hvactools-kicker">Panel de apoyo tecnico</p>
            <h2 id="hvactools-title">Herramientas HVAC</h2>
            <p class="hvactools-intro">
                Un espacio practico para convertir temperaturas, revisar pasos de diagnostico
                y preparar actividades de mantenimiento.
            </p>
        </div>
        <div class="hvactools-badge" aria-label="Modulo HVAC">
            <img src="pix/hvac-icon.png" alt="Icono HVAC" class="hvactools-badge-icon">
        </div>
    </div>

    <div class="hvactools-grid">
        <article class="hvactools-panel hvactools-converter">
            <h3>Convertidor de temperatura</h3>
            <p>Convierte rapidamente lecturas entre Celsius y Fahrenheit.</p>

            <div class="hvactools-formrow">
                <label for="hvac-temp">Temperatura</label>
                <input id="hvac-temp" type="number" step="0.1" value="25">
            </div>

            <div class="hvactools-formrow">
                <label for="hvac-scale">Escala de entrada</label>
                <select id="hvac-scale">
                    <option value="c">Celsius</option>
                    <option value="f">Fahrenheit</option>
                </select>
            </div>

            <p id="hvac-result" class="hvactools-result" aria-live="polite"></p>
        </article>

        <article class="hvactools-panel">
            <h3>Checklist del estudiante</h3>
            <ul class="hvactools-checklist">
                <li><label><input type="checkbox"> Revisar filtro, serpentines y flujo de aire.</label></li>
                <li><label><input type="checkbox"> Confirmar alimentacion electrica segura.</label></li>
                <li><label><input type="checkbox"> Medir temperatura de entrada y salida.</label></li>
                <li><label><input type="checkbox"> Registrar lecturas antes de ajustar el equipo.</label></li>
            </ul>
        </article>

        <article class="hvactools-panel hvactools-wide">
            <h3>Guia rapida de diagnostico</h3>
            <div class="hvactools-diagnostics">
                <div>
                    <strong>No enfria</strong>
                    <span>Filtro sucio, bajo refrigerante, evaporador congelado o poco flujo de aire.</span>
                </div>
                <div>
                    <strong>Ruido anormal</strong>
                    <span>Revisar vibracion, soportes, ventilador, rodamientos y tornilleria.</span>
                </div>
                <div>
                    <strong>Consumo alto</strong>
                    <span>Medir voltaje, amperaje, capacitor y condiciones de operacion.</span>
                </div>
            </div>
        </article>

        <article class="hvactools-panel">
            <h3>Recursos rapidos</h3>
            <div class="hvactools-links">
                <a href="https://www.danfoss.com/es-es/products/" target="_blank" rel="noopener">
                    <img src="pix/Danfoos.jpg" alt="Danfoss logo" class="hvactools-brand-logo">
                    <span>Danfoss</span>
                </a>
                <a href="https://www.lg.com/co/aire-acondicionado-residencial/?ec_model_status_code=Active" target="_blank" rel="noopener">
                    <img src="pix/LG.png" alt="LG logo" class="hvactools-brand-logo">
                    <span>LG</span>
                </a>
                <a href="https://daikinlatam.com/" target="_blank" rel="noopener">
                    <img src="pix/Daikin.png" alt="Daikin logo" class="hvactools-brand-logo">
                    <span>Daikin</span>
                </a>
                <a href="https://www.samsung.com/co/air-conditioners/all-air-conditioners/?sort=latest" target="_blank" rel="noopener">
                    <img src="pix/Samsung.png" alt="Samsung logo" class="hvactools-brand-logo">
                    <span>Samsung</span>
                </a>
            </div>
        </article>
    </div>
</section>

<script>
(function() {
    const input = document.getElementById('hvac-temp');
    const scale = document.getElementById('hvac-scale');
    const result = document.getElementById('hvac-result');

    function convertTemperature() {
        const value = parseFloat(input.value);

        if (Number.isNaN(value)) {
            result.textContent = 'Ingresa una temperatura valida.';
            return;
        }

        if (scale.value === 'c') {
            result.textContent = value.toFixed(1) + ' C = ' + ((value * 9 / 5) + 32).toFixed(1) + ' F';
            return;
        }

        result.textContent = value.toFixed(1) + ' F = ' + ((value - 32) * 5 / 9).toFixed(1) + ' C';
    }

    input.addEventListener('input', convertTemperature);
    scale.addEventListener('change', convertTemperature);
    convertTemperature();
})();
</script>

<?php
echo $OUTPUT->footer();
