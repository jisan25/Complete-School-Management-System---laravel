<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    public function index()
    {
        // $all['data'] = FeeCategoryAmount::all();
        $all['data'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $all);
    }
    public function create()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.create_fee_amount', $data);
    }

    public function store(Request $request)
    {
        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }

            $notification = array(
                'message' => 'Information Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('fee_amount.view')->with($notification);
        }
    }
    public function edit($fee_cat_id)
    {
        $all['data'] = FeeCategoryAmount::where('fee_category_id', $fee_cat_id)->orderBy('class_id', 'asc')->get();
        // dd($all['data']->toArray());
        $all['fee_categories'] = FeeCategory::all();
        $all['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $all);
    }

    public function update(Request $request, $fee_cat_id)
    {
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'Sorry You do not select any class amount',
                'alert-type' => 'error'
            );
            return redirect()->route('fee_amount.edit', $fee_cat_id)->with($notification);
        } else {
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $fee_cat_id)->delete();
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
            $notification = array(
                'message' => 'Information Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('fee_amount.view')->with($notification);
        }
    }
    public function show($fee_cat_id)
    {
        $all['data'] = FeeCategoryAmount::where('fee_category_id', $fee_cat_id)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.show_fee_amount', $all);
    }
}
