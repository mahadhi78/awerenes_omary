<!DOCTYPE html>
<html>

<head>
    <title>{{ $subject }}</title>
</head>

<body>
    {!! $body !!}

    <a class='text text-primary' href="{{ route('count_phishing', ['template_name' => $subject, 'template_id' => $template_id, 'info_id' => $info_id]) }}">Click here</a>

</body>

</html>
