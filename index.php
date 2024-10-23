<?php
// Notları oku
$notlar = file_exists('notlar.txt') ? file('notlar.txt', FILE_IGNORE_NEW_LINES) : [];

// Not ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['note'])) {
    $note = htmlspecialchars(trim($_POST['note']));
    file_put_contents('notlar.txt', $note . PHP_EOL, FILE_APPEND);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Not silme işlemi
if (isset($_GET['delete'])) {
    unset($notlar[$_GET['delete']]);
    file_put_contents('notlar.txt', implode(PHP_EOL, $notlar) . PHP_EOL);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Not Defteri</title>
</head>
<body>
    <div class="container">
        <h1>Not Defteri            YAPTIIIMMM :) </h1>D
        <form method="POST">
            <textarea name="note" required></textarea>
            <button type="submit">Kaydet !!!!!!</button>
        </form>
        <h2>Notlar</h2>
        <div class="notes">
            <?php if (empty($notlar)): ?>
                <p>Henüz not yok.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($notlar as $index => $not): ?>
                        <li>
                            <?= htmlspecialchars($not) ?>
                            <a href="?delete=<?= $index ?>">Sil</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
