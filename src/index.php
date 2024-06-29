<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="output.css" rel="stylesheet" >
    <title>My php calculator</title>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
<div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-5 text-center">Calculator</h1>
        <form method="POST" action="index.php" class="space-y-4">
            <div class="flex flex-wrap -mx-2">
                <input type="hidden" name="display" id="display" value="<?php echo isset($_POST['display']) ? htmlspecialchars($_POST['display']) : ''; ?>">
                <input type="hidden" name="operation" id="operation" value="<?php echo isset($_POST['operation']) ? htmlspecialchars($_POST['operation']) : ''; ?>">
                <div class="w-full px-2">
                    <input type="text" class="w-full p-4 text-right border rounded-md" value="<?php echo isset($_POST['display']) ? htmlspecialchars($_POST['display']) : ''; ?>" disabled>
                </div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="7" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">7</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="8" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">8</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="9" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">9</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="+" class="w-full p-4 m-1 text-2xl bg-yellow-400 rounded">+</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="4" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">4</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="5" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">5</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="6" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">6</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="-" class="w-full p-4 m-1 text-2xl bg-yellow-400 rounded">-</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="1" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">1</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="2" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">2</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="3" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">3</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="*" class="w-full p-4 m-1 text-2xl bg-yellow-400 rounded">*</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="0" class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">0</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="." class="w-full p-4 m-1 text-2xl bg-gray-200 rounded">.</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="C" class="w-full p-4 m-1 text-2xl bg-red-400 rounded">C</button></div>
                <div class="w-1/4 px-2"><button type="submit" name="btn" value="/" class="w-full p-4 m-1 text-2xl bg-yellow-400 rounded">/</button></div>
                <div class="w-full px-2"><button type="submit" name="btn" value="=" class="w-full p-4 m-1 text-2xl bg-green-500 rounded">=</button></div>
            </div>
        </form>
        <div class="mt-5 text-center">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $display = isset($_POST['display']) ? $_POST['display'] : '';
                $btn = $_POST['btn'];
                $operation = isset($_POST['operation']) ? $_POST['operation'] : '';

                function evaluateExpression($expression) {
                    $expression = preg_replace('/[^0-9+\-*/().]/', '', $expression); // Sanitize input
                    $result = @eval("return $expression;");
                    return $result;
                }

                if ($btn == 'C') {
                    $display = '';
                } elseif ($btn == '=') {
                    $result = evaluateExpression($display);
                    $display = $result !== false ? $result : 'Error';
                } else {
                    $display .= $btn;
                }

                echo "<script>document.getElementById('display').value = '$display';</script>";
                echo "<script>document.getElementById('operation').value = '$operation';</script>";
            }
            ?>
        </div>
    </div>
</body>
</html>