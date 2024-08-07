// Hace la solicitud y muestra los usuarios
function fetchUsers() {
    fetch('index.php?action=getUsers')
        .then(response => response.json())
        .then(data => {
            const usersDiv = document.getElementById('users');
            usersDiv.innerHTML = '';
            data.forEach(user => {
                const userElement = document.createElement('div');
                userElement.textContent = `ID: ${user.id}, Nombre: ${user.name}, Apellido: ${user.surname}, Cargo: ${user.job}, Email: ${user.email}`;
                usersDiv.appendChild(userElement);
            });
        });
}

// Agrega un nuevo usuario
document.getElementById('addUserForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const surname = document.getElementById('surname').value;
    const email = document.getElementById('email').value;
    const job = document.getElementById('job').value;
    const password = document.getElementById('password').value;

    fetch('index.php?action=createUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name,
            surname,
            email,
            job,
            password
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchUsers();
                document.getElementById('addUserForm').reset();
            } else {
                alert(data.error);
            }
        });
});

// Actualiza un usuario existente
document.getElementById('updateUserForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const id = document.getElementById('updateId').value;
    const name = document.getElementById('updateName').value;
    const surname = document.getElementById('updateSurname').value;
    const job = document.getElementById('updateJob').value;
    const email = document.getElementById('updateEmail').value;
    const password = document.getElementById('updatePassword').value;

    fetch('index.php?action=updateUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id,
            name,
            surname,
            job,
            email,
            password
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchUsers();
                document.getElementById('updateUserForm').reset();
            } else {
                alert(data.error);
            }
        });
});

// Elimina un usuario
document.getElementById('deleteUserForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const id = document.getElementById('deleteId').value;

    fetch('index.php?action=deleteUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    })
        .then(response => response.json())
        .then(data => {
            if (data.deleted) {
                fetchUsers();
                document.getElementById('deleteUserForm').reset();
            } else {
                alert('Error al eliminar el usuario');
            }
        });
});

// Fetch inicial para la carga de los usuarios apenas carga la página
document.addEventListener('DOMContentLoaded', fetchUsers);