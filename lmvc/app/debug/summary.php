<!-- <!-- Lollipop Debug -->
<script src="<?= $js->jquery ?>"></script>
<script type="text/javascript">
    /* global $ */
    $(function() {
        $(".ldebug-error-toggle").click(function() {
            $("#ldebug-errors").toggle();
            
            if ($("#ldebug-errors").is(':visible')) {
                $("#lollipop-debug-controller-min").show();
            } else {
                $("#lollipop-debug-controller-min").hide();
            }
        });
        $(".ldebug-warning-toggle").click(function() {
            $("#ldebug-warning").toggle();

            if ($("#ldebug-warning").is(':visible')) {
                $("#lollipop-debug-controller-min").show();
            } else {
                $("#lollipop-debug-controller-min").hide();
            }
        });
        $(".ldebug-notice-toggle").click(function() {
            $('#ldebug-notice').toggle();

            if ($("#ldebug-notice").is(':visible')) {
                $("#lollipop-debug-controller-min").show();
            } else {
                $("#lollipop-debug-controller-min").hide();
            }
        });
        $(".ldebug-info-toggle").click(function() {
            $('#ldebug-info').toggle();

            if ($("#ldebug-info").is(':visible')) {
                $("#lollipop-debug-controller-min").show();
            } else {
                $("#lollipop-debug-controller-min").hide();
            }
        });
        $(".ldebug-files-toggle").click(function() {
            $('#ldebug-files').toggle();

            if ($("#ldebug-files").is(':visible')) {
                $("#lollipop-debug-controller-min").show();
            } else {
                $("#lollipop-debug-controller-min").hide();
            }
        });
        $("#lollipop-debug-controller-min").click(function() {
            $("#ldebug-errors").hide();
            $("#ldebug-warning").hide();
            $('#ldebug-notice').hide();
            $('#ldebug-info').hide();
            $('#ldebug-files').hide();
            $(this).hide();
        });
    });
</script>
<div id="draggable" class="lollipop-debug">
    <table>
        <tr>
            <td>
                <a id="lollipop-debug-controller-min" style="display: none;" href="javascript: void(0);">[minimize]</a>
            </td>
            <td>
                <b><?= $app->name ?></b> [<?= $app->version ?>]<br>by <?= $app->author ?>
            </td>
        </tr>
        <tr>
            <td><label class="lollipop-label">Response Time:</label></td>
            <td><label class="lollipop-green"><?= $debug->response->time ?>s</label></td>
        </tr>
        <tr>
            <td><label class="lollipop-label">Memory Used:</label></td>
            <td><label class="lollipop-green"><?= $debug->response->memory_used ?></label></td>
        </tr>
        <tr>
            <td><label class="lollipop-label">Files:</label></td>
            <td><a class="ldebug-files-toggle" href="javascript: void(0);"><?= count(get_included_files()) ?> Total File(s)</a></td>
        </tr>
        <tr id="ldebug-files" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', get_included_files()) ?></div></td>
        </tr>
        <?php if (count(\Lollipop\Log::get('error'))) { ?>
        <!-- Errors -->
        <tr class="error">
            <td><label class="lollipop-label">Error(s):</label></td>
            <td><a class="ldebug-error-toggle" href="javascript: void(0);"><?= count(\Lollipop\Log::get('error')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-errors" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('error')) ?></div></td>
        </tr>
        <?php } ?>
        <?php if (count(\Lollipop\Log::get('warn'))) { ?>
        <!-- Warning -->
        <tr class="warning">
            <td><label class="lollipop-label">Warning(s):</label></td>
            <td><a class="ldebug-warning-toggle" href="javascript: void(0);"><?= count(\Lollipop\Log::get('warn')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-warning" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('warn')) ?></div></td>
        </tr>
        <?php } ?>
        <?php if (count(\Lollipop\Log::get('notice'))) { ?>
        <!-- Notice -->
        <tr class="notice">
            <td><label class="lollipop-label">Notice(s):</label></td>
            <td><a class="ldebug-notice-toggle" href="javascript: void(0);"><?= count(\Lollipop\Log::get('notice')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-notice" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('notice')) ?></div></td>
        </tr>
        <?php } ?>
        <?php if (count(\Lollipop\Log::get('info'))) { ?>
        <!-- Infos -->
        <tr class="info">
            <td><label class="lollipop-label">Info Message(s):</label></td>
            <td><a class="ldebug-info-toggle" href="javascript: void(0);"><?= count(\Lollipop\Log::get('info')) ?> Total</a></td>
        </tr>
        <tr id="ldebug-info" style="display: none;">
            <td></td>
            <td><div class="container"><?= implode('<br>', \Lollipop\Log::get('info')) ?></div></td>
        </tr>
        <?php } ?>
    </table>
</div>
<style type="text/css">
    .lollipop-debug {
        border: 2px blue solid;
        padding: 6px;
        background-color: #dedede;
        max-width: 97%;
        bottom: 0%;
        right: 0%;
        z-index: 2147483647;
        position: fixed;
    }
    
    .lollipop-debug .container {
        width: 100%;
        max-height: 100px;
        overflow: auto;
    }
    
    .lollipop-debug > table {
        border-collapse: collapse;
        max-width: 100%;
    }
    
    .lollipop-green {
        color: green;
    }
    
    .lollipop-label {
        color: #4d4d4d;
    }
    
    #ldebug-errors {
        color: red;
    }
    
    #ldebug-warning {
        color: #b97a07;
    }
    
    #ldebug-notice {
        color: #77770a;
    }
    
    #ldebug-info {
        color: #0d568a;
    }
</style>
<!-- End of Lollipop Debug -->
