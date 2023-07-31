# Требуется реализовать хэндлер одного из API в воображаемом сервисе

<?php

declare(strict_types=1);

// Некий класс ответа на запрос из нашего фреймворка. Приведен просто для референса
class Response
{
    public function __construct(
        public string $content,
        public int $code
    ) {
    }

    // ...
}

interface Configurable {

}

class Config implemets Configurable{
    //readonly
    public int timeoutMs;

    public int memoryLimitMb = 250;

    public string logLocation = '/log.txt';

}


class LogController
{

    private Configurable $config;
    private int $startStampMs;
    private int $currentStampMs;
    private int $foundErrors = 0;

    /**
     * Метод numberOfErrors возвращает в ответ json, со следующей структурой:
     * {
     *   "found_errors": <int>
     * }
     *
     * Он выполняется максимум X мс, которые мы можем задать в конфиге.
     * Он проходится по файлу log.txt и ищет там ошибки с кодом $errorCode.
     * Он возвращает количество найденных ошибок за период времени.
     *
     * На сервере для PHP процесса выделяется 250 mb памяти. Размер файла log.txt - 10gb
     * Файл расположен в корне (/log.txt), его содержимое:
     * <timestamp>;<error_code>
     */
__construct(Configurable $config){
    $this->config = $config;
}



private function getTimeStamp(): int{
 return (int)round(microtime(true)/1000);
}

    #[Route('numberOfErrors/{errorCode}')]
    public function numberOfErrors(int $errorCode): Response
    {
        // написать имплементацию метода
        $this->startStampMs = $this->getTimeStamp();
        //todo refactor to di
        if ($file = fopen($this->config->logLocation, 'r')){
            
            while ($line = fgets($file)) do {
                    $lineArray = explode($line, ';');
                    if ($lineArray[1] == $errorCode){
                        $this->foundErrors ++;
                    }

                    //todo check mem & time 
                    $this->currentStampMs = $this->getTimeStamp();
            }
        


        } else {
           return new Response('', 500); 
        }



        

        return new Response('', 200);
    }
}
