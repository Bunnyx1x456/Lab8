<?php

$surveyDirectory = 'C:\xampp\htdocs\surveys'; // Або 'surveys' якщо папка знаходиться в тій самій директорії, що і скрипт
$surveyData = [];

// Отримання списку файлів з анкетами
$files = glob($surveyDirectory . '/survey_*.json');


foreach ($files as $file) {
    $jsonData = file_get_contents($file);
    if ($jsonData !== false) {
        $survey = json_decode($jsonData);
        if ($survey !== null && json_last_error() === JSON_ERROR_NONE) {
            $surveyData[] = $survey;
        } else {
            // Обробка помилки розкодування JSON
            error_log("Помилка розкодування JSON у файлі: " . $file);
        }
      } else {
        error_log("Помилка читання файлу: " . $file);

      }
}

// Встановлення заголовка для JSON
header('Content-Type: application/json');

// Виведення JSON
echo json_encode($surveyData, JSON_UNESCAPED_UNICODE);

?>