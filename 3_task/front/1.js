function showForm(language) {
    document.getElementById('form-ru').style.display = 'none';
    document.getElementById('form-en').style.display = 'none';

    document.getElementById('post-list').innerHTML = '';

    if (language === 'ru') {
        document.getElementById('form-ru').style.display = 'block';
    } else if (language === 'en') {
        document.getElementById('form-en').style.display = 'block';
    }
}

async function addpost(language) {
    
    if (language === 'ru') {
        row_name = document.getElementById("name_ru").value;
        row_breed = document.getElementById("breed_ru").value;
    } else if (language === 'en') {
        row_name = document.getElementById("name_en").value;
        row_breed = document.getElementById("breed_en").value;
    }

    let formdata = new FormData();
    formdata.append('name', row_name);
    row_breed.length != 0 ? formdata.append('breed', row_breed) : formdata.append('breed_none', null);
    formdata.append('lang' , language);

    try {
        let res = await fetch('http://localhost:3000/1.php', {
            method: 'POST',
            body: formdata
        });
        
        let responseText = await res.text();
        
        //парсим JSON-ответ
        let jsonResponse = JSON.parse(responseText);

        //извлекаем массив posts
        let posts = jsonResponse.session.posts;

        //элемент в DOM, куда будем добавлять посты
        let postsContainer = document.getElementById('post-list');

        postsContainer.innerHTML = '';

         //проходим по массиву posts и добавляем каждый пост в контейнер
        posts.forEach(post => {
        let postElement = document.createElement('div');
        postElement.className = 'post';

        postElement.innerHTML = `
        <p>${post.respons}</p>
    `;

       //добавляем элемент поста в контейнер
        postsContainer.appendChild(postElement);
});

        //очищаем поля ввода
        if (language === 'ru') {
            document.getElementById("name_ru").value = "";
            document.getElementById("breed_ru").value = "";
        } else if (language === 'en') {
            document.getElementById("name_en").value = "";
            document.getElementById("breed_en").value = "";
        }
    } catch (error) {
        console.error('Error adding post:', error);
    }
}