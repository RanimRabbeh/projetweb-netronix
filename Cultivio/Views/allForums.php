<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Forums</title>
</head>

<body>
    <h1>All Forum Entries</h1>
    <a href="/cultivio/views/addforum.php">Add New Forum Entry</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Avis</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($forums)) : ?>
                <?php foreach ($forums as $forum) : ?>
                    <tr>
                        <td><?= htmlspecialchars($forum['avisID']) ?></td>
                        <td><?= htmlspecialchars($forum['utilisateur']) ?></td>
                        <td><?= htmlspecialchars($forum['avis']) ?></td>
                        <td><?= htmlspecialchars($forum['created_at'] ?? 'N/A') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No forum entries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>