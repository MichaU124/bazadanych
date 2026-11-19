<?php
$dbFile = __DIR__ . '/baza.sqlite';
$sqlFile = __DIR__ . '/baza.sql';

$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$check = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='uczniowie'")->fetch();
if (!$check && file_exists($sqlFile)) {
    $pdo->exec(file_get_contents($sqlFile));
}

$rows = $pdo->query("SELECT * FROM uczniowie")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>prostastrona</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 650px; margin: 40px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h1>pracadomowa</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Klasa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['imie']) ?></td>
                <td><?= htmlspecialchars($row['nazwisko']) ?></td>
                <td><?= htmlspecialchars($row['klasa']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>