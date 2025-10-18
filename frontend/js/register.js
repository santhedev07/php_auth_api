document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    // ✅ Validasi frontend
    if (!username || !password) {
        alert("Username dan password tidak boleh kosong!");
        return;
    }

    const res = await fetch('http://localhost/to_dolist_php/backend/api/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password }),
    });

    const data = await res.json();
    alert(data.message);
    if (data.ok) {
        window.location.href = 'login.html';
    }
});
