<? defined('C5_EXECUTE') or die("Access Denied."); ?>  

<div id="ccm-block-code-snippet-content-value"><?=h($content)?></div>
<textarea style="display: none" id="ccm-block-code-snippet-content-textarea" name="content"></textarea>

<style type="text/css">
    #ccm-block-code-snippet-content-value {
        width: 100%;
        border: 1px solid #eee;
        height: 490px;
    }
</style>

<script type="text/javascript">
    $(function() {
        var editor = ace.edit("ccm-block-code-snippet-content-value");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/html");
        refreshTextarea(editor.getValue());
        editor.getSession().on('change', function() {
            refreshTextarea(editor.getValue());
        });
    });

    function refreshTextarea(contents) {
        $('#ccm-block-code-snippet-content-textarea').val(contents);
    }
</script>
