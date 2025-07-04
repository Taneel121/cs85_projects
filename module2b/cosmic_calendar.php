<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Calendar</title>
    <!-- Styling from starter file (unchanged) -->
    <style>
        body { font-family: sans-serif; background-color: #1a202c; color: #e2e8f0; }
        .container { max-width: 800px; margin: 2rem auto; padding: 2rem; background-color: #2d3748; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        h1 { text-align: center; color: #9f7aea; }
        .calendar-grid { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .day-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 5px; background-color: #4a5568; font-size: 1.2rem; }
        .cosmic-name { background-color: #9f7aea; color: #fff; transform: scale(1.1); box-shadow: 0 0 15px #9f7aea; }
        .cosmic-month { border: 2px solid #f6e05e; }
        .cosmic-both { background-color: #ed8936; color: #fff; border: 2px solid #f6e05e; transform: scale(1.1); box-shadow: 0 0 15px #ed8936; }
    </style>
</head>
<body>
<div class="container">
    <h1>Cosmic Calendar</h1>
    <div class="calendar-grid">
        <?php
            /* ---------- Step 1: variables & API ---------- */
            $firstName  = "Gathright";
            $nameLength = strlen($firstName);

            $jsonString = @file_get_contents('http://worldtimeapi.org/api/ip');
            if (!$jsonString) die("<p style='color:#f00'>World Time API unreachable.</p>");
            $data       = json_decode($jsonString);
            $dayOfYear  = (int)$data->day_of_year;
            $month      = (int)$data->month;

            /* ---------- Step 2: loop & logic ---------- */
            for ($i = $nameLength; $i <= $dayOfYear; $i++) {
                $css = "day-box";
                $divByName  = ($i % $nameLength === 0);
                $divByMonth = ($i % $month      === 0);

                if   ($divByName && $divByMonth) $css .= " cosmic-both";
                elseif ($divByName)              $css .= " cosmic-name";
                elseif ($divByMonth)             $css .= " cosmic-month";

                echo "<div class='$css'>$i</div>";
            }
        ?>
    </div>
</div>
</body>
</html>
