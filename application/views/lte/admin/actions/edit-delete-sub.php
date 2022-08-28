<?php if ($this->auth->role_id == 1) { ?>

<?php if ($edit) { ?>
    <a title="edit" class="action-edit badge badge-info link-to pointer" data-to="<?= $edit ?>">
        <i class="fas fa-edit"></i>
    </a>
<?php } ?>

<?php if ($delete) { ?>
    <a title="delete" class="action-delete badge badge-danger pointer" data-url="<?= $delete ?>" data-message="<?= $deleteMessage ?>">
        <i class="fas fa-trash"></i>
    </a>
<?php } ?>


<?php if ($id) { ?>
    <a title="subcriteria" class="action-edit badge badge-warning link-to pointer" data-to="<?= base_url("admin/subcriterias/$id") ?>">
        <i class="fas fa-list"></i>
    </a>
<?php } ?>

<?php } ?>