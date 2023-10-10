<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMS GATEWAY - Absence</title>
</head>
<body>
    @foreach ($absence as $item)
        <h2>Bonjour Mr/Mme {{ $item['parent'] }}</h2>
        <ul>
            <li>
                <strong>Message</strong> :
                Votre enfant en classe de <strong>{{ $item['classe'] }}</strong> au matricule <strong>{{ $item['matricule'] }}</strong> est absent au cour de <strong>{{ $item['matiere'] }}</strong>
                le <strong>{{ $item['date'] }}</strong>. <br>
                Merci de le rappeler à l'ordre ou de nous communiqués toutes informations relatives a son absence. <br>
                Cordialement. <br>
                <strong>La direction</strong>
            </li>
        </ul>
    @endforeach
    <p>
        Ce mail concerne les Absences de notre établissement. <br>
        Merci d'y prendre part
    </p>
</body>
</html>
