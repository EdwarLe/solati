<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Users Management</title>
</head>

<body>
    <h1>Users Management</h1>
    <h2>Add User</h2>
    <form id="addUserForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="job">Job:</label>
        <input type="text" id="job" name="job" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Add User</button>
    </form>

    <h2>Update User</h2>
    <form id="updateUserForm">
        <label for="updateId">ID:</label>
        <input type="number" id="updateId" name="id" required><br>
        <label for="updateName">Name:</label>
        <input type="text" id="updateName" name="name"><br>
        <label for="updateSurname">Surname:</label>
        <input type="text" id="updateSurname" name="surname"><br>
        <label for="updateJob">Job:</label>
        <input type="text" id="updateJob" name="job"><br>
        <label for="updateEmail">Email:</label>
        <input type="email" id="updateEmail" name="email"><br>
        <label for="updatePassword">Password:</label>
        <input type="password" id="updatePassword" name="password"><br>
        <button type="submit">Update User</button>
    </form>

    <h2>Delete User</h2>
    <form id="deleteUserForm">
        <label for="deleteId">ID:</label>
        <input type="number" id="deleteId" name="id" required><br>
        <button type="submit">Delete User</button>
    </form>

    <h2>Users List</h2>
    <div id="users"></div>
    <script src="/js/index.js"></script>
</body>

</html>