<?php
require ('list.php');


foreach ($news as $key => $post) {


    // var_dump($post->news_content); content 16, 

    echo '<div id="list">
    <div class="admin-event-div">
        <div class="admin-event-forms">
            <input type="hidden" name="news_update" value="update news">
            <input type="hidden" name="news_id" value="' . $post->ID  . '">
            <div class="admin-event-form-group">
                <label class="admin-label">Keisti naujienos pavadinimą:</label><br>
                <input class="admin-input" type="text" name="content" value="' . $post->news_content .'">
                <form id="form" method="POST" action="news_store" enctype="multipart/form-data">
                    <input type="file" class="admin-input" name="photo" value="photo">
                </div>
                <div class="admin-event-buttons">
                    <button type="submit" class="admin-event-button">Redaguoti</button>
                </div>
            </form>
        </div>
        <div>
            <div class="admin-event-buttons">
                <input type="hidden" name="news_delete" value="event_id">
                <input type="hidden" name="news_id" value="' . $post->ID . '">
                <button type="submit" class="admin-event-button">Trinti</button>
            </div>
        </div>
    </div>
</div>';
}    

?>

<div class="admin-event-div">
    <input type="hidden" name="news_new" value="new news">
    <div class="admin-event-form-group">
        <label class="admin-label">Naujienos pavadinimas</label><br>
        <input type="text" name="news-content" id="news-content" value="" placeholder="Įrašykite naujienos teksta..." class="admin-input">
   
   
        <!-- <input type="file" name="news-picture" id="news-picture" value="" class="admin-input"> -->
        <div class="admin-event-buttons">
            <button type="submit" id="create" class="admin-event-button">Pridėti</button>
        </div>
   </div>
    <!-- <form enctype="multipart/form-data" action="{route: 'news.index'}" method="POST">
        <input type="file" name="news-picture" id="news-picture" value="" class="admin-input">
        <div class="admin-event-buttons">
            <button type="submit" id="create" class="admin-event-button">Pridėti</button>
        </div>
    </form> -->
<div>
        <input type="text" id="news-content" value="" placeholder="Įrašykite naujienos teksta..." class="admin-input">
        <form id="form" method="POST" action="" enctype="multipart/form-data">
            <input type="file" class="admin-input" name="photo" value="photo">
            <div class="admin-event-buttons">
                 <button type="submit" id="create" class="admin-event-button">Pridėti</button> 
            </div>       
        </form>
      </div>    
<div>  
<br>





<script language='javascript'>

    const deleteButtons = document.querySelectorAll('.news-delete');
    deleteButtons.forEach((button, key) => {
        if (button) {
            // console.log(key);
            const id = button.dataset.id;
            button.addEventListener('click', () => { 
                console.log(key);
                console.log(id);
                axios.get('<?= $url ?>/?route=news_destroy&ID=' + id
                // axios.post('<?= $url ?>/?route=news_destroy', {ID: id}
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