<?php


foreach ($news as $key => $post) {

    $metas = get_post_meta($post->ID);

    echo '<div class="admin-event-div">
    <form class="admin-event-forms" method="POST" action="">
        <input type="hidden" name="event_update" value="update event">
        <input type="hidden" name="event_id" value="' . $post->ID  . '">
        <div class="admin-event-form-group">
            <label class="admin-label">Keisti įvykio pavadinimą:</label><br>
            <input class="admin-input" type="text" name="title" value="' . $metas['title'][0] .'">
        </div>
        <div class="admin-event-form-group">
            <label class="admin-label">Redaguoti tekstą:</label><br>
            <input name="text" type="text" class="admin-input" value="' . $metas['text'][0] . '">
        </div>
        <div class="admin-event-form-group">
            <label class="admin-label">Data:</label><br>
            <input class="admin-input" type="datetime-local" value="' . $metas['date'][0] . '" name="date">
        </div>
        <div class="admin-event-buttons">
            <button type="submit" class="admin-event-button">Redaguoti</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="admin-event-buttons">
            <input type="hidden" name="event_delete" value="event_id">
            <input type="hidden" name="event_id" value="' . $post->ID . '">
            <button type="submit" class="admin-event-button">Trinti</button>
        </div>
    </form>
    <!--<div>
        <select name="cars">
        <option value="' . $metas['title'][0] . '">' . $metas['title'][0] . '</option>
        </select>
    </div>-->
</div>';
}
?>

    <br>
   <br>
    <div class="admin-event-div">
        <!-- <form class="admin-event-forms" method="POST" action=""> -->
            <input type="hidden" name="event_new" value="new event">
            <div class="admin-event-form-group">
                <label class="admin-label">Įvykio pavadinimas</label><br>
                <input type="text" name="title" value="" placeholder="Įrašykite įvykio pavadinimą..." class="admin-input">
            </div>
            <div class="admin-event-form-group">
                <label class="admin-label">Tekstas</label><br>
                <textarea name="text" placeholder="Jūsų tekstas..." class="admin-input"></textarea>
            </div>
            <div class="admin-event-form-group">
                <label class="admin-label">Data</label><br>
                <input type="datetime-local" name="date" class="admin-input">
            </div>
            <div class="admin-event-buttons">
                <button type="submit" id="create" class="admin-event-button">Pridėti</button>
            </div>
        <!-- </form> -->
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
            axios.get('<?= $url ?>api?route=news_create'
            // , {route: 'test'}
            )
            // get can also have params
            .then((response) => {  
                console.log(response);
                console.log(response.data);
                console.log(response.data.a);
                // displayMessages(response.data);
                // drawIndexInit();
            })
            .catch((error) => {
                console.log(error);
                // displayErrorMessages(error.response.data.errors);
            });
        });
    }
</script> 