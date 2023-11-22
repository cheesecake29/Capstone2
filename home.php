<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/8714a42433.js" crossorigin="anonymous"></script>
</head>

<body class="Homepage">
    <div class="home-container">
        <h1><?php echo $_settings->info('homename') ?></h1>
        <p><?php echo $_settings->info('homedes')  ?> </p>
        <button class="shop-now"><a href="./?p=products">Shop now</a></button>
    </div>
</body>

</html>