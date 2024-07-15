<?php require 'views/header.php'; ?>

<h1>Éditer la tâche</h1>

<form action="/tasks/update" method="post">
    <input type="hidden" name="id" value="<?= $task->id ?>">
    
    <label for="title">Titre:</label>
    <input type="text" id="title" name="title" value="<?= $task->title ?>">
    
    <label for="description">Description:</label>
    <textarea id="description" name="description"><?= $task->description ?></textarea>
    
    <button type="submit">Mettre à jour</button>
</form>

<?php require 'views/footer.php'; ?>
