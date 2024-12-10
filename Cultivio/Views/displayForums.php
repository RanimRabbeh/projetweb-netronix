<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Forums</title>
</head>

<body>
    <h1>All Forums</h1>

    <?php if (!empty($forumsWithComments)) : ?>
        <?php foreach ($forumsWithComments as $forumData) : ?>
            <div>
                <h2>Forum: <?= htmlspecialchars($forumData['forum']['contenu']) ?></h2>
                <p>By: <?= htmlspecialchars($forumData['forum']['nomUtilisateur']) ?> | Likes: <?= $forumData['forum']['likes'] ?> | Date: <?= $forumData['forum']['date'] ?></p>
                <h3>Comments:</h3>
                <ul>
                    <?php if (!empty($forumData['comments'])) : ?>
                        <?php foreach ($forumData['comments'] as $comment) : ?>
                            <li>
                                <strong>User <?= htmlspecialchars($comment['idUtilisateur']) ?>:</strong>
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
                    <input type="hidden" name="idForum" value="<?= $forumData['forum']['IdForum'] ?>">
                    <input type="hidden" name="idUtilisateur" value="1"> <!-- Replace with actual user ID -->
                    <textarea name="contenu" rows="4" required></textarea><br>
                    <button type="submit">Add Comment</button>
                </form>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No forums available.</p>
    <?php endif; ?>

</body>

</html>