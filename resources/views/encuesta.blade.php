@extends('layouts.menu')

@section('title', 'Encuesta - Marisquería')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Encuesta - Marisquería</h3>
        </div>
        <div class="card-body">
            <!-- Mensaje de éxito (simulado) -->
            <div id="success-message" class="alert alert-success d-none">
                ¡Gracias por completar la encuesta!
            </div>

            <!-- Mensaje de error (simulado) -->
            <div id="error-message" class="alert alert-danger d-none">
                Por favor, responde todas las preguntas obligatorias.
            </div>

            <!-- Opciones para realizar la encuesta -->
            <div class="text-center mb-4">
                <h4>¿Cómo deseas realizar la encuesta?</h4>
                <button id="generate-link-btn" class="btn btn-primary w-100 mb-2">
                    Generar Enlace y Código QR
                </button>
                <button id="direct-survey-btn" class="btn btn-secondary w-100 mb-2">
                    Completar Encuesta Directamente
                </button>
                <button id="simulated-survey-btn" class="btn btn-info w-100">
                    Realizar Encuesta en la App
                </button>
            </div>

            <!-- Sección para generar enlace y QR -->
            <div id="generate-link-section" class="d-none">
                <label for="survey-url" class="form-label">Enlace de la encuesta:</label>
                <input type="text" class="form-control" id="survey-url" value="{{ config('app.url') }}/encuesta" readonly>
                <button class="btn btn-secondary w-100 mt-2" onclick="copyToClipboard()">Copiar Enlace</button>

                <!-- Código QR -->
                <div id="qr-code" class="qr-code mt-4">
                    <h5>Escanea el código QR:</h5>
                    <img id="qr-image" src="" alt="Código QR">
                </div>
            </div>

            <!-- Sección para completar la encuesta directamente -->
            <div id="direct-survey-section" class="d-none">
                <iframe src="https://forms.office.com/Pages/ResponsePage.aspx?id=s2t7Uj606UKdZWPJyhA6mvGuJRnetW9LjBEwj89lC-5URE1EOFY4TFhEWUs3WThZREdGOTRHSEZUTC4u" 
                        width="100%" 
                        height="1200" 
                        frameborder="0" 
                        marginheight="0" 
                        marginwidth="0">
                    Cargando…
                </iframe>
            </div>

            <!-- Sección para simular la encuesta en la app -->
            <div id="simulated-survey-section" class="d-none">
                <form id="survey-form">
                    @csrf

                    <!-- Pregunta 1 -->
                    <div class="mb-3">
                        <label for="calidad_comida" class="form-label">1. ¿Cómo calificarías la calidad de la comida?</label>
                        <select class="form-select" id="calidad_comida" required>
                            <option value="">Selecciona una opción</option>
                            <option value="5">Excelente</option>
                            <option value="4">Buena</option>
                            <option value="3">Regular</option>
                            <option value="2">Mala</option>
                            <option value="1">Muy mala</option>
                        </select>
                    </div>

                    <!-- Pregunta 2 -->
                    <div class="mb-3">
                        <label for="servicio_personal" class="form-label">2. ¿Cómo calificarías el servicio del personal?</label>
                        <select class="form-select" id="servicio_personal" required>
                            <option value="">Selecciona una opción</option>
                            <option value="5">Excelente</option>
                            <option value="4">Buena</option>
                            <option value="3">Regular</option>
                            <option value="2">Mala</option>
                            <option value="1">Muy mala</option>
                        </select>
                    </div>

                    <!-- Pregunta 3 -->
                    <div class="mb-3">
                        <label for="recomendacion" class="form-label">3. ¿Recomendarías nuestro restaurante a otras personas?</label>
                        <select class="form-select" id="recomendacion" required>
                            <option value="">Selecciona una opción</option>
                            <option value="5">Definitivamente sí</option>
                            <option value="4">Probablemente sí</option>
                            <option value="3">No estoy seguro</option>
                            <option value="2">Probablemente no</option>
                            <option value="1">Definitivamente no</option>
                        </select>
                    </div>

                    <!-- Pregunta 4 -->
                    <div class="mb-3">
                        <label for="limpieza" class="form-label">4. ¿Cómo calificarías la limpieza del restaurante?</label>
                        <select class="form-select" id="limpieza" required>
                            <option value="">Selecciona una opción</option>
                            <option value="5">Excelente</option>
                            <option value="4">Buena</option>
                            <option value="3">Regular</option>
                            <option value="2">Mala</option>
                            <option value="1">Muy mala</option>
                        </select>
                    </div>

                    <!-- Pregunta 5 -->
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">5. ¿Tienes algún comentario adicional?</label>
                        <textarea class="form-control" id="comentarios" rows="3" placeholder="Escribe tus comentarios aquí"></textarea>
                    </div>

                    <!-- Botón para enviar la encuesta -->
                    <button type="submit" class="btn btn-primary w-100">Enviar Encuesta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // URL de tu formulario real (cámbiala por la tuya)
    const surveyUrl = "https://forms.office.com/Pages/ResponsePage.aspx?id=s2t7Uj606UKdZWPJyhA6mvGuJRnetW9LjBEwj89lC-5URE1EOFY4TFhEWUs3WThZREdGOTRHSEZUTC4u";

    // Elementos del DOM
    const generateLinkBtn = document.getElementById('generate-link-btn');
    const directSurveyBtn = document.getElementById('direct-survey-btn');
    const simulatedSurveyBtn = document.getElementById('simulated-survey-btn');
    const generateLinkSection = document.getElementById('generate-link-section');
    const directSurveySection = document.getElementById('direct-survey-section');
    const simulatedSurveySection = document.getElementById('simulated-survey-section');
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');

    // Mostrar sección de generar enlace y QR
    generateLinkBtn.addEventListener('click', function() {
        generateLinkSection.classList.remove('d-none');
        directSurveySection.classList.add('d-none');
        simulatedSurveySection.classList.add('d-none');
        errorMessage.classList.add('d-none');
        successMessage.classList.add('d-none');

        // Mostrar el enlace
        document.getElementById('survey-url').value = surveyUrl;

        // Generar el código QR
        const qrImage = document.getElementById('qr-image');
        qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(surveyUrl)}`;
    });

    // Mostrar sección de encuesta directa
    directSurveyBtn.addEventListener('click', function() {
        directSurveySection.classList.remove('d-none');
        generateLinkSection.classList.add('d-none');
        simulatedSurveySection.classList.add('d-none');
        errorMessage.classList.add('d-none');
        successMessage.classList.add('d-none');
    });

    // Mostrar sección de encuesta simulada
    simulatedSurveyBtn.addEventListener('click', function() {
        simulatedSurveySection.classList.remove('d-none');
        generateLinkSection.classList.add('d-none');
        directSurveySection.classList.add('d-none');
        errorMessage.classList.add('d-none');
        successMessage.classList.add('d-none');
    });

    // Función para copiar el enlace al portapapeles
    function copyToClipboard() {
        const surveyUrlInput = document.getElementById('survey-url');
        surveyUrlInput.select();
        document.execCommand('copy');
        alert("Enlace copiado al portapapeles.");
    }

    // Manejar el envío del formulario de encuesta simulada
    document.getElementById('survey-form').addEventListener('submit', function(event) {
        event.preventDefault();

        // Ocultar mensajes anteriores
        errorMessage.classList.add('d-none');
        successMessage.classList.add('d-none');

        // Validar que todas las preguntas obligatorias estén respondidas
        const calidadComida = document.getElementById('calidad_comida').value;
        const servicioPersonal = document.getElementById('servicio_personal').value;
        const recomendacion = document.getElementById('recomendacion').value;
        const limpieza = document.getElementById('limpieza').value;

        if (!calidadComida || !servicioPersonal || !recomendacion || !limpieza) {
            errorMessage.classList.remove('d-none');
            return;
        }

        // Simular envío de respuestas (solo en consola)
        const respuestas = {
            calidad_comida: calidadComida,
            servicio_personal: servicioPersonal,
            recomendacion: recomendacion,
            limpieza: limpieza,
            comentarios: document.getElementById('comentarios').value
        };

        console.log("Respuestas simuladas:", respuestas);

        // Mostrar mensaje de éxito
        successMessage.classList.remove('d-none');

        // Limpiar el formulario (opcional)
        document.getElementById('survey-form').reset();
    });
</script>
@endsection

@push('styles')
<style>
    .qr-code img {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        background: white;
    }

    iframe {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .btn {
        margin-bottom: 10px;
    }
</style>
@endpush