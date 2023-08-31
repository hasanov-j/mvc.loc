    <div class="comments-container">
        <h1>Комментарии</h1>
        <div class="comment-list"">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <strong><?= $comment['firstname'] ?>:</strong>
                        <p><?= $comment['comment'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>