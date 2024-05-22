<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MaxMat - Matury</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/style.css">

</head>

<body>
    <header>
        <a href="index.php" title="Powrót do strony głównej">
            <h1>Matury (uporządkowane miesiącami)</h1>
        </a>
    </header>
    <div id="container">

        <?php
        // Ścieżka do folderu
        $folder_path = 'matury/';

        // Pobierz wszystkie pliki z folderu
        $files = glob($folder_path . '*.pdf');

        // Posortuj pliki według miesiąca
        usort($files, function ($a, $b) {
            preg_match('/matematyka-(\d{4})-(\w+)/', $a, $matches_a);
            preg_match('/matematyka-(\d{4})-(\w+)/', $b, $matches_b);
            $month_order = [
                'styczen', 'luty', 'marzec', 'kwiecien', 'maj', 'czerwiec',
                'lipiec', 'sierpien', 'wrzesien', 'pazdziernik', 'listopad', 'grudzien'
            ];

            // Dla plików z "Operon" i "Nowa Era" traktuj je jako miesiąc, który jest poza porządkiem standardowych miesięcy
            if (strpos($a, 'operon') !== false) $month_a = 'operon';
            elseif (strpos($a, 'nowa-era') !== false) $month_a = 'nowa-era';
            else $month_a = isset($matches_a[2]) ? $matches_a[2] : '';

            if (strpos($b, 'operon') !== false) $month_b = 'operon';
            elseif (strpos($b, 'nowa-era') !== false) $month_b = 'nowa-era';
            else $month_b = isset($matches_b[2]) ? $matches_b[2] : '';

            // Dla plików z "Operon" i "Nowa Era" traktuj je jako miesiąc poza porządkiem standardowych miesięcy
            if ($month_a == 'operon') $month_index_a = count($month_order);
            elseif ($month_a == 'nowa-era') $month_index_a = count($month_order) + 1;
            else $month_index_a = array_search($month_a, $month_order);

            if ($month_b == 'operon') $month_index_b = count($month_order);
            elseif ($month_b == 'nowa-era') $month_index_b = count($month_order) + 1;
            else $month_index_b = array_search($month_b, $month_order);

            return $month_index_a - $month_index_b; // Sortuj rosnąco według miesiąca
        });

        // Iteruj przez posortowane pliki i wyświetl je z odpowiednim nagłówkiem
        $current_month = '';
        $i = 0;
        foreach ($files as $file) {
            preg_match('/matematyka-(\d{4})-(\w+)/', $file, $matches);
            $year = isset($matches[1]) ? $matches[1] : '';
            $month = isset($matches[2]) ? $matches[2] : '';

            // Jeśli miesiąc się zmienił, wyświetl nowy nagłówek
            if ($month !== $current_month) {
                $current_month = $month;
                echo "<h2>Arkusze z $month:</h2>";
            }

            // Wyświetl link do pliku
            $filename = basename($file);
            echo '<div class="link_box"><a href="' . $file . '">' . $i + 1 . '. ' . $filename . '</a></div>';
            $i++;
        }
        echo $i;
        ?>
    </div>

    <footer>
        Wykonanie strony - Joachim Rychliński
    </footer>

</body>

</html>