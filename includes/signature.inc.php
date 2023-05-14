<?php
    $sql = "select * from author where lang ='$lang'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);

    $blogsite = WEBSITE."folder";
?>

<div class="sign-container">
    <div class="sign-block">
        <img class="img-rounded" src="../images/profile.png">
        <div class="sign-text">
            <div class="sign-text-name">
                <span class="ct-span"><a href="<?php echo $blogsite?>"><?php echo $row['name']?></a></span>
            </div>
            <div class="sign-text-bio">
                <span class="ct-span"><?php echo $row['bio']?></span>
            </div>
            <div class="sign-icons">
                <div class="Row">
                    <div class="Column">
                        <a target='_blank' href="<?php echo $row['instagram']?>"><img class="img-icon-rounded" src="../images/instagram.png"></a>&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
