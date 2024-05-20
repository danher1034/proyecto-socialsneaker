document.getElementById('search').addEventListener('input', function() {
    let search = this.value;
    if (search.length > 0) {
        fetch(`{{ route('chat.search') }}?search=${search}`)
            .then(response => response.json())
            .then(data => {
                let usersList = document.getElementById('user-results');
                usersList.innerHTML = '';
                data.forEach(user => {
                    let li = document.createElement('li');
                    li.classList.add('clearfix');
                    li.innerHTML = `
                        <a href="/chat/show/${user.id}" class="user-link">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                            <div class="about">
                                <div class="name">${user.name}</div>
                                <div class="status">Último mensaje que ha enviado</div>
                            </div>
                        </a>
                    `;
                    usersList.appendChild(li);
                });
            });
    } else {
        // If search is empty, reset the list to show all users or any desired default behavior
    }
});


