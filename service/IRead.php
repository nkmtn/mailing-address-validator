<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use  PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter; 
require_once("vendor/autoload.php");
class IRead implements IReadFilter
{
    public $startRow = 0;

    private $endRow = 0;

    /**
     * Откуда читать
     *
     * @param mixed $startRow
     * @param mixed $chunkSize
     */
    public function setRows($startRow, $chunkSize)
    {
        $this->startRow = $startRow;
        $this->endRow = $startRow + $chunkSize;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        if (($row == 1) || ($row >= $this->startRow && $row < $this->endRow)) {
            return true;
        }

        return false;
    }

function file_read(string $str,string $f)
    {
    #$spreadsheet = $reader->load($str);
    #$sheetData   = $spreadsheet->getActiveSheet()->toArray();
    $reader = IOFactory::createReader($f);
    
        
            $chunkSize = 100000;
             
       
           // Цикл для чтения нашего рабочего листа блоками 
            for ($startRow = 1; $startRow <=  100;  $startRow += $chunkSize) {
                // Сообщаем фильтру чтения ограничения, по которым мы хотим читать эту итерацию
                     $chunkFilter = new IRead();
                    $reader->setReadFilter($chunkFilter);
                    $chunkFilter->setRows($startRow, $chunkSize);
                    // Загружаем только те строки, которые соответствуют нашему фильтру, из  в объект PhpSpreadsheet
                    $spreadsheet = $reader->load($str);
                    $sheetData   = $spreadsheet->getActiveSheet()->toArray();
                    $spreadsheet->__destruct();
                    $spreadsheet = null;
                    unset($spreadsheet);
                    $reader = null;
                    unset($reader);
                 
                return $sheetData;
                    }
    }

    function Parsefile(array $TABLE, int $target)
    {
        
        $count = count($TABLE);
       
        
        $c=count($TABLE);
        /* 3- Это адреса
           1 - Округ (Республика ....)
           2 - Время и дата
           4 - ??? int
           7 - тип платежа
           8 - компания
           9 - ИНН компании
           10 - Сумма денег
           11 - fee
         

      */
        for ($i = 0; $i <$count; $i++) {
            echo $TABLE[$i][$target]. "\n";
        } 

    }

    function file_write(array $str,string $filename)
    {
     // Формат array(" Регион ", "Улица", " ****  " ......)
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($str, NULL, 'A1');     
        $g= new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $g->save($filename.".csv");
      

    }



}

?>