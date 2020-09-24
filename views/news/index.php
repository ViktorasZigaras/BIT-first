<?php
require ('list.php');

?>

<div class="admin-event-div">
    <input type="hidden" name="news_new" value="new news">
    <div class="admin-event-form-group">
        <label class="admin-label">Naujienos pavadinimas</label><br>
        <input type="text" id="content" placeholder="Įrašykite naujienos teksta..." class="admin-input">
    </div>
    <div class="admin-event-buttons">
        <button type="submit" id="create" name="input" class="admin-event-button">Pridėti</button>
    </div>
<div>
<br>




<script language='javascript'>

    const deleteButtons = document.querySelectorAll('.news-delete');
    deleteButtons.forEach((button, key) => {
        if (button) {
            console.log(key);
            button.addEventListener('click', () => { 
                console.log(key);
                axios.post('<?= $url ?>api', {route: 'news_destroy'}
                )  
                .then((response) => {  
                    console.log(response);
                    console.log(response.data.list);
                    document.querySelector('#list').innerHTML = response.data.list;

                // console.log(response.data); 
                })
                .catch((error) => {
                    console.log(error);
                });
            });
        }
    });
    // news_create
    const editButton = document.querySelector('#create');
    // console.log(editButton);
    // console.log('JS');
    if (editButton) {
        editButton.addEventListener('click', () => { 
            console.log('clicked');
            axios.get('<?= $url ?>api?route=news_store&content='+ document.querySelector('#news-content').value
            // , {route: 'test'}
            )
            // get can also have params
            .then((response) => {  
                // console.log(response);
                console.log(response.data);
                // console.log(response.data.html);
                // document.querySelector('.events-wrappers').innerHTML = response.data.html;
                // console.log(JSON.stringify(response))
                document.querySelector('#list').innerHTML = response.data.html;
            })
            .catch((error) => {
                console.log(error);
                // displayErrorMessages(error.response.data.errors);
            });
        });
    }
</script> 