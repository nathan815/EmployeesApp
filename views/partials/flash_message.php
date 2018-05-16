<?php if($message = \App\Utils\FlashMessage::get()): ?>
<div class="alert alert-<?=$message['type']?>">
    <?=$message['text']?>
</div>
<?php endif; ?>