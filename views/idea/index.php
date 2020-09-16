


<?php
echo '';
?>


<div class="admin-event-div" id="add">
    <form class="admin-event-forms" method="POST" action="">
        <input type="hidden" name="event_update" value="update event">
        <input type="hidden" name="event_id" value="">
        <div class="admin-event-form-group">
            <label class="admin-label">Redaguoti tekstą:</label><br>
            <textarea name="text" placeholder="Jūsų tekstas..." class="admin-input"></textarea>
        </div>
        <div class="admin-event-buttons">
            <button type="submit" class="admin-event-button">Redaguoti</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="admin-event-buttons">
            <input type="hidden" name="event_delete" value="event_id">
            <input type="hidden" name="event_id" value="">
            <div class="admin-event-buttons">
            <button type="submit" class="admin-event-button">Trinti</button>
        </div>
        </div>
    </form>
</div>
<div class="admin-event-div">
    <form class="admin-event-forms" method="POST" action="">
        <input type="hidden" name="idea" value="new idea">
        <div class="admin-event-form-group">
            <label class="admin-label">Idejos sprendimas</label><br>
            <textarea name="text" placeholder="Jūsų tekstas..." class="admin-input"></textarea>
        </div>
        <div class="admin-event-buttons">
            <button type="submit" id="create" class="admin-event-button">Pridėti</button>
        </div>
    </form>
<div>