<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMS GATEWAY - Annonce</title>
</head>
<body>
    <p>Ce mail concerne les annonces- de notre établissement. <br>
        Merci d'y prendre pars
    </p>
    @foreach ($annonce as $item)

        <h2>Bonjour Mr/Mme</h2>
        <ul>
            <li>
                <strong>Message</strong> :
                {{ $item }}
            </li>
        </ul>

    @endforeach

</body>
</html>
