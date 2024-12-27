<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GAMERFEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-4xl mx-auto px-4 ">
      <h1> "Bienvenido" </h1>
    </div>
    <div class="fixed bottom-4 right-4 p-6 mb-4 bg-blue-600 text-white rounded-lg shadow-lg" role="alert">
      <div class="text-lg font-medium">¡Gamerfest está a punto de comenzar!</div>
      <p class="mt-2 text-lg font-semibold">Tiempo restante:</p>
      <div id="countdown" class="text-2xl font-bold">00:00:00</div>
  </div>
  
  <script>
      // Configura la fecha y hora del evento (Gamerfest)
      const eventDate = new Date("2024-12-20T10:00:00").getTime(); // Cambia la fecha y hora del evento aquí
  
      // Actualiza el contador cada segundo
      const countdownFunction = setInterval(function() {
  
          // Obtiene la fecha y hora actual
          const now = new Date().getTime();
  
          // Calcula la distancia entre la fecha del evento y la fecha actual
          const distance = eventDate - now;
  
          // Calcula días, horas, minutos y segundos restantes
          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
          // Muestra el resultado en el elemento con id "countdown"
          document.getElementById("countdown").innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
  
          // Si la cuenta atrás ha terminado, muestra un mensaje
          if (distance < 0) {
              clearInterval(countdownFunction); // Detén la cuenta regresiva
              document.getElementById("countdown").innerHTML = "¡El evento ha comenzado!";
          }
      }, 1000);
  </script>
  
</body>
</html>