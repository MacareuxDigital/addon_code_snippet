<?php defined('C5_EXECUTE') or die("Access Denied."); ?>  

<div class="row form-inline">
    <div class="col-md-6 form-group">
        <?php echo $form->label('theme', t('Theme')); ?>
        <?php echo $form->select('theme', $themes, $theme, array('class' => 'input-sm')); ?>
    </div>
    <div class="col-md-6 form-group">
        <?php echo $form->label('language', t('Language')); ?>
        <?php echo $form->text('language', $language, array('class' => 'input-sm input-language')); ?>
    </div>
</div>
<div id="ccm-block-code-snippet-content-value"><?php echo h($content)?></div>
<textarea style="display: none" id="ccm-block-code-snippet-content-textarea" name="content"></textarea>

<style type="text/css">
    #ccm-block-code-snippet-content-value {
        width: 100%;
        border: 1px solid #eee;
        height: 490px;
        margin-top: 20px;
    }
    .tt-suggestion {
        margin: 5px 10px;
    }
</style>

<script type="text/javascript">
    var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });

        cb(matches);
      };
    };

    var languages = ['accesslog', 'armasm', 'avrasm', 'actionscript', 
        'apacheconf', 'applescript', 'asciidoc', 'aspectj', 'autohotkey',
        'autoit', 'axapta', 'bash', 'basic', 'brainfuck', 'bind',
        'csharp', 'c++', 'cal', 'cos', 'cmake', 'css', 'capnproto',
        'clojure', 'coffeescript', 'crmsh', 'crystal', 'd', 'dos',
        'dart', 'delphi', 'diff', 'django', 'dockerfile', 'dust',
        'elixir', 'elm', 'erlang', 'fsharp', 'fix', 'fortran', 'gcode',
        'gams', 'gherkin', 'go', 'golo', 'gradle', 'groovy', 'xml',
        'html', 'xhtml', 'rss', 'http', 'haml', 'handlebars',
        'haskell', 'haxe', 'ini', 'inform7', 'irpf90', 'json', 'java',
        'jsp', 'javascript', 'js', 'lasso', 'less', 'lisp',
        'livecodeserver', 'livescript', 'lua', 'makefile', 'markdown',
        'md', 'mathematica', 'matlab', 'mel', 'mercury', 'mizar',
        'mojolicious', 'monkey', 'nsis', 'nginxconf', 'nimrod', 'nix',
        'ocaml', 'objectivec', 'glsl', 'openscad', 'ruleslanguage',
        'oxygene', 'pf', 'php', 'parser3', 'perl', 'pl', 'powershell',
        'ps', 'processing', 'prolog', 'protobuf', 'puppet', 'python',
        'profile', 'k', 'r', 'rib', 'rsl', 'graph', 'ruby', 'rb',
        'rust', 'scss', 'sql', 'p21', 'scala', 'scheme', 'scilab',
        'smali', 'smalltalk', 'stan', 'stana', 'stylus', 'swift',
        'tcl', 'tex', 'thrift', 'tp', 'twig', 'typescript', 'vbnet',
        'vbscript', 'vhdl', 'vala', 'verilog', 'vim', 'x86asm', 'xl',
        'xpath', 'zephir'
    ];
    
    $(function() {
        var editor = ace.edit("ccm-block-code-snippet-content-value");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/text");
        refreshTextarea(editor.getValue());
        editor.getSession().on('change', function() {
            refreshTextarea(editor.getValue());
        });
        
        $('.input-language').typeahead({
            hint: true,
            minLength: 1,
            highlight: true,
            classNames: {
                menu: 'dropdown-menu',
                cursor: 'text-primary'
            }
        },
        {
            name: 'languages',
            source: substringMatcher(languages)
        });
    });

    function refreshTextarea(contents) {
        $('#ccm-block-code-snippet-content-textarea').val(contents);
    }
</script>
