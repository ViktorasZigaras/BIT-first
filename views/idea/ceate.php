<?php
echo '<div class="lenteles">
<form class="forma" method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="news_new" value="new news">
    <div class="form-group">
        <label class="admin-label">Data</label><br>
        <input type="text" name="date" value="date" class="admin-input">
    </div>
    <div class="form-group">
        <label class="admin-label">Įrašas</label><br>
        <input type="text" name="content" value="content" class="admin-input">
    </div>
    <div class="mygtukai">
        <button type="submit" class="admin-button">Pridėti</button>
</form>
</div>';

