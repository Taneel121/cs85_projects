<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>T‑Shirt Price Engine — Refactored</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f6f8; color: #333;
               display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .receipt { background-color: #fff; padding: 2rem; border-radius: 8px;
                   box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 400px; border-top: 5px solid #005a9c; }
        h1 { text-align: center; color: #005a9c; }
        ul { list-style: none; padding: 0; }
        li { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; }
        .total { font-size: 1.5em; color: #28a745; }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Order Summary</h1>
        <?php
            /* ----------------------  CONFIG (play with these!)  ---------------------- */
            $size              = 'XL';            // 'S', 'M', 'L', 'XL'
            $color             = 'Sunset Orange'; // any string
            $isCustomized      = true;            // true or false
            $customerFirstName = 'Michael';       // ← YOUR first name

            /* ---------------------------  PRICING ENGINE  --------------------------- */
            $finalPrice = 22.50;
            $details    = "<li>Base Price: <span>$" . number_format($finalPrice, 2) . "</span></li>";

            /* Size upcharges  */
            if ($size === 'L') {
                $finalPrice += 1.75;
                $details .= "<li>Size (L) Upcharge: <span>+$1.75</span></li>";
            } elseif ($size === 'XL') {
                $finalPrice += 2.50;
                $details .= "<li>Size (XL) Upcharge: <span>+$2.50</span></li>";
            }

            /* Premium colors (either Sunset Orange OR Ocean Blue) */
            if (in_array($color, ['Sunset Orange', 'Ocean Blue'])) {
                $finalPrice += 2.00;
                $details    .= "<li>Premium Color ($color): <span>+$2.00</span></li>";
            }

            /* Customization fee */
            if ($isCustomized) {
                $finalPrice += 5.00;
                $details    .= "<li>Customization Fee: <span>+$5.00</span></li>";
            }

            /* Additional XL customization handling */
            if ($isCustomized && $size === 'XL') {
                $finalPrice += 3.00;
                $details    .= "<li>XL Handling Fee (customized): <span>+$3.00</span></li>";
            }

            /* Long‑name discount */
            if (strlen($customerFirstName) > 6) {
                $finalPrice -= 1.00;
                $details    .= "<li>Long‑Name Discount: <span>−$1.00</span></li>";
            }

            /* ---------------------------  OUTPUT  --------------------------- */
            echo "<ul>$details</ul>";
            echo "<ul><li><span class='total'>Final Price:</span> <span class='total'>$" .
                 number_format($finalPrice, 2) .
                 "</span></li></ul>";

            /*
            ============================================================================
            MY DEBUGGING LOG:
            ----------------------------------------------------------------------------
            Problem: I kept getting a premium color charge for regular colors like "Black".
            Solution: I mistakenly used:
                if ($color == 'Sunset Orange' || 'Ocean Blue')
            This always returned true because 'Ocean Blue' is a non-empty string.
            I learned I need to compare each side separately, like:
                if ($color == 'Sunset Orange' || $color == 'Ocean Blue')
            To make it even cleaner, I switched to:
                if (in_array($color, ['Sunset Orange', 'Ocean Blue']))
            That solved the problem and helped me understand how logical conditions work.
            */
        ?>
    </div>
</body>
</html>
