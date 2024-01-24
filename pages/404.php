<?php
    ob_start(); ?>
        <div>
            error
        </div>
    <?php
    \Base\Layout::$content = ob_get_contents();
    ob_end_clean();