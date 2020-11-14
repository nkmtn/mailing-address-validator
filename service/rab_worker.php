<?php
namespace Acme\AmqpWrapper;
require_once(__DIR__ . 'vendor/autoload.php');
require_once("../IRead.php");
use PhpAmqpLib\Connection\AMQPConnection;


class WorkerA
{

    /**
     * Слушатели входящих сообщений
     */
    public function listen()
    {
        $connection = new AMQPConnection(
            'localhost',	#host
             15672,       	#port
            'guest',    	#user
            'guest'     	#password
            );

        $channel = $connection->channel();

        $channel->queue_declare(
            'PostAdress',	#имя очереди, такое же, как и у отправителя
            false,      	#пассивный
            false,      	#надёжный
            false,      	#эксклюзивный
            false       	#автоудаление
            );

        $channel->basic_consume(
            'PostAdress',                	#очередь
            '',                         	#тег получателя - Идентификатор получателя, валидный в пределах текущего канала. Просто строка
            false,                      	#не локальный - TRUE: сервер не будет отправлять сообщения соединениям, которые сам опубликовал
            true,                       	#без подтверждения - отправлять соответствующее подтверждение обработчику, как только задача будет выполнена
            false,                      	#эксклюзивная - к очереди можно получить доступ только в рамках текущего соединения
            false,                      	#не ждать - TRUE: сервер не будет отвечать методу. Клиент не должен ждать ответа
            array($this, 'Process')	            #функция обратного вызова - метод, который будет принимать сообщение
            );

        while(count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    /**
     * @param $msg
     */
    public function Process($msg)
    {
        
        /* Код для обработки таблиц */
    }
}