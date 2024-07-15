<?php require 'views/header.php'; ?>

<h1>Créer une nouvelle tâche</h1>

<form action="/tasks" method="post">
    <label for="title">Titre:</label>
    <input type="text" id="title" name="title">
    
    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea>
    
    <button type="submit">Enregistrer</button>
</form>

<?php require 'views/footer.php'; ?>
