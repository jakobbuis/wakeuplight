<?php
    $triggerFile = __DIR__ . '/../trigger';
    $stored = false;
    // Form handling
    if (isset($_POST['trigger'])) {
        $trigger = substr(trim($_POST['trigger']), 0, 5);
        file_put_contents($triggerFile, $trigger);
        $stored = true;
    } else {
        // Show the current trigger setting in the form
        $trigger = trim(file_get_contents($triggerFile));
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wakeuplight</title>

    <style type="text/css">
        .notification {
            display: block;
            color: #1f9d55;
            padding: 1rem;
            border-left-width: 4px;
            border-color: #38c172;
            background-color: #e3fcec;
            border-left-style: solid;
            width: 14rem;
        }
    </style>
</head>
<body>
    <h1>Set timer</h1>

    <?php if($stored): ?>
        <p class="notification">
            Trigger set to <?= $trigger ?>
        </p>
    <?php endif; ?>

    <form method="post">
        <input type="time" name="trigger" required value="<?= $trigger ?>">
        <button type="submit">Set trigger time</button>
    </form>
</body>
</html>
