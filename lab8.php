<?php

$url = 'http://lab.vntu.org/api-server/lab8.php?user=student&pass=p%40ssw0rd';

$json_data = file_get_contents($url);

if ($json_data === false) {
    // ... (обробка помилки file_get_contents)
} else {
    $data = json_decode($json_data);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // ... (обробка помилки json_decode)
    } else {
        echo '<table>';
        echo '<tr><th>Ім\'я</th><th>Вік</th><th>Афіліація</th><th>Звання</th><th>Локація</th></tr>'; // Додані заголовки для інших полів

        // Цикл по зовнішньому масиву
        foreach ($data as $group) {
            // Цикл по внутрішньому масиву об'єктів
            foreach ($group as $person) {
              if (isset($person->name) && isset($person->affiliation) && isset($person->rank) && isset($person->location)) {
                 echo '<tr>';
                  echo '<td>' . htmlspecialchars($person->name) . '</td>';
                  // Замість віку виводимо інші дані
                  echo '<td>' . htmlspecialchars($person->affiliation) . '</td>';
                  echo '<td>' . htmlspecialchars($person->rank) . '</td>';
                  echo '<td>' . htmlspecialchars($person->location) . '</td>';
                  echo '</tr>';

              } else {
                 echo "<tr><td colspan='5'>Невірний формат даних в об'єкті person.</td></tr>";
              }
            }
        }

        echo '</table>';
    }
}

?>