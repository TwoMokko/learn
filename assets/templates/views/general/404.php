<?php
    ob_start(); ?>
        <div>
            error
        </div>
    <?php
    \Section::$content = ob_get_contents();
    ob_end_clean();