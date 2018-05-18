<?php if(ENVIRONMENT == 'prod'): ?>
    <h1><b>Unexpected Error</b></h1>
    <p>An unexpected error has occurred. Please try again later.</p>
    <p><small>
            Error: <?=$name?>
        </small></p>
<?php else: ?>
    <h1><b><?=$name?></b></h1>
    <p>Uncaught <b><?=$name?></b> - Line <?=$line?> of <?=$file?></p>
    <p><?=$exception_message?></p>
    <h5>Stack Trace</h5>
    <pre><?=$stackTrace?></pre>
<?php endif; ?>