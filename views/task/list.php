<?php require 'views/header.php'; ?>

<h1>Liste des tâches</h1>

<a href="/tasks/create">Créer une nouvelle tâche</a>

<table>
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task->id ?></td>
            <td><?= $task->title ?></td>
            <td><?= $task->description ?></td>
            <td>
                <a href="/tasks/edit?id=<?= $task->id ?>">Éditer</a>
                <a href="/tasks/delete?id=<?= $task->id ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette tâche ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'views/footer.php'; ?>
