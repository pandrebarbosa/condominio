<?php
session_name("Condominio");
session_start();

require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/fpdf/fpdf.php');
require_once (realpath ( dirname ( dirname ( __FILE__ ) ) ) . '/lib/toolBox.class.php');


class ListaCorreiosDiarioRelatorio extends FPDF{
	
	private $widths;
	private $aligns;
	private $dataRelatorio;

	function Header(){
	    // Logo
	    $this->Image('../../img/logo.png',10,6,30);
	    // Courier bold 15
	    $this->SetFont('Courier','B',15);
	    // Move to the right
	    $this->Cell(80);
	    // Title
	    $this->Cell(30,5,utf8_decode('Condomínio San Raphael'),0,1,'C');
	    $this->SetFont('Courier','',10);
	    $this->Cell(190,5,utf8_decode('Entrada de Correspondências'),0,0,'C');
	    $this->SetFont('Courier','',40);
	    $this->Cell(100,5, toolBox::formataData($this->dataRelatorio,"M"),0,0,'L');
	    // Line break
	    $this->Ln(15);	    
	}
	
	
	function Footer(){
	    // Position at 1.6 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Courier','I',8);
	    // Page number
	    $this->Cell(100,5,utf8_decode(toolBox::retornaData()),0,0,'L');
	    $this->Cell(188,5,utf8_decode('Página ').$this->PageNo().' de {nb}',0,1,'R');
	    $this->Cell(100,2,utf8_decode('Impresso por: '.$_SESSION['credencial']['Nome'] . ' (' . $_SESSION['credencial']['no_tipo_usuario'].')'),0,0,'L');
	}
	
	function montarTabela($header, $data){
		// Colors, line width and bold font
		$this->SetFont('','B',10);
		//Header
		$this->SetWidths(array(35, 90, 70, 30, 55));
		for($i=0;$i<count($header);$i++)
			$this->Cell($this->widths[$i],7,utf8_decode($header[$i]),0,0,'C',false);
			$this->Ln();
			// Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			// Data
			foreach($data as $row)
			{
				$this->SetFont('','',8);
				
				$campoItem = $row['co_item_correio'] . ' - ' . trim($row['item']);
				if(strlen($campoItem) < 34){
					$campoItem = str_pad($campoItem,50," ");
				}else{
					$campoItem = str_pad($campoItem,(strlen($campoItem)+55-strlen($campoItem))," ");
				}
				$campoItem .= str_pad('OBS:',50," ");
				$campoItem .= utf8_decode(trim($row['ds_observacao']));
				$valores = array(utf8_decode(strtoupper($row['unidade'])),
						strtoupper($campoItem),
						utf8_decode(strtoupper(toolBox::retornaNomeSobrenome($row['recebedor']) . ' - ' . $row['no_cargo_funcionario'] . ' as ' . $row['hr_chegada'] )),
						NULL, NULL
				);
				$this->Row($valores);

			}
	}
	
	
	function SetWidths($w) {
		$this->widths=$w;
	}
	
	function SetAligns($a) {
		$this->aligns=$a;
	}
	
	function Row($data) {
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i< count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=4.1*$nb;
			//Issue a page break first if needed
			$this->CheckPageBreak($h);
			//Draw the cells of the row
			for($i=0;$i< count($data);$i++)
			{
				$w=$this->widths[$i];
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
				//Save the current position
				$x=$this->GetX();
				$y=$this->GetY();
				//Draw the border
				$this->Rect($x,$y,$w,$h);
				//Print the text
				$this->MultiCell($w,4,$data[$i],0,$a);
				//Put the position to the right of the cell
				$this->SetXY($x+$w,$y);
			}
			//Go to the next line
			$this->Ln($h);
	}
	
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
				$sep=-1;
				$i=0;
				$j=0;
				$l=0;
				$nl=1;
				while($i<$nb)
				{
					$c=$s[$i];
					if($c=="\n")
					{
						$i++;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
						continue;
					}
					if($c==' ')
						$sep=$i;
						$l+=$cw[$c];
						if($l>$wmax)
						{
							if($sep==-1)
							{
								if($i==$j)
									$i++;
							}
							else
								$i=$sep+1;
								$sep=-1;
								$j=$i;
								$l=0;
								$nl++;
						}
						else
							$i++;
				}
				return $nl;
	}
	public function setDataRelatorio($dataRelatorio) {
		$this->dataRelatorio = $dataRelatorio;
		return $this;
	}
		
	
	
}