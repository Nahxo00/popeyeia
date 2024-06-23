<?php
session_start();

// Verificar si la sesión fue iniciada con Firebase o PHP
$isFirebaseSession = isset($_SESSION['google_user']);

session_destroy();

// Generar el código HTML y JavaScript
echo '<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>';
echo '<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-auth.js"></script>';
echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        const firebaseConfig = {
            apiKey: "AIzaSyD9Pi8SvibU314173FipcL9RKKe3abOCU0",
            authDomain: "popeyeia.firebaseapp.com",
            projectId: "popeyeia",
            storageBucket: "popeyeia.appspot.com",
            messagingSenderId: "687875718938",
            appId: "1:687875718938:web:3609a7a070ab30d544b6a3"
        };
        firebase.initializeApp(firebaseConfig);

        function logout() {
            firebase.auth().signOut().then(() => {
                console.log("Usuario desconectado de Firebase");
                window.location.href = "/popeyeia/sesion/login.php";
            }).catch((error) => {
                console.error("Error al cerrar sesión de Firebase:", error);
                window.location.href = "/popeyeia/sesion/login.php";
            });
        }

        // Si la sesión es de Firebase, cerrar sesión en Firebase también
        var isFirebaseSession = ' . json_encode($isFirebaseSession) . ';
        if (isFirebaseSession) {
            logout();
        } else {
            window.location.href = "/popeyeia/sesion/login.php";
        }
    });
</script>';
?>
