<?php
$fileName = $argv[1]; // Название файла
$action = $argv[2]; // Действие
$line = $argv[3]; // Строка, которую записываем в файл

class File {
    private string $fileName;

    public function __construct(string $fileName, string $action)
    {
        $this->fileName = $fileName;
        if(!self::fileCheck($this->fileName)) {
            exit('Файл не найден');
        }

        if(!method_exists($this, $action)) {
            exit('Действие не найдено');
        }
    }

    private static function fileCheck(string $fileName) : bool
    {
        return file_exists($fileName);
    }
    protected function getOpenFileForWriting()
    {
        $fileForWriting =  fopen($this->fileName, 'a') or die("Не удалось открыть файл");
        return $fileForWriting;
    }

    public function add(string $line)
    {
        $openFileForWriting = $this->getOpenFileForWriting();
        fwrite($openFileForWriting, $line . PHP_EOL);
        fclose($openFileForWriting);
        echo 'Строка добавлена';
    }
}


$objFile = new File(fileName: $fileName, action: $action);
$objFile->$action($line);

$lines = explode("\n",file_get_contents("products.txt"));
var_dump($lines);

