<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="js/css/jquery-ui-1.10.2.min.css" />
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/util.js"></script>
        <style>
            body { font-size: 62.5%; }
            label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:20px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#container { width: 350px; margin: 20px 0; }
            div#container table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#container table td, div#container table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }
        </style>
    </head>
    <body>
        <div id="container" class="ui-widget">
            <?php include 'persona.php'; ?>
        </div>

        <div id="person-form">
            <p class="validateTips"></p>
            <form id="new">
                <fieldset>
                    <label for="first-name">First Name</label>
                    <input type="text" name="first-name" id="first-name" />
                    <label for="last-name">Last Name</label>
                    <input type="text" name="last-name" id="last-name" />
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" />
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" />
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" />
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="" />
                </fieldset>
            </form>
        </div>
    </body>
</html>