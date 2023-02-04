// Объявляем пространство имён
namespace MyApp;
 
// Подключаем нужные компоненты
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
 
// Создаём новый класс для обработки чата
class Chat implements MessageComponentInterface {
    // Свойство для хранения всех подключенных пользователей
    protected $clients;
   
    // Создаём конструктор класса
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
   
    // Метод для открывания нового подключения
    public function onOpen(ConnectionInterface $conn) {
        $ Добавляем нового пользователя
        $this->clients->attach($conn);
        // Выводим сообщение что есть новый пользователь
        echo "Новое подключение ({$conn->resourceId})\n";
    }
    
    // Метод для получения и отправки сообщений
    public function onMessage(ConnectionInterface $from, $msg) {
        // Вывод что сообщение получено
        echo "Получение сообщения: " . $msg;
        
        // Цикл для прохода по всем пользователям
        foreach ($this->clients as $client) {
            // Отправляем пользователю сообщение 
            $client->send($msg);
        }
    }
    
    // Метод для отключения пользователя
    public function onClose(ConnectionInterface $conn) {
        // Отключаем клиента
        $this->clients->detach($conn);
        
        // Выводим сообщение об отключение
        echo "Отключение пользователя {$conn->resourceId} \n";
    }
    
    // Метод для обработки ошибок
    public function onError(ConnectionInterface $conn, \Exception $e) {
        // Вывод Ошибки
        echo "Есть ошибка: {$e->getMessage()}\n";
       
        // Отключения соединения WS сервера
        $conn->close();
    }
}
