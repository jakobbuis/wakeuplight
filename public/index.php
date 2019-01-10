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

    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        button {
            color: #fff;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            font-weight: 700;
            border-radius: .25rem;
            background-color: #3490dc;
            -webkit-appearance: button;
            cursor: pointer;
            text-transform: none;
            font-size: 100%;
            line-height: 1.15;
            margin: 0;
            border: 0 solid #dae1e7;
        }

        input {
            color: #606f7b;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.1);
            padding-left: .75rem;
            padding-right: .75rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            margin-bottom: .75rem;
            line-height: 1.25;
            border-width: 1px;
            border-radius: .25rem;
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
