<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>WeChat Manager</title>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <style>
        body {
            background-color: #4c799e;
            margin: 0px;
            padding: 0px;
            color: #fff;
            font-family: "微软雅黑";
            font-size: 12px;
        }

        .window {
            float: left;
            border: 1px #c5b6b6 solid;
            border-radius: 2px;
            background-color: #0c0c0c;
            position: absolute;
            top: 20%;
            left: 20%;
            padding: 50px;
        }

        ul {
            margin: 0px;
            padding: 0px;
            list-style: none;
        }

        input {
            background-color: #0c0c0c;
            border: 0;
            color: #f50404;
            outline: none;
        }
    </style>
</head>
<body>
    <div class="window">
        <ul>
        </ul>
    </div>
<script type="text/javascript">
    function predata() {
        $.ajax({
            type: "POST",
            url: "/terrylucas/pre/",
            data: '',
            success: function (rsp) {
                $(rsp).each(function (index , msg) {
                    $("ul").append("<li>" + msg + "</li>");
                });
            }
        });
    }
    $('.window').click(function () {
        predata();
    });
    predata();
</script>
</body>
</html>