<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
            background-color: #f4f4f4;
            border-radius: 5px;
        }

        input[type="text"] {
            width: 80%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .delete-btn {
            background-color: #f44336;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    // Koneksi ke database MySQL
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'login_db';

    $connection = mysqli_connect($host, $user, $password, $database);

    if (!$connection) {
        die('Koneksi gagal: ' . mysqli_connect_error());
    }

    // Menambahkan tugas baru
    if (isset($_POST['task'])) {
        $task = $_POST['task'];

        $query = "INSERT INTO tasks (task_name) VALUES ('$task')";
        mysqli_query($connection, $query);
    }

    // Menghapus tugas
    if (isset($_GET['delete'])) {
        $taskId = $_GET['delete'];

        $query = "DELETE FROM tasks WHERE id = $taskId";
        mysqli_query($connection, $query);
    }

    // Mengambil daftar tugas
    $query = "SELECT * FROM tasks ORDER BY created_at DESC";
    $result = mysqli_query($connection, $query);
    ?>

    <h2>To-Do List</h2>

    <form method="post" action="todolist.php">
        <input type="text" name="task" placeholder="Tambahkan tugas baru" required>
        <input type="submit" value="Tambah">
    </form>

    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <?php echo $row['task_name']; ?>
                <button class="delete-btn" onclick="deleteTask(<?php echo $row['id']; ?>)">Hapus</button>
            </li>
        <?php } ?>
    </ul>

    <script>
        function deleteTask(taskId) {
            if (confirm('Anda yakin ingin menghapus tugas ini?')) {
                window.location.href = 'todolist.php?delete=' + taskId;
            }
        }
    </script>
</body>
</html>
