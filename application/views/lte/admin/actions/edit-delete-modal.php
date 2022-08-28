<?php if ($this->auth->role_id == 1) { ?>

<?php if ($edit) { ?>
    <a title="edit" class="action-edit-modal badge badge-info pointer" onclick="editModal('<?= $edit ?>', 'Edit Subkriteria')">
        <i class="fas fa-edit"></i>
    </a>
<?php } ?>

<?php if ($delete) { ?>
    <a title="delete" class="action-delete badge badge-danger pointer" data-url="<?= $delete ?>" data-message="<?= $deleteMessage ?>">
        <i class="fas fa-trash"></i>
    </a>
<?php } ?>

<?php } ?>