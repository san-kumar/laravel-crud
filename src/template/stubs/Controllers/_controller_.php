<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*_usesmodels_*/

class _controller_ extends Controller {

    /*_authorize_*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, /*_cparentargs_*/) {
        /*_pauthorize_*/

        /*_cquery_*/

        /*_cwith_*/

        /*_csearch_*/

        /*_cpager_*/

        return view('_route_.index', /*_cindexvars_*/);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(/*_cparentargs_*/) {
        /*_pauthorize_*/

        /*_cselects_*/

        return view('_route_.create', /*_ccreatevars_*/);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, /*_cparentargs_*/) {
        /*_pauthorize_*/

        $request->validate(/*_cvalidatecreate_*/);

        try {

            $_var_ = new _model_();
            /*_cstore_*/
            $_var_->save();

            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('success', __('_title_ created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('_route_.create', /*_cparentvars_*/)->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\_model_ $_var_
     *
     * @return \Illuminate\Http\Response
     */
    public function show(/*_callargs_*/) {
        /*_pauthorize_*/

        return view('_route_.show', /*_callvars_*/);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\_model_ $_var_
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(/*_callargs_*/) {
        /*_pauthorize_*/

        /*_cselects_*/

        return view('_route_.edit', /*_ceditvars_*/);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, /*_callargs_*/) {
        /*_pauthorize_*/

        $request->validate(/*_cvalidateedit_*/);

        try {
            /*_cedit_*/
            $_var_->save();

            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('success', __('_title_ edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('_route_.edit', /*_callvars_*/)->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\_model_ $_var_
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(/*_callargs_*/) {
        /*_pauthorize_*/

        try {
            $_var_->delete();

            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('success', __('_title_ deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('error', 'Cannot delete _title_: ' . $e->getMessage());
        }
    }

    //@softdelete

    /**
     * Restore the specified deleted resource from storage.
     *
     * @param \App\Models\_model_ $_var_
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(/*_cparentargs_*/ int $_var__id,) {
        /*_pauthorize_*/

        /*_cfindbyid_*/
        /*_mauthorize_*/

        if (!empty($_var_)) {
            $_var_->restore();
            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('success', __('_title_ restored successfully'));
        } else {
            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('error', '_title_ not found');
        }
    }

    public function purge(/*_cparentargs_*/ int $_var__id,) {
        /*_pauthorize_*/

        /*_cfindbyid_*/
        /*_mauthorize_*/

        if (!empty($_var_)) {
            $_var_->forceDelete();
            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('success', __('_title_ purged successfully'));
        } else {
            return redirect()->route('_route_.index', /*_cparentvars_*/)->with('error', __('_title_ not found'));
        }
    }
    //@endsoftdelete
}
