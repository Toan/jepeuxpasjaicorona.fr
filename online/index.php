<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <title>Générateur d'attestation COVID-19</title>

    <style>
        body { background-color: #fafafa; }
        #myCanvas {
            border:2px solid #444;
            border-radius: 15px;
            background-color: #fafafa;
        }
        .container { margin: 150px auto; }
    </style>

    <script>
        $(document).ready(function()
        {
            ;(function($){
            $.fn.datepicker.dates['fr'] = {
                days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
                daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
                daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
                months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
                monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
                today: "Aujourd'hui",
                monthsTitle: "Mois",
                clear: "Effacer",
                weekStart: 1,
                format: "dd/mm/yyyy"
            };
        }(jQuery));

            var date_input=$('input[name="birthday"]');
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
                language: 'fr'
            };
            date_input.datepicker(options);
        });
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-160964088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-160964088-1');
    </script>
</head>
<body>


<h1>Générateur d'attestation COVID-19</h1>
<form id="form"  method="post" action="gen.php">

    Civilité : <select name="gender" class="form-control">
        <option value="1">Mme.</option>
        <option value="2">M.</option>
    </select><br />
    Nom et Prénom : <input type="text" value="" name="name" id="name" class="form-control" required>
    <br />
    Date de naissance : <input type="text" value="" name="birthday" id="birthday" class="form-control">
    <br />
    Adresse : <input type="text" value="" name="address" id="address" class="form-control" required>
    <br />
    Nature : <select name="type" class="form-control">
        <option value="pro">Professionnel</option>
        <option value="miam">Achats de première nécessité</option>
        <option value="argh">Santé</option>
        <option value="famille">Familiale/garde d'enfants</option>
        <option value="footing!">Sport individuel/animaux de compagnie</option>
    </select><br />
    Date de l'attestation : <input type="text" value="<?php echo date("d/m/Y");?>" name="attdate" id="attdate" class="form-control">
    <br />
    Votre signature :

    <br />
    <div class="signature-pad--body">
        <canvas id="myCanvas"></canvas>
    </div><br><br>
    <input type="hidden" value="" id='signimg' name="signimg">
</form>
<input type="button" value="Effacer la signature" id="clearb" class="btn btn-danger">
<input type="button" value="Générer le PDF" onclick="download_img(this);" id='resetSign' class="btn btn-success">
<script>


    var canvas = document.querySelector("canvas");

    var signaturePad = new SignaturePad(canvas);


    download_img = function(el) {
        // get image URI from canvas object
        var canvas = document.getElementById("myCanvas");
        var imageURI = canvas.toDataURL("image/jpg");
        $('#signimg').val(imageURI);
        $( "#form" ).submit();
    };

    var clearButton = document.getElementById("clearb");
    clearButton.addEventListener("click", function (event) {
        signaturePad.clear();
    });
</script>
<br/>
<br/>
<br/>
Aucunes données ne sont enregistrées sur nos serveurs, la création du PDF est faites directement avec les données fournies (voir code source ^^), nous utilisons Google Analytics pour savoir quelle région en génèrent le plus (pour le moment c'est la régions parisienne ça va de soit)...<br /><br />
<a href="https://github.com/Toan/jepeuxpasjaicorona.fr" target="_blank">Code source sur github</a>
</body>
</html>
