<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tasks for the Day</h1>
    
    <ul>
        <li>
            <strong>Task</Title>: </strong> <?= $task['title']; ?>
        </li>

        <li>
            <strong>Due</Title>: </strong> <?= $task['due']; ?>
        </li>

        <li>
            <strong>Assigned to</Title>: </strong> <?= $task['assigned_to']; ?>
        </li>

        <li>
            <strong>Completed</Title>: </strong> 
            <?php if($task['completed']): ?>
                <span class="icon">&#9989;</span>
            <?php else : ?>
                <span class="icon">Incomplete</span>
            <?php endif; ?>
        </li>
        <li>
            <strong>Important</Title>: </strong> 
            <?php if($task['important']): ?>
                <span class="icon">&#9989;</span>
            <?php else : ?>
                <span class="icon">Not Important</span>
            <?php endif; ?>
        </li>
    </ul>
</body>
</html>