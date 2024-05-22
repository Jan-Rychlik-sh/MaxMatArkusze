<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../dist/style.css">
    <title>Egzaminy INF.03 (uporządkowane latami)</title>
</head>

<body>
    <header>
        <a href="../index.php" title="Powrót do strony głównej">
            <h1>Egzaminy INF.03 (uporządkowane latami)</h1>
        </a>
    </header>
    <div id="container">


        <?php
        // Ścieżka do folderu
        $folder_path = 'informatykDB/INF03/';

        // Pobierz wszystkie pliki z folderu
        $files = glob($folder_path . '*.pdf');

        // Posortuj pliki według roku malejąco
        usort($files, function ($a, $b) {
            preg_match('/(\d{4})/', $a, $matches_a);
            preg_match('/(\d{4})/', $b, $matches_b);
            $year_a = isset($matches_a[1]) ? intval($matches_a[1]) : 0;
            $year_b = isset($matches_b[1]) ? intval($matches_b[1]) : 0;
            return $year_b - $year_a; // Sortuj malejąco według roku
        });

        // Iteruj przez posortowane pliki i wyświetl je z nagłówkiem dla każdego roku
        $current_year = 0;
        $i = 0;
        foreach ($files as $file) {
            preg_match('/(\d{4})/', $file, $matches);
            $year = isset($matches[1]) ? intval($matches[1]) : 0;
            if ($year != $current_year) {
                if ($current_year != 0) {
                    echo '</ul>'; // Zakończ poprzedni rok, jeśli istnieje
                }
                echo "<h2>Arkusze z $year roku:</h2><ul>";
                $current_year = $year;
            }
            $filename = basename($file);
            echo '<li><a href="' . $file . '">' . ($i + 1) . '.' . $filename . '</a></li>';
            $i++;
        }
        if ($current_year != 0) {
            echo '</ul>'; // Zakończ ostatni rok
        }
        ?>

    </div>
    <footer>
        Wykonanie strony - Joachim Rychliński
    </footer>
</body>

</html>