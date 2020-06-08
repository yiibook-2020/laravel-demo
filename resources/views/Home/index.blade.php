<html>
    <head>
        <meta charset="utf-8"/>
        <title>首页</title>
    </head>
    <body>
        <h1><?php echo $message;?></h1>
        <div>
            <ul>
                <?php foreach($goods as $k => $v):?>
                <li><a href="/show?id=<?php echo $v->id;?>"><?php echo $v->title?></a>
                    <?php echo $v->price;?>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </body>
</html>