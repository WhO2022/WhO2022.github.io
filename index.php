// Подключаем файл зависимостей
require "./vendor/autoload.php";
// Подключаем файл с классом Chat 
require "./chat.php";
 
// Подключаем все зависимости
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;
 
// Объявляем сервер
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);
 
// Запускаем сервер
$server->run();
