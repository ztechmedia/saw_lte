<?php if ($edit) { ?>
    <span title="edit" class="action-edit badge badge-info link-to pointer" data-to="<?= $edit ?>">
        <i class="fas fa-eye"></i>
    </span>
<?php } ?>


<?php if ($delete) { ?>
    <span title="delete" class="action-delete badge badge-danger pointer" data-url="<?= $delete ?>" data-message="<?= $deleteMessage ?>">
        <i class="fas fa-trash"></i>
    </span>
<?php } ?>