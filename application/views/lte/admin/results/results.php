<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Hasil Akhir</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class='col-12'>
					<div class='card'>
						<div class='card-header'>
							<div class='card-title'><i class='fas fa-check-circle'></i> Hasil Akhir</div>
						</div>
						<div class='card-body'>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Daftar Alternatif</h4>
                                    <table class="table table-condensed" id="admin">
                                        <thead>
                                            <th width="8%">No</th>
                                            <th>Nama</th>
                                            <?php foreach ($criterias as $key => $crit) { ?>
                                                <th><?= $crit['crit_name'] ?></th>
                                            <?php } ?>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1; foreach ($alts as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                <?php  foreach ($value as $key => $cValue) { ?>
                                                    <td><?= $key === 'name' ? $cValue : $cValue['sub_name'] ?></td>
                                                <?php } ?>
                                                </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4>Alternatif Subkriteria Value</h4>
                                    <table class="table table-condensed" id="admin">
                                        <thead>
                                            <th width="8%">No</th>
                                            <th>Nama</th>
                                            <?php foreach ($criterias as $key => $crit) { ?>
                                                <th><?= $crit['crit_name'] ?></th>
                                            <?php } ?>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1; foreach ($alts as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                <?php  foreach ($value as $key => $cValue) { ?>
                                                    <td><?= $key === 'name' ? $cValue : $cValue['sub_value'] ?></td>
                                                <?php } ?>
                                                </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4>Proses #1</h4>
                                    <table class="table table-condensed" id="admin">
                                        <thead>
                                            <th width="8%">No</th>
                                            <th>Nama</th>
                                            <?php foreach ($criterias as $key => $crit) { ?>
                                                <th><?= $crit['crit_name'] ?></th>
                                            <?php } ?>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1; foreach ($firsProcAlt as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                <?php  foreach ($value as $key => $fValue) { ?>
                                                    <td><?= $key === 'name' ? $fValue : number_format($fValue['normal_value'], 2, ',', '.') ?></td>
                                                <?php } ?>
                                                </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <?php $results = [];  ?>
                                    <h4>Proses #2</h4>
                                    <table class="table table-condensed" id="admin">
                                        <thead>
                                            <th width="8%">No</th>
                                            <th>Nama</th>
                                            <?php foreach ($criterias as $key => $crit) { ?>
                                                <th><?= $crit['crit_name'] ?></th>
                                            <?php } ?>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1; foreach ($firsProcAlt as $key1 => $value) { ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                <?php 
                                                    $results[$key1]['value'] = 0;
                                                    foreach ($value as $key => $fValue) {
                                                    if($key === 'name') {
                                                        $results[$key1]['name'] = $fValue;
                                                    } else {
                                                        $results[$key1]['value'] += $fValue['processed_value'];
                                                    }
                                                ?>
                                                    <td><?= $key === 'name' ? $fValue : number_format($fValue['processed_value'], 2, ',', '.')  ?></td>
                                                <?php } ?>
                                                </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h4>Hasil Akhir</h4>
                                    <table class="table table-condensed" id="admin">
                                        <thead>
                                            <th width="8%">No</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Grade</th>
                                        </thead>

                                        <tbody>
                                            <?php 
                                            $keys = array_column($results, 'value');
                                            array_multisort($keys, SORT_DESC, $results);
                                            $no = 1; 
                                            $grade = [
                                                'A' => [],
                                                'B' => [],
                                                'C' => [],
                                                'D' => [],
                                            ];
                                            foreach ($results as $key => $value) { 
                                                $grd = checkGrade($value['value']);
                                                $grade[$grd][] = $value['name'];
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value['name'] ?></td>
                                                <td><?= number_format($value['value'], 2, ',', '.') ?></td>
                                                <td><?= $grd ?></td>
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                    <h4>Grading</h4>
                                    <table class="table table-condensed" id="admin">
                                        <thead>
                                            <th>Grade</th>
                                            <th>Alternatif</th>
                                        </thead>

                                        <tbody>
                                            <?php                              
                                            foreach ($grade as $key => $value) { ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td><?= implode(", ", $value) ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <a href='<?= base_url() ?>admin/print_results' target='_blank'  class="btn btn-default btn-sm">
                                        PRINT
                                    </a>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>