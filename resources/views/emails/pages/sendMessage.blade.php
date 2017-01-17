<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<p>{{ trans('common.user.first_name') }}: {{ $name }}</p>
<p>{{ trans('common.user.email') }}: {{ $email }}</p>
<p>{{ trans('common.user.telephone') }}: {{ $telephone }}</p>
<p>Žinutės tema: {{ $subject }}</p>
<p>Žinutė: {{ $content }}</p>
</body>
</html>