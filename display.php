<?php
$filePath = __DIR__ . '/data/users.json';
$users = [];

if (file_exists($filePath)) {
    $jsonContent = file_get_contents($filePath);
    $users = json_decode($jsonContent, true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Students - StudentHub</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f4f9; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; background: #fff; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

    <h2>Registered Students List</h2>
    <a href="index.php">← Back to Registration Form</a>

    <?php if (!empty($users)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['fullName']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['mobile']); ?></td>
                        <td><?php echo htmlspecialchars($user['gender']); ?></td>
                        <td><?php echo htmlspecialchars($user['course']); ?></td>
                        <td><?php echo htmlspecialchars($user['year']); ?></td>
                        <td><?php echo htmlspecialchars($user['submittedAt']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No records found in JSON storage.</p>
    <?php endif; ?>

</body>
</html>