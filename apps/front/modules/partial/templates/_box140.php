<div style="background:#333;padding:10px;">
    <?php foreach($rss as $rs):?>
        <div style="width:140px;height:250px;margin:0 10px 0 0;" class="left">
            <?php echo image_tag('/u/m/t140-'.$rs['image'], array('style'=>'box-shadow:0 0 4px #666;'))?>
            <br clear="all">
            <a href="<?php echo url_for('page/show?route='.$rs['route'])?>" style="color:#fff;">
                <?php echo $rs['title']?>
                <span class="right" style="color:#4D9804;"><?php echo $rs['year']?></span>
            </a>
        </div>
    <?php endforeach;?>
    <br clear="all">
</div>