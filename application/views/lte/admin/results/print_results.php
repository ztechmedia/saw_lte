<?php

class PDF extends FPDF
{
    public function Header()
    {
       	//Logo
		// $this->Image(asset('images/hasna.jpeg'),10, 10, 30, 25);
		//Arial bold 15
		$this->SetFont('Times','B',15);
		//pindah ke posisi ke tengah untuk membuat judul
		$this->Cell(120);
		//judul
        $this->Cell(50,10,'SISTEM PAKAR',0,0,'C');
        $this->Ln(5);
		$this->SetFont('Times','B',14);
		$this->Cell(120);
        $this->Cell(50,10,'PENILAIAN CABANG TERBAIK PT. NINJA EXPRESS',0,0,'C');
        $this->Ln(5);
		$this->SetFont('Times','',12);
		$this->Cell(120);
        $this->Cell(50,10,'',0,0,'C');
        $this->Ln(5);
		$this->SetFont('Times','',12);
		$this->Cell(120);
        $this->Cell(50,10,'',0,0,'C');
		//pindah baris
		$this->Ln(15);
		//buat garis horisontal
		$this->Line(10,37,290,37);
		$this->Line(10,38,290,38);
    }

    //Page Content
    public function Content($criterias, $alts, $firsProcAlt)
    {

        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Data Alternatif', 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Nama', 1, 0, 'L');
        foreach ($criterias as $key => $crit) {
            $this->Cell(35, 5, $crit['crit_name'], 1, 0, 'L');
        }
        $this->Ln();
        foreach ($alts as $key => $value) {
            foreach ($value as $key => $cValue) {
                $this->Cell(35, 5, $key === 'name' ? $cValue : $cValue['sub_name'], 1, 0, 'L');
            }
            $this->Ln();
        }

        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Alternatif Sub Kriteria Value', 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Nama', 1, 0, 'L');
        foreach ($criterias as $key => $crit) {
            $this->Cell(35, 5, $crit['crit_name'], 1, 0, 'L');
        }
        $this->Ln();
        foreach ($alts as $key => $value) {
            foreach ($value as $key => $cValue) {
                $this->Cell(35, 5, $key === 'name' ? $cValue : $cValue['sub_value'], 1, 0, 'L');
            }
            $this->Ln();
        }


        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Process #1', 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Nama', 1, 0, 'L');
        foreach ($criterias as $key => $crit) {
            $this->Cell(35, 5, $crit['crit_name'], 1, 0, 'L');
        }
        $this->Ln();
        foreach ($firsProcAlt as $key => $value) {
            foreach ($value as $key => $fValue) {
                $this->Cell(35, 5, $key === 'name' ? $fValue : number_format($fValue['normal_value'], 2, ',', '.'), 1, 0, 'L');
            }
            $this->Ln();
        }

        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Process #2', 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Nama', 1, 0, 'L');
        foreach ($criterias as $key => $crit) {
            $this->Cell(35, 5, $crit['crit_name'], 1, 0, 'L');
        }
        $this->Ln();
        $results = [];
        foreach ($firsProcAlt as $key1 => $value) {
            $results[$key1]['value'] = 0;
            foreach ($value as $key => $fValue) {
                if($key === 'name') {
                    $results[$key1]['name'] = $fValue;
                } else {
                    $results[$key1]['value'] += $fValue['processed_value'];
                }
                $this->Cell(35, 5, $key === 'name' ? $fValue : number_format($fValue['processed_value'], 2, ',', '.'), 1, 0, 'L');
            }
            $this->Ln();
        }

        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Hasil Akhir', 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', '', 8);
        $this->Cell(35, 5, 'Nama', 1, 0, 'L');
        $this->Cell(35, 5, 'Nilai', 1, 0, 'L');
        $this->Ln();
        $keys = array_column($results, 'value');
        array_multisort($keys, SORT_DESC, $results);
        foreach ($results as $key => $value) {
            $this->Cell(35, 5, $value['name'], 1, 0, 'L');
            $this->Cell(35, 5, number_format($value['value'], 2, ',', '.'), 1, 0, 'L');
            $this->Ln();
        }
    }

    //Page footer
    public function Footer()
    {
        //atur posisi 1.5 cm dari bawah
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10, $this->GetY(), 290, $this->GetY());
        //Arial italic 9
        $this->SetFont('Times', 'I', 9);
        //nomor halaman
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'R');
    }
}

$pdf = new PDF('L');
$pdf->SetTitle("Penilaian Karyawan");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content($criterias, $alts, $firsProcAlt);
$pdf->Output();