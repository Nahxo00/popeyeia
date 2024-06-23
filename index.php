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
            <img class="mr-2"src="Popeye_90th_logo_fnl_5B1_5D.webp" alt="logo" style="max-width:50px">
            <h1 class="text-lg font-semibold">Popeye AI</h1>
        </div>
        <nav>
            <a class="text-white mr-3" href="#">Dashboard</a>
            <a class="text-white mr-3" href="/popeyeia/workouts.php">Workouts</a>
            <div class="dropdown inline-block relative">
                <button class="text-white focus:outline-none" id="userDropdown">
                    Usuario <span id="username"><?php echo htmlspecialchars($user_name); ?></span>
                    <i class="fas fa-caret-down ml-1"></i>
                </button>
                <ul class="dropdown-menu absolute text-gray-700 bg-white shadow-lg " id="dropdownMenu">
                    <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Perfil</a></li>
                    <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Configuración</a></li>
                    <li><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="logout.php" id="logoutBtn">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <main class="py-8 px-6 flex-grow">
        <div class="container mx-auto">
            <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-md rounded p-4">
                    <h2 class="h4 font-semibold mb-3">Personalized Workouts</h2>
                    <p class="text-gray-600 mb-4">Get AI-powered workout recommendations tailored to your fitness level and goals.</p>
                    <button class="btn btn-primary w-full">
                        <i class="fas fa-running mr-2"></i>
                        Start Workout
                    </button>
                </div>
                <div class="bg-white shadow-md rounded p-4">
                    <h2 class="h4 font-semibold mb-3">Progress Tracking</h2>
                    <p class="text-gray-600 mb-4">Monitor your fitness progress and see how you're improving over time.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-100 rounded p-3 shadow-md">
                            <h3 class="font-semibold text-lg">75%</h3>
                            <p class="text-gray-600">Goal Progress</p>
                        </div>
                        <div class="bg-gray-100 rounded p-3 shadow-md">
                            <h3 class="font-semibold text-lg">+2 lbs</h3>
                            <p class="text-gray-600">Weight Change</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-8">
                <h2 class="h4 font-semibold mb-4">Workout Library</h2>
<<<<<<< HEAD
                <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-bold mb-2">Principiante</h3>
                    <p class="text-gray-600 mb-4">Ejercicios para principiantes.</p>
                    <button class="btn btn-primary w-full" onclick="toggleExercises('principiante')">Ver ejercicios</button>
                    <div id="principiante" class="hidden mt-4"></div>
=======
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="card">
                        <img src="/placeholder.svg" class="card-img-top" alt="Full Body Workout">
                        <div class="card-body">
                            <h5 class="card-title">Full Body Workoutasdasda</h5>
                            <p class="card-text text-gray-600">A comprehensive workout targeting all major muscle groups.</p>
                            <button class="btn btn-outline-primary w-full">Start Workout</button>
                        </div>
                    </div>
                    <!-- Repetir este bloque para otros elementos de la biblioteca de entrenamiento -->
>>>>>>> 471a5ae2fc3ee1456e89b839b979115958b6e31d
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
            </section>
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

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>
    <script src="js/chatbot.js"></script>
    <script src="js/authfirebase.js"></script>
    <script src="js/categoryWorkouts.js"></script>
    <script>
        // Maneja el evento de clic en el botón de usuario para mostrar/ocultar el dropdown
        document.getElementById("userDropdown").addEventListener("click", function () {
            document.getElementById("dropdownMenu").classList.toggle("show");
        });

        // Cerrar el dropdown si el usuario hace clic fuera de él
        window.onclick = function (event) {
            if (!event.target.matches('#userDropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
