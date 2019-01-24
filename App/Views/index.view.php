<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>Base Project</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 4px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<h1>Add new employee</h1>
<form method="post" action="save">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="age" placeholder="Age">
    <input type="text" name="job_title" placeholder="Job title">
    <button type="submit">Save</button>
</form>
<br>
<hr>
<h1>Employees list</h1>

<table>
    <tr>
        <th>Remove</th>
        <th width="40%">Name</th>
        <th width="15%">Age</th>
        <th width="40%">Job Title</th>
    </tr>
<?php foreach ($employees as $employee): ?>
    <tr>
        <form method="post" action="remove">
        <input type="hidden" name="id" value="<?= $employee->id; ?>">
        <td><button formaction="remove">X</button></td></form>
        <td><?= $employee->name; ?></td>
        <td><?= $employee->age; ?></td>
        <td><?= $employee->job_title; ?></td>
    </tr>
<?php endforeach; ?>
</table>
</body>
</html>
