<pre><?php var_dump($comments); ?></pre>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Details</title>
</head>

<body>
    <h1>Forum Details</h1>
    <h3>Forum Content:</h3>
    <p><?= htmlspecialchars($forum['contenu']) ?></p>
    <p>Likes: <?= $forum['likes'] ?> | Date: <?= $forum['date'] ?></p>

    <h3>Comments:</h3>
    <ul>
        <?php if (!empty($comments)) : ?>
            <?php foreach ($comments as $comment) : ?>
                <li>
                    <strong><?= htmlspecialchars($comment['nomUtilisateur']) ?>:</strong>
                    <?= htmlspecialchars($comment['Contenu']) ?>
                    <em>(<?= $comment['DatePublication'] ?>)</em>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No comments yet.</li>
        <?php endif; ?>
    </ul>

    <h3>Add a Comment:</h3>
    <form action="/cultivio/index.php?action=addComment" method="POST">
        <input type="hidden" name="idForum" value="<?= $forum['IdForum'] ?>">
        <input type="text" name="nomUtilisateur" placeholder="Your Name" required><br>
        <textarea name="contenu" rows="4" required></textarea><br>
        <button type="submit">Add Comment</button>
    </form>

</body>

</html>