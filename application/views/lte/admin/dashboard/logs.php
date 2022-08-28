<div class="row">
	<div class="col-md-12" style="margin-bottom: 10px">
		<ul class="pagination pagination-month justify-content-center">
            <?php if(array_key_exists("next", $pagination)) {  ?>
                <li class="page-item" onclick="changePage('<?=$pagination['prev']['page']?>')"><a class="page-link">«</a></li>
            <?php } else{ ?>
                <li class="page-item disabled"><a class="page-link">«</a></li>
            <?php } ?>

			<li class="page-item">
				<a class="page-link">
					<p class="page-month" style="color: black"><?= "Halaman $page - $totalPage | Data $start - $end"?></p>
				</a>
			</li>

            <?php if(array_key_exists("next", $pagination)) {  ?>
                <li class="page-item" onclick="changePage('<?=$pagination['next']['page']?>')"><a class="page-link">»</a></li>
            <?php } else{ ?>
                <li class="page-item disabled"><a class="page-link">»</a></li>
            <?php } ?>
		</ul>
	</div>

	<div class="col-md-12 table-responsive">
		<table class="table table-condensed">
			<thead>
				<th>Email</th>
				<th>Tanggal Login</th>
				<th>IP</th>
				<th>OS</th>
				<th>Browser</th>
			</thead>

			<tbody style="background: white">
				<?php foreach ($items as $item) { ?>
				<tr>
					<td><?= $item->email ?></td>
					<td><?= toIndoDateTime($item->login_date) ?></td>
					<td><?= $item->ip ?></td>
					<td><?= $item->os ?></td>
					<td><?= $item->browser." ".$item->browser_version ?></td>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
