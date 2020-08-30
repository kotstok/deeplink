<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
</head>

<body>
    <script type="text/javascript" lang="js">

    function unescapeHtml(input) {
        let d = document.createElement('div');
        d.innerHTML = input;
        let child = d.childNodes[0];
        return child ? child.nodeValue : null;
    }

    function validateProtocol(url) {
        let parser = document.createElement('a');
        parser.href = url;

        let protocol = parser.protocol.toLowerCase();
    
        if (['javascript:', 'vbscript:', 'data:', 'ftp:', ':', ' '].indexOf(protocol) < 0) {
            return url;
        }
    
        return null;
    }

    function validate(url) {
        let unescaped_value = unescapeHtml(url);
        
        if (unescaped_value && validateProtocol(unescaped_value)) {
            return unescaped_value;
        }

        return '/';
    }
    
    let s_URI = false;
    let intervalExecuted = false;

    window.onload = function() {
        //Mozilla and another
        document.getElementById("l").src = validate("myapp://path/data");
        //Chome
        window.top.location = validate("myapp://path/data");

        window.setTimeout(function() {
            if (!s_URI) {
                window.top.location = validate("https://play.google.com/");
            }
            intervalExecuted = true;
        }, 1500);
    };

    window.onblur = function() {
        s_URI = true;
    };

    window.onfocus = function() {
        if (s_URI || intervalExecuted) {
            window.top.location = validate("https://example.com");
        }
    }

    </script>
    <iframe id="l" width="1" height="1" style="visibility:hidden"></iframe>
</body>

</html>