<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instagram Auth Response</title>
</head>
<body>
    @if($was_successful)
        <p>Yes, we can now use your instagram feed</p>
    @else
        <p>Sorry, we failed to get permission to use your insagram feed.</p>
    @endif
</body>
</html>