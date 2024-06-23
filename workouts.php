<?php
include 'obtener_ejercicios.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness AI</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="bg-gray-100">

    <header class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
        <div class="flex items-center">
            <img class="mr-2" src="Popeye_90th_logo_fnl_5B1_5D.webp" alt="logo" style="max-width:50px">
            <h1 class="text-lg font-semibold">Popeye AI</h1>
        </div>
        <nav>
            <a class="text-white mr-3" href="index.php">Dashboard</a>
            <a class="text-white mr-3" href="#">Workouts</a>
            <div class="dropdown inline-block relative hidden">
                <button class="text-white focus:outline-none" id="userDropdown">
                    Usuario
                    <i class="fas fa-caret-down ml-1"></i>
                </button>
                <ul class="dropdown-menu absolute text-gray-700 bg-white shadow-lg">
                    <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Perfil</a></li>
                    <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Configuración</a></li>
                    <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#" id="logoutBtn">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="py-8 px-6 flex-grow">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-bold mb-2">Principiante</h3>
                    <p class="text-gray-600 mb-4">Ejercicios para principiantes.</p>
                    <button class="btn btn-primary w-full" onclick="toggleExercises('principiante')">Ver ejercicios</button>
                    <div id="principiante" class="hidden mt-4"></div>
                </div>
                <div class="card bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-bold mb-2">Intermedio</h3>
                    <p class="text-gray-600 mb-4">Ejercicios para nivel intermedio.</p>
                    <button class="btn btn-primary w-full" onclick="toggleExercises('intermedio')">Ver ejercicios</button>
                    <div id="intermedio" class="hidden mt-4"></div>
                </div>
                <div class="card bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-bold mb-2">Avanzado</h3>
                    <p class="text-gray-600 mb-4">Ejercicios para nivel avanzado.</p>
                    <button class="btn btn-primary w-full" onclick="toggleExercises('avanzado')">Ver ejercicios</button>
                    <div id="avanzado" class="hidden mt-4"></div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
        <p class="mb-0">© 2023 Popeye AI. Todos los derechos reservados.</p>
    </footer>

    <!-- Chatbot Button -->
    <div class="chatbot-button" id="chatbotButton">
        <i class="fas fa-comments"></i>
    </div>

    <!-- Chatbot Window -->
    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">Fitness AI Chatbot</div>
        <div class="chatbot-body" id="chatbox">
            <!-- Chat messages will appear here -->
        </div>
        <div class="chatbot-input">
            <input type="text" id="userInput" placeholder="Escribe tu mensaje...">
            <button id="sendBtn">Enviar</button>
        </div>
    </div>

    <!-- Modal -->
    <div id="videoModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg overflow-hidden">
            <div class="px-4 py-2 flex justify-between items-center bg-gray-800 text-white">
                <h3 class="text-lg font-semibold">Video del Ejercicio</h3>
                <button class="text-white" onclick="closeModal()">X</button>
            </div>
            <div class="p-4">
                <iframe id="exerciseVideo" width="560" height="315" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>
    <script src="js/chatbot.js"></script>
    <script src="js/authfirebase.js"></script>
    <script>
        function toggleExercises(category) {
            const container = document.getElementById(category);

            if (container.classList.contains('hidden')) {
                // Ocultar todas las demás categorías
                document.querySelectorAll('.category-container').forEach(el => {
                    el.classList.add('hidden');
                });

                // Mostrar la categoría seleccionada
                fetchExercises(category);
            } else {
                // Ocultar la categoría seleccionada
                container.classList.add('hidden');
            }
        }

        function fetchExercises(category) {
            fetch(`obtener_ejercicios.php?categoria=${category}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById(category);
                    container.innerHTML = data.map(ejercicio => `
                        <li class="mb-2 flex items-center">
                            <span><strong>${ejercicio.nombre}</strong> - ${ejercicio.descripcion}</span>
                            ${ejercicio.video_url ? `<button class="ml-2 text-blue-500 hover:text-blue-700" onclick="showVideo('${ejercicio.video_url}')"><i class="fas fa-play"></i></button>` : ''}
                        </li>
                    `).join('');
                    container.classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching exercises:', error));
        }

        function showVideo(url) {
            const modal = document.getElementById('videoModal');
            const videoFrame = document.getElementById('exerciseVideo');
            videoFrame.src = url;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('videoModal');
            const videoFrame = document.getElementById('exerciseVideo');
            videoFrame.src = '';
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>
