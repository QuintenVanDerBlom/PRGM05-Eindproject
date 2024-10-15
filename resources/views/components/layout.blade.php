@props(['title'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="/resources/css/main.css"> <!-- Link to your CSS file -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<main>
    {{ $slot }}
</main>

