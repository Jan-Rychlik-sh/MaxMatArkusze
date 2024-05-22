<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/style.css">
    <title>MaxMat - Wzory</title>
</head>

<body>
    <header>
        <a href="index.php" title="Powrót do strony głównej">
            <h1>Wzory</h1>
        </a>
    </header>
    <div id="container">

        <?php
        // Ścieżka do folderu
        $folder_path = 'wzory/';
        // Sprawdź czy folder istnieje
        if (is_dir($folder_path)) {
            // Pobierz listę plików
            $files = scandir($folder_path);
            // Posortuj pliki wg lat
            rsort($files);
            // Iteruj przez pliki
            $i = 0;
            foreach ($files as $file) {
                // Pomijaj pliki . i ..
                if ($file != "." && $file != "..") {
                    // Sprawdź czy plik jest PDF
                    if (pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
                        // Pobierz rok z nazwy pliku
                        $year = substr($file, 0, 4);
                        // Wyświetl nagłówek roku, jeśli jest inny niż poprzedni
                        static $prev_year = '';
                        if ($year != $prev_year) {
                            $prev_year = $year;
                        }
                        // Wyświetl link do pliku
                        echo '<div class="link_box"><a href="' . $folder_path . $file . '">' . $i + 1 . "." . $file . '</a></div>';
                    }
                }
                $i++;
            }
        } else {
            echo "Folder '$folder_path' nie istnieje.";
        }
        ?>
    </div>
    <footer>
        Wykonanie strony - Joachim Rychliński
    </footer>
</body>

</html>