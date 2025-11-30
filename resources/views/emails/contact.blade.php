<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; background: #f7f7f7; padding: 20px; }
        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        h2 { margin-top: 0; }
        .label { color: #666; font-weight: bold; }
        .value { margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="box">
    <h2>📩 رسالة جديدة من موقعك Amara Food</h2>

    <p class="label">الاسم:</p>
    <p class="value">{{ $name }}</p>

    <p class="label">البريد الإلكتروني:</p>
    <p class="value">{{ $email }}</p>

    <p class="label">الموضوع:</p>
    <p class="value">{{ $subject }}</p>

    <p class="label">الرسالة:</p>
    <p class="value">{!! nl2br(e($messageContent)) !!}</p>
</div>

</body>
</html>
