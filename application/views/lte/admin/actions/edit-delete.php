<?php if ($this->auth->role_id == 1) { ?>

    <?php if ($edit) { ?>
        <a title="edit" class="action-edit btn btn-info btn-xs link-to pointer" data-to="<?= $edit ?>">
            <i class="fas fa-edit"></i>
        </a>
    <?php } ?>

    <?php if ($delete) { ?>
        <a title="delete" class="action-delete btn btn-danger btn-xs pointer" data-url="<?= $delete ?>" data-message="<?= $deleteMessage ?>">
            <i class="fas fa-trash"></i>
        </a>
    <?php } ?>

<?php } ?>