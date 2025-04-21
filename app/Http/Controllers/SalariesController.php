<?php

namespace App\Http\Controllers;

use App\Models\Salaries;
use App\Models\Salary;
use App\Models\SalaryBonus;
use App\Models\SalaryDeduction;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SalariesController extends Controller
{
    public $activeMenu = "staff";


    // 1. Fungsi Menampilkan Halaman Staff & Guru
    public function index()
    {
        $title = "Daftar Gaji Guru & Staff";
        $activeMenu = $this->activeMenu;

        return view('admin.staff.salary.index', compact('title', 'activeMenu'));
    }


    public function pay($id_staff)
    {
        $title = "Bayar Gaji Guru & Staff";
        $activeMenu = $this->activeMenu;
        $staff = Staff::firstWhere('id_staff', Crypt::decrypt($id_staff));
        return view('admin.staff.salary.create', compact('title', 'activeMenu', 'staff'));
    }

    public function edit($id_staff, $month, $year)
    {
        $title = "Bayar Gaji Guru & Staff";
        $activeMenu = $this->activeMenu;
        $staff = Staff::with(['salaries' => function ($query) use ($month, $year) {
            $query->where('month', $month)
                ->where('year', $year);
        }])->where('id_staff', Crypt::decrypt($id_staff))->first();

        if (!$staff) {
            return redirect()->back();
        }

        $salaryDeduction = SalaryDeduction::where('salary_id', $staff->salaries->id)->get();
        $salaryBonus = SalaryBonus::where('salary_id', $staff->salaries->id)->get();
        return view('admin.staff.salary.edit', compact('title', 'activeMenu', 'staff', 'salaryDeduction', 'salaryBonus'));
    }

    public function create(Request $request, $id_staff)
    {
        $title = "Bayar Gaji Guru & Staff";
        $staff = Staff::firstWhere('id_staff', Crypt::decrypt($id_staff));


        $reqVal = $request->validate([
            'tax' => 'nullable|numeric',
            'paid' => 'required|numeric',
            'payment_method' => 'required',
            'description' => 'nullable',
            'salary_deduction_total' => 'required|numeric',
            'salary_bonus_total' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
        ]);
        $salary_id = (int) preg_replace("/[^0-9]/", "", md5(Carbon::now()));

        $reqVal['id'] = $salary_id;
        $reqVal['staff_id'] = Crypt::decrypt($id_staff);

        $deduction_descriptions = $request->input('salary_deduction_description');
        $deductions = $request->input('salary_deduction');

        $bonus_descriptions = $request->input('salary_bonus_description');
        $bonuses = $request->input('salary_bonus');

        Salary::create($reqVal);

        if ($bonus_descriptions != null && $bonuses != null) {
            foreach ($bonus_descriptions as $key => $desc) {
                SalaryBonus::create([
                    'salary_id' => $salary_id,
                    'salary_bonus_description' => $desc,
                    'salary_bonus' => str_replace(".", "", $bonuses[$key]),
                ]);
            }
        }

        if ($deduction_descriptions != null && $deductions != null) {
            foreach ($deduction_descriptions as $key => $desc) {
                SalaryDeduction::create([
                    'salary_id' => $salary_id,
                    'salary_deduction_description' => $desc,
                    'salary_deduction' => str_replace(".", "", $deductions[$key]),
                ]);
            }
        }
        return redirect('/gaji-staff')->with('success', 'Berhasil membayar ' . $staff->name);
    }

    public function update(Request $request, $salary_id)
    {
        $title = "Bayar Gaji Guru & Staff";
        // $staff = Staff::firstWhere('id_staff', Crypt::decrypt($id_staff));
        $salary_id = Crypt::decrypt($salary_id);

        $reqVal = $request->validate([
            'tax' => 'nullable|numeric',
            'paid' => 'required|numeric',
            'payment_method' => 'required',
            'description' => 'nullable',
            'salary_deduction_total' => 'required|numeric',
            'salary_bonus_total' => 'required|numeric',
        ]);


        $deduction_descriptions = $request->input('salary_deduction_description');
        $deductions = $request->input('salary_deduction');

        $bonus_descriptions = $request->input('salary_bonus_description');
        $bonuses = $request->input('salary_bonus');

        Salary::where('id', $salary_id)->update($reqVal);

        $bonus_records = SalaryBonus::where('salary_id', $salary_id)->get();
        $deduction_records = SalaryDeduction::where('salary_id', $salary_id)->get();
        if (!empty($bonus_descriptions) && !empty($bonuses)) {
            foreach ($bonus_records as $key => $bonus) {
                if (isset($bonus_descriptions[$key], $bonuses[$key]) && !empty($bonus_descriptions[$key]) && !empty($bonuses[$key])) {
                    $bonus->update([
                        'salary_bonus_description' => $bonus_descriptions[$key],
                        'salary_bonus' => str_replace(".", "", $bonuses[$key]),
                    ]);
                } else {
                    $bonus->delete();
                }
            }
        }

        if (!empty($deduction_descriptions) && !empty($deductions)) {
            foreach ($deduction_records as $key => $deduction) {
                if (isset($deduction_descriptions[$key], $deductions[$key]) && !empty($deduction_descriptions[$key]) && !empty($deductions[$key])) {
                    $deduction->update([
                        'salary_deduction_description' => $deduction_descriptions[$key],
                        'salary_deduction' => str_replace(".", "", $deductions[$key]),
                    ]);
                } else {
                    $deduction->delete();
                }
            }
        }

        if (count($bonus_descriptions) > count($bonus_records)) {
            for ($i = count($bonus_records); $i < count($bonus_descriptions); $i++) {
                if (!empty($bonus_descriptions[$i]) && !empty($bonuses[$i])) {
                    SalaryBonus::create([
                        'salary_id' => $salary_id,
                        'salary_bonus_description' => $bonus_descriptions[$i],
                        'salary_bonus' => str_replace(".", "", $bonuses[$i]),
                    ]);
                }
            }
        }

        if (count($deduction_descriptions) > count($deduction_records)) {
            for ($i = count($deduction_records); $i < count($deduction_descriptions); $i++) {
                if (!empty($deduction_descriptions[$i]) && !empty($deductions[$i])) {
                    SalaryDeduction::create([
                        'salary_id' => $salary_id,
                        'salary_deduction_description' => $deduction_descriptions[$i],
                        'salary_deduction' => str_replace(".", "", $deductions[$i]),
                    ]);
                }
            }
        }

        return redirect('/gaji-staff')->with('update', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Salaries $salaries)
    // {
    //     //
    // }
}
