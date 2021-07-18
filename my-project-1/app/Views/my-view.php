<html>
    <head>
        <title>
            Codigniter
        </title>
    </head>
    <body>
        <h2><?= $title;?></h2>

        <?php if(count($subjects) > 0 ):?>
            
            <ul>
                <?php foreach($subjects as $subject):?>
                    <li><?= $subject;?></li>
                <?php endforeach;?>
            </ul> 
    
            <?php 
                else:
                    echo "<p>Sorry no data was found...</p>";
            endif;
            ?>
    </body>
    
</html>