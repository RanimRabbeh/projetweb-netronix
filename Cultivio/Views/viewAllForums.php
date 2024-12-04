<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Forums</title>
</head>

<body>
    <h1>All Forums</h1>

    <?php if (!empty($forums)) : ?>
        <?php foreach ($forums as $forum) : ?>
            <div style="border: 1px solid #ccc; margin-bottom: 20px; padding: 10px;">
                <h3><?= htmlspecialchars($forum['forumContent']) ?></h3>
                <p>
                    <strong>By:</strong> <?= htmlspecialchars($forum['forumUser']) ?>
                    | <strong>Likes:</strong> <?= $forum['likes'] ?>
                    | <strong>Date:</strong> <?= $forum['date'] ?>
                </p>
                <h4>Comments:</h4>
                <ul>
                    <?php if (!empty($forum['comments'])) : ?>
                        <?php foreach ($forum['comments'] as $comment) : ?>
                            <li>
                                <strong><?= htmlspecialchars($comment['commentUser']) ?>:</strong>
                                <?= htmlspecialchars($comment['commentContent']) ?>
                                <em>(<?= $comment['DatePublication'] ?>)</em>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li>No comments yet.</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No forums found.</p>
    <?php endif; ?>

</body>

</html>