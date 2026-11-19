<?php
$rows = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["run_db"])) {
    try {
        $conn = new PDO("sqlite:" . __DIR__ . "/baza.sqlite");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = file_get_contents(__DIR__ . "/baza.sql");
        $conn->exec($sql);

        $stmt = $conn->query("SELECT id, imie, nazwisko, klasa FROM uczniowie");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $message = "Baza danych została uruchomiona.";
    } catch (PDOException $e) {
        $message = "Błąd: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>PHP + SQLite (W3Schools style)</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin-top: 15px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>

<h2>Uruchamianie bazy danych</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <button type="submit" name="run_db">Uruchom bazę danych</button>
</form>

<?php if ($message != ""): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<?php if (count($rows) > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Klasa</th>
        </tr>
        <?php foreach ($rows as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row["id"]); ?></td>
            <td><?php echo htmlspecialchars($row["imie"]); ?></td>
            <td><?php echo htmlspecialchars($row["nazwisko"]); ?></td>
            <td><?php echo htmlspecialchars($row["klasa"]); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>