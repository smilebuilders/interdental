<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use App\Patient;
use App\Claim;
use Auth;

class indexController extends Controller
{
//s
    public function index() {

      $patients = Auth::user()->patients()->orderBy('created_at', 'DESC')->take(10)->get();
      return view('index', compact('patients'));
    
    }

    public function search(Request $request)
    {

      $param = $request->param;
      $patients = Auth::user()->patients()
        ->where('first_name', $param)
        ->orWhere('last_name', $param)->get();

      return view('index', compact('patients'));

    }

    public function report()
    {
      $claims = Claim::all();
      return view('report', compact('claims'));
    }

    public function pdf(Request $request) {

      $claim = Claim::find($request->claim_id);
      // dd($claim->patient->relation);

      $pdf = new Fpdi();
      $pdf->AddPage();
      // set the source file
      $pdf->setSourceFile("claim_form.pdf");
      // import page 1
      $tplId = $pdf->importPage(1);
      // use the imported page and place it at point 0,10 with a width of 210 mm
      $pdf->useTemplate($tplId, 0, 10, 210);
      
      // 1.
      $pdf->SetFont('Arial','b',10);
      $pdf->SetXY(8, 29);
      $pdf->Write(0, "x");
      // 3.
      if($claim->patient->insurance->address != null) {
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(5, 55);
        $pdf->Multicell(100, 3, $claim->patient->insurance->name . "\n" . $claim->patient->insurance->address, 0, 'C');
      }
      
      // 12 - 17 si es dependiente.
      if($claim->patient->is_dependent) {
        // 12.
        $policyholder = Patient::find($claim->patient->patient_id);
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(105, 45);
        $pdf->Multicell(100, 3, 
          $policyholder->last_name . ', ' . 
          $policyholder->first_name . "\n" . 
          $policyholder->address . "\n" . 
          $policyholder->city . ', ' .
          $policyholder->state . ' ' . $policyholder->zip_code, 0, 'C');
        // 13.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(107, 64);
        $pdf->Multicell(30, 3, $policyholder->birth_date, 0, 'C');
        // 14.
        $pdf->SetFont('Arial','b',10);
        $policyholder->gender == 'Hombre'? $pdf->SetXY(144, 66) : $pdf->SetXY(151, 66);
        $pdf->Write(0, "x");
        // 15.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(162, 64);
        $pdf->Cell(40, 3, $policyholder->policy_code, 0, 'C');
        // 17.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(140, 72);
        $pdf->Cell(40, 3, $policyholder->company, 0, 'C');
      } 
      // 12 - 17 si no es dependiente
      else {
        // 12.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(105, 45);
        $pdf->Multicell(100, 3, 
          $claim->patient->last_name . ', ' . 
          $claim->patient->first_name . "\n" . 
          $claim->patient->address . "\n" . 
          $claim->patient->city . ', ' .
          $claim->patient->state . ' ' . $claim->patient->zip_code, 0, 'C');
        // 13.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(107, 64);
        $pdf->Multicell(30, 3, $claim->patient->birth_date, 0, 'C');
        // 14.
        $pdf->SetFont('Arial','b',10);
        $claim->patient->gender == 'Hombre'? $pdf->SetXY(144, 66) : $pdf->SetXY(151, 66);
        $pdf->Write(0, "x");
        // 15.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(162, 64);
        $pdf->Cell(40, 3, $claim->patient->policy_code, 0, 'C');
        // 17.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(140, 72);
        $pdf->Cell(40, 3, $claim->patient->company, 0, 'C');
      }
      
      // 18.
      $pdf->SetFont('Arial','b',10);
        // Si el paciente no es dependiente
        if(!$claim->patient->is_dependent) {
          $pdf->SetXY(109.5, 86.5);
          $pdf->Write(0, "x");
          
        } else {
          // Si es esposo
          if($claim->patient->relation == "Esposo(a)") {
            $pdf->SetXY(122, 86.5);
            $pdf->Write(0, "x");
          } 
          // Si es hijo
          else if($claim->patient->relation == "Hijo(a)") {
            $pdf->SetXY(137, 86.5);
            $pdf->Write(0, "x");
          } 
          // Otro
          else {
            $pdf->SetXY(159, 86.5);
            $pdf->Write(0, "x");
          }
        }

      // 20.
      $pdf->SetFont('Arial','',8);
      $pdf->SetXY(105, 95);
      $pdf->Multicell(100, 3, 
        $claim->patient->last_name . ', ' . 
        $claim->patient->first_name . "\n" . 
        $claim->patient->address . "\n" . 
        $claim->patient->city . ', ' .
        $claim->patient->state . ' ' . $claim->patient->zip_code, 0, 'C');
      // 21.
      $pdf->SetFont('Arial','',8);
      $pdf->SetXY(107, 114);
      $pdf->Multicell(30, 3, $claim->patient->birth_date, 0, 'C');
      // 22.
      $pdf->SetFont('Arial','b',10);
      $claim->patient->gender == 'Hombre'? $pdf->SetXY(144, 115) : $pdf->SetXY(151, 115);
      $pdf->Write(0, "x");
      
      // Tratamientos
      
        $y = 131;
        $total = 0;
      foreach ($claim->treatments as $treatment) {
        // 24.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(10, $y);
        $pdf->Cell(24, 1, $treatment->date, 0, 0);
        // 27.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(62, $y+.5);
        $pdf->cell(3, 1, $treatment->number, 0, 0, 'C');
        // 28.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(80, $y);
        $pdf->Cell(14, 1, $treatment->sc, 0, 0, 'C');
        // 29.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(94, $y);
        $pdf->Cell(15, 1, $treatment->treatment->code, 0, 0);
        // 30.
        $pdf->SetFont('Arial','',6);
        $pdf->SetXY(128, $y);
        $pdf->Cell(55, 1, $treatment->treatment->name, 0, 0);
        // 31.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(189, $y);
        $pdf->Cell(15, 1, number_format($treatment->price, 2), 0, 0, 'R');
        
        
        $y += 4.2;
        $total += $treatment->price;
      }
      
        // 32.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(189, 181);
        $pdf->Cell(15, 1, number_format($total, 2), 0, 0, 'R');

        // 35.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(10, 188);
        $pdf->Cell(15, 1, $claim->remarks . ' ' . $claim->nea, 0, 0, 'L');

        // 36.
        //signature
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(12, 210);
        $pdf->Cell(15, 1, 'Signature on file', 0, 0, 'L');
        //date
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(70, 210);
        $pdf->Cell(15, 1, date("m/d/Y", strtotime($claim->created_at)), 0, 0, 'R');

        // 37.
        //signature
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(12, 226.5);
        $pdf->Cell(15, 1, 'Signature on file', 0, 0, 'L');
        //date
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(70, 226.5);
        $pdf->Cell(15, 1, date("m/d/Y", strtotime($claim->created_at)), 0, 0, 'L');
        
        // 38.
        $pdf->SetFont('Arial','b',8);
        $pdf->SetXY(106.5, 200.5);
        $pdf->Cell(3, 1, 'x', 0, 0, 'C');
        // 39.
        $pdf->SetFont('Arial','', 7);
        $pdf->SetXY(183, 202);
        $pdf->Cell(3, 1, $claim->number_enclosures, 0, 0, 'C');
        // 40.
        if(!$claim->is_ortho) {
          $pdf->SetFont('Arial','b', 10);
          $pdf->SetXY(132, 209);
          $pdf->Cell(3, 1, 'x', 0, 0, 'C');
        } else {
          $pdf->SetFont('Arial','b', 10);
          $pdf->SetXY(110, 209);
          $pdf->Cell(3, 1, 'x', 0, 0, 'C');
        }
        // 43.
        if(!$claim->replacement_prosthesis) {
          $pdf->SetFont('Arial','b', 10);
          $pdf->SetXY(139.5, 217.5);
          $pdf->Cell(3, 1, 'x', 0, 0, 'C');
        } else {
          $pdf->SetFont('Arial','b', 10);
          $pdf->SetXY(132, 217.5);
          $pdf->Cell(3, 1, 'x', 0, 0, 'C');
        }
        // Autorizacion
        $interdental = new Interdental;
        // 48.
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(15, 245);
        $pdf->Multicell(80, 4, $interdental->address, 0, 'C');
        // 49.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(10, 266);
        $pdf->Cell(20, 1, $interdental->npi, 0, 0, 'R');
        // 50.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(40, 266);
        $pdf->Cell(20, 1, $interdental->license, 0, 0, 'R');
        // 51.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(70, 266);
        $pdf->Cell(20, 1, $interdental->snn, 0, 0, 'R');

        // Dentista
        $interdental = new Interdental;
        // 53.
        $pdf->SetFont('Arial','', 8);
        $pdf->SetXY(110, 245);
        $pdf->Multicell(80, 4, Auth::user()->doctor, 0, 'L');
        //date
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(170, 247);
        $pdf->Cell(15, 1, date("m/d/Y", strtotime($claim->created_at)), 0, 0, 'L');
        // 54.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(112, 254.5);
        $pdf->Cell(20, 1, Auth::user()->npi, 0, 0, 'L');
        // 55.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(180, 254.5);
        $pdf->Cell(20, 1, Auth::user()->license, 0, 0, 'L');
        // 56.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(110, 260);
        $pdf->Multicell(80, 4, Auth::user()->address, 0, 'L');
        // 55.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(180, 271);
        $pdf->Cell(20, 1, Auth::user()->add_provider_id, 0, 0, 'L');

      $pdf->Output();   
    }
}

Class Interdental {
  public $address = 'Interdental Solutions/Ricardo J. Guevara' . "\n" . 'P.O.Box 181100' . "\n" . 'Coronado, CA 92178';
  public $npi = '1740792902';
  public $license = '2005619';
  public $snn = '82-2382876';  
}
