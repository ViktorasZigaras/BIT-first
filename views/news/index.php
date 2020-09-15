<?php


foreach ($news as $key => $post) {

    $metas = get_post_meta($post->ID);

    echo '<div id="list">
    <div class="admin-event-div">
        <div class="admin-event-forms">
            <input type="hidden" name="event_update" value="update event">
            <input type="hidden" name="event_id" value="' . $post->ID  . '">
            <div class="admin-event-form-group">
                <label class="admin-label">Keisti naujienos pavadinimą:</label><br>
                <input class="admin-input" type="text" name="content" value="' . $metas['news_content'][0] .'">
            </div>
            <div class="admin-event-buttons">
                <button type="submit" class="admin-event-button">Redaguoti</button>
            </div>
        </div>
        <div>
            <div class="admin-event-buttons">
                <input type="hidden" name="event_delete" value="event_id">
                <input type="hidden" name="event_id" value="' . $post->ID . '">
                <button type="submit" class="admin-event-button">Trinti</button>
            </div>
        </div>
    </div>
</div>';
}
?>

<br>
<br>
<div class="admin-event-div">
    <input type="hidden" name="event_new" value="new event">
    <div class="admin-event-form-group">
        <label class="admin-label">Naujienos pavadinimas</label><br>
        <input type="text" id="content" value="" placeholder="Įrašykite naujienos teksta..." class="admin-input">
    </div>
    <div class="admin-event-buttons">
        <button type="submit" id="create" class="admin-event-button">Pridėti</button>
    </div>
<div>
<br>




<script language='javascript'>
    // news_create
    const editButton = document.querySelector('#create');
    // console.log(editButton);
    // console.log('JS');
    if (editButton) {
        editButton.addEventListener('click', () => { 
            console.log('clicked');
            axios.get('<?= $url ?>api?route=news_store&content='+ document.querySelector('#content').value
            // , {route: 'test'}
            )
            // get can also have params
            .then((response) => {  
                // console.log(response);
                //console.log(response.data);
                 console.log(response.data);
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