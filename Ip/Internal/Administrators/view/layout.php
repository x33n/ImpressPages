<div class="ipModuleAdministrators">
    <?php foreach ($administrators as $administrator){ ?>
        <div class="panel panel-default" data-administratorid="<?php echo esc($administrator['id']) ?>">
            <div class="panel-heading"><?php echo esc($administrator['name']) ?></div>
            <div class="panel-body">
                <b><?php //echo esc($administrator['name']) ?></b>
            </div>
        </div>
    <?php } ?>
</div>