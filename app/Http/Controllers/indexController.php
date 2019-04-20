<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use App\Patient;
use App\Claim;
use Auth;

class indexController extends Controller
{
    // redirect to index
    public function index() {
      return view('index');
    }

    // search patients
    public function search(Request $request)
    {
      global $param;
      $param = $request->param;
      $patients = Patient::where('user_id', Auth::user()->id)
      ->where(function($query) {
        $query->where('first_name', $GLOBALS['param'])
              ->orWhere('last_name', $GLOBALS['param']);
      })->get();

      return view('index')->with('patients', $patients);
    }

    // redirect to report
    public function report()
    {
      $claims = Claim::all();
      return view('report')->with('claims', $claims);
    }

    public function pdf(Request $request) {

      $claim = Claim::find($request->claim_id);
      // dd($claim->patient->relation);

      $pdf = new Fpdi();
      $pdf->AddPage();
      // set the source file
      $pdf->setSourceFile("claim.pdf");
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
        $pdf->Multicell(100, 3, $claim->patient->insurance->address, 0, 'C');
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
        // 29.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(94, $y);
        $pdf->Cell(15, 1, $treatment->treatment->code, 0, 0);
        // 30.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(130, $y);
        $pdf->Cell(55, 1, $treatment->treatment->name, 0, 0);
        // 31.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(189, $y);
        $pdf->Cell(15, 1, number_format($treatment->treatment->price, 2), 0, 0, 'R');
        
        
        $y += 4.2;
        $total += $treatment->treatment->price;
      }
      
        // 32.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(189, 181);
        $pdf->Cell(15, 1, number_format($total, 2), 0, 0, 'R');

        // 35.
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(10, 188);
        $pdf->Cell(15, 1, $claim->remarks, 0, 0, 'R');

      $pdf->Output();   
    }
}
